<?php
/**
 * Провайдер для API Вконтакте
 *
 * PHP version 5.3
 *
 * @category PHP
 * @package  WebService
 * @author   Eugene Kurbatov <eugene.kurbatov@gmail.com>
 * @license  license GPL
 * @version  SVN: $Id: VkontakteApiProvider.php 21.03.2011 16:26:59 evkur $
 * @link     nolink
 */
 
class VkontakteApiProvider extends BaseApiProvider
{		
	protected $requiredPermission = 8192;
	
	protected $sessionPrefix = 'authDataVk';
	
	function __construct($appId, $apiUrl, $secretToken, $login, $pass)
	{
		parent::__construct($appId, $apiUrl, $secretToken);
						
		$this->provideSessionData($login, $pass);
	}
	
	public function auth($login, $pass)
	{		
		$this->requester->setUrl('http://vkontakte.ru/login.php?app='.$this->appId.'&layout=popup&type=browser&settings='.$this->requiredPermission);
		$this->requester->setMethod(HTTP_Request2::METHOD_GET);
		$response = $this->requester->send();
		
		preg_match("/<form.\s*action=\"http:\/\/login.vk.com\/\".*?target=\"login_frame\">(.*?)<\/form>/is", $response->getBody(), $loginFrame);
		preg_match_all("/hidden.+?name=['\"]([^'\"]*).+?value=['\"]([^'\"]*)/is", $loginFrame[1], $matches);
		$fields = array_combine($matches[1], $matches[2]);
		
		$this->requester->setUrl('http://login.vk.com/');
		$this->requester->setMethod(HTTP_Request2::METHOD_POST);
		$this->requester->addPostParameter($fields);
		$this->requester->addPostParameter(array(
			"al_test" => "14",
			"email" => $login, 
			"pass" => $pass,
			"expire" => 0,
			"permanent" => 1	//если 1 то ключ сессии не меняется
		));
		$response = $this->requester->send();
		
		preg_match_all("/hidden.+?name=['\"]([^'\"]*).+?value=['\"]([^'\"]*)/is", $response->getBody(), $matches);
		$fields = array_combine($matches[1], $matches[2]);
		
		$this->requester->setUrl('http://vkontakte.ru/login.php');
		$this->requester->setMethod(HTTP_Request2::METHOD_POST);
		$this->requester->addPostParameter($fields);
		$response = $this->requester->send();
		
		//echo $response->getBody();
		
		preg_match_all("/\"([^\"]*)\":[\"]*(\w*)/is", $response->getBody(), $matches);
		$res = array_combine($matches[1], $matches[2]);
		//print_r($res);
		
		return array('sid' => $res['sid'], 'mid' => $res['mid'], 'secret' => $res['secret']);
	}		
		
	/**	 
	 * @todo Возможно сделать через execute(), для ускорения работы
	 */
	public function getOnlineFriends()
	{		
		$friends = array();
		
		$results = $this->callApi('friends.get', array('fields' => 'first_name, last_name, bdate')); 
		
		foreach ($results['response'] as $result)
		{
			if ($result['online'] == 1)
			{
				$bdate = isset($result['bdate']) ? $result['bdate'] : null;
				$friends[] = new PersonEntity($result['uid'], $result['first_name'], $result['last_name'], $bdate);
			}
		}		
		return $friends;
	}
	
	public function getFriends()
	{
		$friends = array();
		
		$results = $this->callApi('friends.get', array('fields' => 
			'uid, first_name, last_name, nickname, sex, bdate, city, country, timezone, 
			photo, photo_medium, photo_big, domain, has_mobile, rate, contacts, education'));
	
		foreach ($results['response'] as $result)
		{
			$bdate = isset($result['bdate']) ? $result['bdate'] : null;
			$friends[] = new PersonEntity($result['uid'], $result['first_name'], $result['last_name'], $bdate); 
		}
		
		return $friends;
	}
	
	public function publish($messageText)
	{	
		$activity = new ActivityEntity(ActivityEntity::POST, null, $messageText, null, null);
		
		$result = $this->callApi('wall.post', array('message' => $activity->getText()));
		
		$activity->setId($result['response']['post_id']);
		
		return $activity;
	}
	
	/**
	 * @todo передавать в параметрах с какого времени по какое брать новости
	 */
	public function getFriendsFeed()
	{
		$activities = array();
		$results = $this->callApi('newsfeed.get', array('filters' => 'post'));
		
		foreach ($results['response']['items'] as $result)
		{
			$title = null;
			$text = $result['text'];
			$date = date('Y-m-d H:m:s', $result['date']);
			$authorId = $result['source_id'];
			$activity = new ActivityEntity(ActivityEntity::POST, $title, $text, $date, $authorId);
			$activity->setId($result['post_id']);
			$activities[] = $activity; 			 
		}
		
		return $activities;
	}	
	
	private function checkPermissions()
	{
		return ($this->requiredPermission <= $this->getPermissions());
	}
	
	private function getPermissions()
	{
		$settings = $this->callApi('getUserSettings');
		return $settings['response'];
	}
	
	private function callApi($method, $params = false)
	{
		if (!$params) 
			$params = array();
		 
		$params['api_id'] = $this->appId;
		$params['v'] = '3.0';
		$params['method'] = $method;		
		$params['format'] = 'json';
		$params['test_mode'] = 1;
				
		ksort($params);
				
		$sig = md5($this->sessionData['mid'] . $this->buildParamsStr($params) . $this->sessionData['secret']);
	
		$params['sid'] = $this->sessionData['sid'];
		$params['sig'] = $sig;
	
		$this->requester->setUrl($this->apiUrl.'?'.http_build_query($params));
		$this->requester->setMethod(HTTP_Request2::METHOD_GET);
		$response = $this->requester->send();
		
		$res = json_decode($response->getBody(), true);
		
		//Произошла внешняя ошибка, выбрасываем исключение
		if (isset($res['error'])) 
			throw new APIException(0, $res['error']);
		
		return $res;
	}
}
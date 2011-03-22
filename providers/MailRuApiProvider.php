<?php
/**
 * TODO: eugene: Добавить здесь комментарий
 *
 * PHP version 5.3
 *
 * @category PHP
 * @package  WebService
 * @author   Eugene Kurbatov <eugene.kurbatov@gmail.com>
 * @license  license GPL
 * @version  SVN: $Id: MailRuApiProvider.php 21.03.2011 16:26:27 evkur $
 * @link     nolink
 */
 
class MailRuApiProvider extends BaseApiProvider
{			
	protected $sessionPrefix = 'authDataMR';
	
	function __construct($appId, $apiUrl, $secretToken, $login, $pass)
	{
		parent::__construct($appId, $apiUrl, $secretToken);
						
		$this->provideSessionData($login, $pass);
	}
	
	
	public function getFriends()
	{
		$friends = array();
		
		$results = $this->callApi('friends.get', array('ext' => 1));
		
		foreach ($results as $result)
		{	
			$friend = new PersonEntity();
			$friend->setId($result['uid']);
			$friend->setFirstName($result['first_name']);
			$friend->setLastName($result['last_name']);
			$friend->setBirthday($result['birthday']);	
			$friends[] = $friend;		 
		}
		
		return $friends;
	}
	
	public function getFriendsFeed()
	{
		$activities = array();
		$results = $this->callApi('stream.get');
		
		foreach ($results as $result)
		{
			//фильтрум только сообщения
			if (isset($result['user_text']) && !empty($result['user_text']))
			{
				$activity = new ActivityEntity(ActivityEntity::POST);				
				$activity->setText($result['user_text']);
				$activity->setDate(date('Y-m-d H:m:s', $result['time']));
				$activity->setAuthorId($result['authors'][0]['uid']);				
				$activity->setId($result['id']);								
				$activities[] = $activity; 			 
			}
		}
		
		return $activities;
	}
	
	public function getOnlineFriends()
	{
		$friends = array();
		
		$results = $this->callApi('friends.get', array('ext' => 1));
		
		foreach ($results as $result)
		{
			if ($result['is_online'] == 1)
			{	
				$friend = new PersonEntity();
				$friend->setId($result['uid']);
				$friend->setFirstName($result['first_name']);
				$friend->setLastName($result['last_name']);
				$friend->setBirthday($result['birthday']);	
				$friends[] = $friend;		 
			}
		}
		
		return $friends;
	}
	
	//сессия живет сутки, потом можно обновить используя refresh_token
	public function auth($login, $pass)
	{					
		//не работает - Err: invalid_grant	
/*
		$this->requester->setUrl("https://connect.mail.ru/oauth/authorize?client_id=".$this->appId."&response_type=code&redirect_uri=http://test.streetcoder.ru/receiver.html");
		$this->requester->setMethod(HTTP_Request2::METHOD_GET);
		$this->requester->setCookieJar();
		$response = $this->requester->send();
		
		preg_match_all("/hidden.+?name=['\"]([^'\"]*).+?value=['\"]([^'\"]*)/is", $response->getBody(), $matches);
		
		$fields = array_combine($matches[1], $matches[2]);
		
		$this->requester->setUrl('https://win.mail.ru/cgi-bin/auth');
		$this->requester->setMethod(HTTP_Request2::METHOD_POST);
		$this->requester->addPostParameter($fields);
		
		list($login, $domain) = explode('@', $login);

		$this->requester->addPostParameter(array(
			"Login" => $login,
			"Domain" => $domain, 
			"Password" => $pass
		));
		$response = $this->requester->send();
		
		preg_match("/(http:\\/\\/[^\"]+?)\"/is", $response->getBody(), $match);
	
		$this->requester->setUrl($match[1]);
		$this->requester->setMethod(HTTP_Request2::METHOD_GET);
		$response = $this->requester->send();
	
		preg_match("/(https:\\/\\/[^\"]+?)\"/is", $response->getBody(), $match);
				
		$this->requester->setUrl($match[1]);
		$this->requester->setMethod(HTTP_Request2::METHOD_GET);
		$response = $this->requester->send();

		$headers = $response->getHeader(); 		
		$str = parse_url($headers['location'], PHP_URL_QUERY);
		list(, $code) = explode('=', $str);				
		
		$this->requester->setUrl('https://connect.mail.ru/oauth/token');
		$this->requester->setMethod(HTTP_Request2::METHOD_POST);			
		
		$this->requester->setHeader('Content-Type', 'application/x-www-form-urlencoded');
		
		$post = array(
			"client_id" => $this->appId,
			"client_secret" => $this->secretToken, 
			"grant_type" => 'password',
			"code" => $code,
			"redirect_uri" => 'http://test.streetcoder.ru/receiver.html'
		);
*/		
		$this->requester->setUrl('https://connect.mail.ru/oauth/token');
		$this->requester->setMethod(HTTP_Request2::METHOD_POST);			
		
		$this->requester->setHeader('Content-Type', 'application/x-www-form-urlencoded');
		$this->requester->addPostParameter(array(
			"client_id" => $this->appId,
			"client_secret" => $this->secretToken, 
			"grant_type" => 'password',
			"username" => $login,
			"password" => $pass,			
		));
		
		$response = $this->requester->send();	
		
		return json_decode($response->getBody(), true);
	}
	
	public function publish($messageText) 
	{		
		$activity = new ActivityEntity(ActivityEntity::POST);
		$activity->setText($messageText);
				
		$result = $this->callApi('stream.post', array('user_text' => $activity->getText()));
		
		return $result;
		$activity->setId($result[0]['id']);
		
		return $activity;
	}
	
	private function callApi($method, $params = false)
	{
		if (!$params) 
			$params = array();
		 
		$params['app_id'] = $this->appId;
		$params['secure'] = 1;
		$params['method'] = $method;		
		$params['format'] = 'json';		
		$params['session_key'] = $this->sessionData['access_token'];
		
		ksort($params);
				
		$sig = md5($this->buildParamsStr($params) . $this->secretToken);
			
		$params['sig'] = $sig;
	
		$this->requester->setUrl($this->apiUrl.'?'.http_build_query($params));
		$this->requester->setMethod(HTTP_Request2::METHOD_GET);
		$response = $this->requester->send();
		
		$res = json_decode($response->getBody(), true);
		
		//Произошла внешняя ошибка, выбрасываем исключение
		if (is_array($res) && isset($res['error'])) 
			throw new APIException(0, $res['error']);
		
		return $res;
	}
	
}

<?php
class VKApiProvider extends BaseApiProvider
{
	protected $apiUrl = 'http://api.vkontakte.ru/api.php';
	
	protected $requiredPermission = 8192;
	
	protected $sessionPrefix = 'authDataVk';
	
	function __construct($appId, $secretToken, $login, $pass)
	{
		parent::__construct($appId, $secretToken);
						
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
			"permanent" => 1	
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
		return json_decode($response->getBody(), true);
	}
	
	public function getOnlineFriends()
	{		
		return $this->callApi('friends.getOnline');	
	}
	
	public function getFriends()
	{
		return $this->callApi('friends.get', array('fields' => 
			'uid, first_name, last_name, nickname, sex, bdate, city, country,
			 timezone, photo, photo_medium, photo_big, domain, has_mobile, rate, contacts, education'));
	}
	
	public function postStream($message)
	{	
		return $this->callApi('wall.post', array('message' => $message));
	}
	
	public function getFriendsFeed()
	{
		return $this->callApi('newsfeed.get', array('filters' => 'post, photo, note'));
	}	
}
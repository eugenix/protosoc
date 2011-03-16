<?php
class MailRuApiProvider extends BaseApiProvider
{
	protected $apiUrl = 'http://www.appsmail.ru/platform/api';	
	
	protected $sessionPrefix = 'authDataMR';
	
	function __construct($appId, $secretToken, $login, $pass)
	{
		parent::__construct($appId, $secretToken);
						
		$this->provideSessionData($login, $pass);
	}
	
	
	public function getFriends()
	{
	}
	
	public function getFriendsFeed()
	{
	}
	
	public function getOnlineFriends()
	{
	}
	
	public function auth($login, $pass)
	{		
		$this->requester->setUrl("https://connect.mail.ru/oauth/authorize?client_id=".$this->appId."&response_type=code");
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

		//var_dump($this->requester->getCookieJar());
		
		//echo $match[1];
		
		//exit();
		
		$this->requester->setUrl($match[1]);
		$this->requester->setMethod(HTTP_Request2::METHOD_GET);
		$response = $this->requester->send();
		
		preg_match("/(https:\\/\\/[^\"]+?)\"/is", $response->getBody(), $match);
		
		
		
		$this->requester->setUrl($match[1]);
		$this->requester->setMethod(HTTP_Request2::METHOD_GET);
		$response = $this->requester->send();

		
		var_dump($response->getBody());
		
		exit();
	}
	
	public function postStream($message) {}
	
	private function callApi($method, $params = false)
	{
		if (!$params) 
			$params = array();
		 
		$params['app_id'] = $this->appId;
		$params['secure'] = 1;
		$params['method'] = $method;		
		$params['format'] = 'json';		
		$params['session_key'] = $this->sessionData['session_key'];
				
		ksort($params);
				
		$sig = md5($this->buildParamsStr($params) . $this->secretToken);
			
		$params['sig'] = $sig;
	
		$this->requester->setUrl($this->apiUrl.'?'.http_build_query($params));
		$this->requester->setMethod(HTTP_Request2::METHOD_GET);
		$response = $this->requester->send();
		return json_decode($response->getBody(), true);
	}
	
}

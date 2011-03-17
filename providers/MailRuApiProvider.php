<?php
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
		return $this->callApi('friends.get', array('ext' => 1));
	}
	
	public function getFriendsFeed()
	{
		return $this->callApi('stream.get');
	}
	
	public function getOnlineFriends()
	{
		$this->callApi('friends.get');
		$this->callApi('users.getInfo', array('uids' => ''));
		//"is_online": 1
	}
	
	//сессия живет сутки, потом можно обновить используя refresh_token
	public function auth($login, $pass)
	{					
		//не работает - invalid_grant	
//		$this->requester->setUrl("https://connect.mail.ru/oauth/authorize?client_id=".$this->appId."&response_type=code&redirect_uri=http://test.streetcoder.ru/receiver.html");
//		$this->requester->setMethod(HTTP_Request2::METHOD_GET);
//		$this->requester->setCookieJar();
//		$response = $this->requester->send();
//		
//		preg_match_all("/hidden.+?name=['\"]([^'\"]*).+?value=['\"]([^'\"]*)/is", $response->getBody(), $matches);
//		
//		$fields = array_combine($matches[1], $matches[2]);
//		
//		$this->requester->setUrl('https://win.mail.ru/cgi-bin/auth');
//		$this->requester->setMethod(HTTP_Request2::METHOD_POST);
//		$this->requester->addPostParameter($fields);
//		
//		list($login, $domain) = explode('@', $login);
//
//		$this->requester->addPostParameter(array(
//			"Login" => $login,
//			"Domain" => $domain, 
//			"Password" => $pass
//		));
//		$response = $this->requester->send();
//		
//		preg_match("/(http:\\/\\/[^\"]+?)\"/is", $response->getBody(), $match);
//	
//		$this->requester->setUrl($match[1]);
//		$this->requester->setMethod(HTTP_Request2::METHOD_GET);
//		$response = $this->requester->send();
//	
//		preg_match("/(https:\\/\\/[^\"]+?)\"/is", $response->getBody(), $match);
//				
//		$this->requester->setUrl($match[1]);
//		$this->requester->setMethod(HTTP_Request2::METHOD_GET);
//		$response = $this->requester->send();
//
//		$headers = $response->getHeader(); 		
//		$str = parse_url($headers['location'], PHP_URL_QUERY);
//		list(, $code) = explode('=', $str);				
//		
//		$this->requester->setUrl('https://connect.mail.ru/oauth/token');
//		$this->requester->setMethod(HTTP_Request2::METHOD_POST);			
//		
//		$this->requester->setHeader('Content-Type', 'application/x-www-form-urlencoded');
//		
//		$post = array(
//			"client_id" => $this->appId,
//			"client_secret" => $this->secretToken, 
//			"grant_type" => 'password',
//			"code" => $code,
//			"redirect_uri" => 'http://test.streetcoder.ru/receiver.html'
//		);
		
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
	
	public function postStream($message) 
	{
		return $this->callApi('stream.post', array('user_text' => $message));
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
		return json_decode($response->getBody(), true);
	}
	
}

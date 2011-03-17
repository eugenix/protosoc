<?php
class OdnoclassnikiApiProvider extends BaseApiProvider
{
	//waiting for response from administration
	protected $appKey = null;
	
	protected $apiUrl = 'http://api-sandbox.odnoklassniki.ru:8088/api/fb.do';
	
	protected $sessionPrefix = 'authDataOdkl';
	
	function __construct($appId, $appKey, $secretToken, $login, $pass)
	{						
		parent::__construct($appId, $secretToken);
				
		$this->appKey = $appKey;		
		
		$this->provideSessionData($login, $pass);
	}
	
	public function getFriends()
	{
		$userIds = implode(',', $this->callApi('friends.get', 
			array('session_key' => $this->sessionData['session_key'])));
		
		//max 100 ids - to fix		
		return $this->callApi('users.getInfo', 
			array('uids' => $userIds, 
				'fields' => 'uid,first_name,last_name,name,gender,birthday,age,location,current_location,pic_1', 
				'session_key' => $this->sessionData['session_key'])
		);			
	}
	
	public function getFriendsFeed()
	{
		throw new APIException(0, 'This method will be implemented after half a year');		
	}
	
	public function getOnlineFriends()
	{
		return $this->callApi('friends.getOnline', 
			array('session_key' => $this->sessionData['session_key']));
	}
	
	public function auth($login, $pass)
	{
		return $res = $this->callApi('auth.login', 
			array('user_name' => $login, 'password' => $pass, 'gen_token' => true));		 		
	}
	
	public function postStream($message) 
	{
		return $this->callApi('stream.publish', 
			array('message' => $message, 'session_key' => $this->sessionData['session_key']));
	}
	
	private function callApi($method, $params = false)
	{
		if (!$params) 
			$params = array(); 
			
		$params['application_key'] = $this->appKey;		
		$params['method'] = $method;
		$params['format'] = 'JSON';
		
		ksort($params);
		$sig = $this->buildParamsStr($params);
				
		/*
		 * если запрос требует авторизации, то подписываем секретным ключом сессии
		 * иначе секретным ключом приложения
		 */
		if (isset($params['session_key'])) 
			$sig .= $this->sessionData['session_secret_key'];				
		else 		
			$sig .= $this->secretToken;		

		$params['sig'] = md5($sig);				

		$this->requester->setUrl($this->apiUrl.'?'.http_build_query($params));
		$this->requester->setMethod(HTTP_Request2::METHOD_GET);
		$response = $this->requester->send();
		return json_decode($response->getBody(), true);
	}
}
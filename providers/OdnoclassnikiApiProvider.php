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
 * @version  SVN: $Id: OdnoclassnikiApiProvider.php 21.03.2011 16:26:44 evkur $
 * @link     nolink
 */
 
class OdnoclassnikiApiProvider extends BaseApiProvider
{
	//waiting for response from administration
	protected $appKey = null;
		
	protected $sessionPrefix = 'authDataOdkl';
	
	function __construct($appId, $apiUrl, $appKey, $secretToken, $login, $pass)
	{						
		parent::__construct($appId, $apiUrl, $secretToken);
				
		$this->appKey = $appKey;		
		
		$this->provideSessionData($login, $pass);
	}
	
	/**
	 * @todo friends.get возвращает максимум для 100 друзей
	 */
	public function getFriends()
	{
		$friends = array();
		
		$userIds = implode(',', $this->callApi('friends.get', 
			array('session_key' => $this->sessionData['session_key'])));
		
		$results = $this->callApi('users.getInfo', array('uids' => $userIds, 
				'fields' => 'uid,first_name,last_name,name,gender,birthday,age,location,current_location,pic_1', 
				'session_key' => $this->sessionData['session_key'])					
		);			
		
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
		throw new APIException(0, 'This method will be implemented after a half a year');		
	}
	
	public function getOnlineFriends()
	{	
		$friends = array();
		
		$userIds = implode(',', $this->callApi('friends.getOnline', 
			array('session_key' => $this->sessionData['session_key'])));
		
		$results = $this->callApi('users.getInfo', array('uids' => $userIds, 
			'fields' => 'uid,first_name,last_name,birthday', 
			'session_key' => $this->sessionData['session_key'])					
		);			
		
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
	
	public function auth($login, $pass)
	{
		return $res = $this->callApi('auth.login', 
			array('user_name' => $login, 'password' => $pass, 'gen_token' => true));		 		
	}
	
	public function publish($messageText) 
	{
		$activity = new ActivityEntity(ActivityEntity::POST, null, $messageText, null, null);
		
		$result = $this->callApi('stream.publish', 
			array('message' => $messageText, 'session_key' => $this->sessionData['session_key']));
			
		$activity->setId($result);
		
		return $activity;
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
		 * иначе секретным ключом приложения ваываыв
		 */
		if (isset($params['session_key'])) 
			$sig .= $this->sessionData['session_secret_key'];				
		else 		
			$sig .= $this->secretToken;		

		$params['sig'] = md5($sig);				

		$this->requester->setUrl($this->apiUrl.'?'.http_build_query($params));
		$this->requester->setMethod(HTTP_Request2::METHOD_GET);
		$response = $this->requester->send();
		
		$res = json_decode($response->getBody(), true);
						
		//Произошла внешняя ошибка, выбрасываем исключение
		if (is_array($res) && isset($res['error_code'])) 
			throw new APIException(0, $res);
		
		return $res;
	}
}
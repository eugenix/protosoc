<?php
set_time_limit(0);
session_start();

//vk_id 4623643
/*
 * post message, picture, music, video, get friends feed, who is online
 * 
 */

require_once 'HTTP/Request2.php';
require_once 'HTTP/Request2/Adapter/Curl.php';

define('AUTH_URL', 'http://vkontakte.ru/login.php?app=2215721&layout=popup&type=browser&settings=8192');
define('APP_ID', 2215721);
define('PRIVATE_KEY', 'PNklLefcCI8t9DfMOVPI');
define('EMAIL', 'vivareal@list.ru');
define('PASS', 'valenly');


class VKApiProvider
{
	private $apiId = null;
	
	private $secretToken = null;
	
	private $apiUrl = 'http://api.vkontakte.ru/api.php';
	
	private $sessionData = null;
	
	private $requester = null;
	
	function __construct($apiId, $secretToken)
	{
		$this->requester = new HTTP_Request2();
		$this->requester->setConfig(array(
			'adapter' => new HTTP_Request2_Adapter_Curl(),
			'timeout' => 30,
			'connect_timeout' => 30
		));
		
		$this->apiId = $apiId;
		$this->secretToken = $secretToken;
		
		if (!isset($_SESSION['authData'])) 
		{
			$_SESSION['authData'] = $this->auth(EMAIL, PASS);			
			echo "Session upadated"; 
		}
		$this->sessionData = $_SESSION['authData'];				
	}
	
	public function auth($email, $pass) 
	{			
		$this->requester->setUrl(AUTH_URL);
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
			"email" => $email, 
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
	
	private function callApi($method, $params = false)
	{
		if (!$params) 
			$params = array();
		 
		$params['api_id'] = $this->apiId;
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
	
	private function buildParamsStr($params)
	{
		$str = '';
		foreach ($params as $key => $value)
		{
			$str .= $key.'='.$value;
		}
		return $str;
	}
	
	public function getUsersProfiles($uids, $fields)
	{
		return $this->callApi('getProfiles', array(
			'uids' => join(',', $uids), 
			'fields' => join(',', $fields)
		));
	}
	
	public function postOnWall($ownerId, $message)
	{
		return $this->callApi('wall.post', array(
			'owner_id' => $ownerId, 
			'message' => $message
		));
	}
		
	public function getUserSettings()
	{
		return $this->callApi('getUserSettings');
	}
}


function dump($var)
{
	echo '<pre>';
	print_r($var);
	echo '</pre>';	
}


$vk = new VKApiProvider(APP_ID, PRIVATE_KEY);

$vk->auth(EMAIL, PASS);

//$result = $vk->getUsersProfiles(array(1), array('photo', 'sex'));

//$result = $vk->postOnWall(4623643, 'Just message');

$result = $vk->getUserSettings();

dump($result);







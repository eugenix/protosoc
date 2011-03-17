<?php
/**
 * Базовый класс провайдера
 * @author eugene
 *
 */
abstract class BaseApiProvider implements IAPIProvider
{
	/**
	 * Id приложения в системе
	 * @var int
	 */
	protected $appId = null;
	
	/**
	 * Секретный ключ приложения
	 * @var string
	 */
	protected $secretToken = null;
	
	protected $apiUrl = null;
	
	protected $sessionData = null;
	
	protected $sessionPrefix = null;
	
	protected $requester = null;
	
	function __construct($appId, $apiUrl, $secretToken) 
	{
		$this->requester = new HTTP_Request2();
		$this->requester->setConfig(array(
			'adapter' => new HTTP_Request2_Adapter_Curl(),
			'timeout' => 30,
			'connect_timeout' => 30
		));
		
		$this->appId = $appId;
		$this->apiUrl = $apiUrl;
		$this->secretToken = $secretToken;		
	}
	
	/*
	 * чтобы каждый раз не авторизовываться сохраняем сессию		 
	 */
	protected function provideSessionData($login, $pass)
	{
		$skey = $this->sessionPrefix . $login . $pass;		
		if (!$this->hasSessionKey($skey)) 
		{
			$skeyVal = $this->auth($login, $pass);			
			self::storeSessionKey($skey, $skeyVal);			
			echo "Session upadated: ". print_r($skeyVal, true); 
		}
		$this->sessionData = self::getSessionKey($skey);
	}
			
	protected function buildParamsStr($params)
	{
		$str = '';
		foreach ($params as $key => $value)
		{
			$str .= $key.'='.$value;
		}
		return $str;
	}
	
	protected static function storeSessionKey($skey, $skeyVal)
	{
		$_SESSION[$skey] = $skeyVal;		
	}
		
	protected static function getSessionKey($skey)
	{
		return $_SESSION[$skey];
	}
	
	protected function hasSessionKey($skey)
	{
		return isset($_SESSION[$skey]);
	}
	
	protected static function dump($var)
	{
		echo "<pre>";
		var_dump($var);
		echo "</pre>";
	}
}
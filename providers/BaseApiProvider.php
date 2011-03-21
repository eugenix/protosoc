<?php
/**
 * Базовый класс провайдера
 *
 * PHP version 5.3
 *
 * @category PHP
 * @package  WebService
 * @author   Eugene Kurbatov <eugene.kurbatov@gmail.com>
 * @license  license GPL
 * @version  SVN: $Id: BaseApiProvider.php 21.03.2011 16:10:17 evkur $
 * @link     nolink
 */
 
abstract class BaseApiProvider implements IAPIProvider
{
	/**
	 * Id приложения в системе
	 * 
	 * @var int
	 */
	protected $appId = null;
	
	/**
	 * Секретный ключ приложения
	 * 
	 * @var string
	 */
	protected $secretToken = null;
	
	/**
	 * Url сервиса, на который идут запросы к api 
	 *
	 * @var string
	 */
	protected $apiUrl = null;
		
	/**
	 * Данные сессии, которые создаются после авторизации.
	 * Нужны для подписи запросов.
	 *
	 * @var string
	 */
	protected $sessionData = null;
	
	/**
	 * Префикс ключа сессии, для каждого провайдера свой.
	 *
	 * @var string
	 */
	protected $sessionPrefix = null;
	
	/**
	 * Объект, через который осуществляются http-запросы
	 *
	 * @var HTTP_Request2
	 */
	protected $requester = null;
	
	/**
	 * Конструткор базового класса
	 *
	 * @param string $appId Id приложения
	 * @param string $apiUrl Url сервиса, на который идут запросы к api 
	 * @param string $secretToken Секретный ключ приложения
	 * 
	 * @todo Вынести в конфиги параметры соединения 
	 */
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
	
	/**
	 * Сохраняет данные сессии, чтобы каждый раз заново не авторизовываться
	 *
	 * @param string $login Логин
	 * @param string $pass Пароль
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
			
	/**
	 * Собирает строку из параметров
	 *
	 * @param array $params
	 * 
	 * @return string
	 */
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
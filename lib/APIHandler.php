<?php
/**
 * Обработка запросов, выполнение методов, 
 * генерация ответов на запросы
 */
class APIHandler
{			
	/** экземпляр объекта */
	private static $instance = null;
	
	/**
	 * типа Singleton, поэтому конструктор приватный
	 */
	private function __construct()
	{		
	}
	
	public function __clone()
	{
		throw new Exception("Clone method not supported");
	}
	
	/**
	 * Возвращает экземпляр класса APIHandler
	 */
	public static function getInstance()
	{
		if (!isset(self::$instance))
			self::$instance = new APIHandler();
		
		return self::$instance;		
	}
	
	public function init() {}
		
	public function executeMethod($providerAlias, $methodName, $params)
	{		
		$provider = ApiProviderFactory::createProvider($providerAlias);				
		$refProvider = new ReflectionObject($provider);				
		$method = $refProvider->getMethod($methodName);			
		return $method->invokeArgs($provider, $params);
	}		
	
	public static function getFixedParams($params)
	{
		$fixedParams = $params;
		unset($fixedParams['invoke']);
		return $fixedParams;
	}
	
	/**
	 * 
	 * Отсылает заголовки
	 * выводит содержимое
	 */
	public static function sendResponse($result)
	{
		$res["resp"] = $result;
		$res["ts"] = time();
		echo '<pre>';
		echo print_r($res);
		echo '</pre>';					
	}
	
	/**
	 * Отправка объекта, описывающего ошибку
	 */
	public static function sendError($code, $message)
	{
		$res["errorCode"] = $code;
		$res["errorMessage"] = $message;
		$error["error"] = $res;
		echo '<pre>';
		echo print_r($res);
		echo '</pre>';	
	}
}
?>
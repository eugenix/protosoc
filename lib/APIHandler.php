<?php
/**
 * Обработка запросов, выполнение методов, 
 * генерация ответов на запросы
 *
 * PHP version 5.3
 *
 * @category PHP
 * @package  WebService
 * @author   Eugene Kurbatov <eugene.kurbatov@gmail.com>
 * @license  license GPL
 * @version  SVN: $Id: APIHandler.php 18.03.2011 17:05:46 evkur $
 * @link     nolink
 */
 
class APIHandler
{			
				
	/**
	 * Экземпляр объекта
	 *
	 * @var APIHandler
	 */
	private static $instance = null;
	
	/**
	 * типа Singleton, поэтому конструктор приватный
	 * 
	 * @return void  
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
	 *
	 * @return APIHandler	 	  
	 */
	public static function getInstance()
	{
		if (!isset(self::$instance))
			self::$instance = new APIHandler();
		
		return self::$instance;		
	}		
		
	/**
	 * Вызывает метод класса-провайдера
	 *
	 * @param string $providerName Имя класса-провайдера
	 * @param string $methodName Имя метода
	 * @param array $params
	 *
	 * @return mixed  
	 */
	public function executeMethod($providerName, $methodName, $params)
	{		
		$provider = APIProviderFactory::createProvider($providerName);		
		
		$refProvider = new ReflectionObject($provider);				
		$method = $refProvider->getMethod($methodName);			
		return $method->invokeArgs($provider, $params);
	}		
	
	/**
	 * Удаляет лишние параметры из GET
	 *
	 * @param array $params Параметры	 
	 *
	 * @return array  
	 */
	public static function getFixedParams($params)
	{
		$fixedParams = $params;
		unset($fixedParams['invoke']);
		return $fixedParams;
	}
		
	/**
	 * Отсылает заголовки выводит содержимое
	 *
	 * @param mixed $result
	 *
	 * @return void  
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
	 *
	 * @param integer $code Код ошибки
	 * @param strinng $message Описание ошибки
	 *
	 * @return void  
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
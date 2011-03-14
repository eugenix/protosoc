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
	 * @var string
	 */
	private $apiId = null;
	
	/**
	 * Секретный ключ приложения
	 * @var string
	 */
	private $secretToken = null;
	
	private $apiUrl = null;
	
	private $sessionData = null;
	
	private $requester = null;
	
	function __construct($apiId, $secretToken) {}
	
	protected function buildParamsStr($params)
	{
		$str = '';
		foreach ($params as $key => $value)
		{
			$str .= $key.'='.$value;
		}
		return $str;
	}
}
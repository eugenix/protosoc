<?php
class APIConfigurator
{
	/** экземпляр объекта */
	private static $instance = null;
	private static $liteConfig = null;
	
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
			self::$instance = new APIConfigurator();
		
		return self::$instance;		
	}
	
	public function init($filename) 
	{
		self::$liteConfig = new Config_Lite($filename);				
	}
	
	public function get($section, $name)
	{
		return self::$liteConfig->get($section, $name);
	}
	
}
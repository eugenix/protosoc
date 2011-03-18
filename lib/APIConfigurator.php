<?php
/**
 * Обработчик ini файла конфигурации
 *
 * PHP version 5.3
 *
 * @category PHP
 * @package  WebService
 * @author   Eugene Kurbatov <eugene.kurbatov@gmail.com>
 * @license  license GPL
 * @version  SVN: $Id: APIConfigurator.php 18.03.2011 13:02:42 evkur $
 * @link     nolink
 */

class APIConfigurator
{
	/**
	 * Экземпляр объекта
	 *  
	 *  @var APIConfigurator
	 */
	private static $instance = null;
		
	/**
	 * Экземпляр объекта конфигуратора
	 *
	 * @var Config_Lite
	 */
	private static $liteConfig = null;
	
	/**
	 * типа Singleton, поэтому конструктор приватный
	 * 
	 * @return void  
	 */
	private function __construct()
	{		
	}
	
	/**
	 * Запрещение копирования Singleton
	 *
	 * @throws Exception
	 *
	 * @return void  
	 */
	public function __clone()
	{
		throw new Exception("Clone method not supported");
	}
	
	/**
	 * Возвращает экземпляр класса APIConfigurator
	 * 
	 * @return APIConfigurator
	 */
	public static function getInstance()
	{
		if (!isset(self::$instance))
			self::$instance = new APIConfigurator();
		
		return self::$instance;		
	}
	
	/**
	 * Инициализирует объект конфигурции
	 *
	 * @param string $filename Имя файла конфигурации
	 *
	 * @return void  
	 */
	public function init($filename) 
	{
		self::$liteConfig = new Config_Lite($filename);				
	}
	
	/**
	 * Получает значение конфига
	 *
	 * @param string $section Имя секции
	 * @param string $name Имя параметра
	 *
	 * @return string  
	 */
	public function get($section, $name)
	{
		return self::$liteConfig->get($section, $name);
	}
	
}
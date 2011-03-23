<?php
/**
 * Класс отвечает за автоматическую загрузку файлов
 *
 * PHP version 5.3
 *
 * @category PHP
 * @package  WebService
 * @author   Eugene Kurbatov <eugene.kurbatov@gmail.com>
 * @license  license GPL
 * @version  SVN: $Id: APIAutoLoader.php 23.03.2011 14:43:52 evkur $
 * @link     nolink
 */
 
class APIAutoLoader 
{
	public static $instance;	
	
    private $incPaths = null;
    
    private $exts = array('.php', 'class.php', 'lib.php');
    
    public static function init($appRoot)
    {
        if(self::$instance == null)
        {
            self::$instance = new self($appRoot);
        }
        return self::$instance;
    }
      
    private function __construct($appRoot)
    {
    	$this->incPaths = array(
	    	$appRoot . '/providers', 
	    	$appRoot . '/models', 
	    	$appRoot . '/lib'
    	);
    	
    	$this->incPaths = array_merge($this->incPaths, explode(PATH_SEPARATOR, get_include_path()));    	
    	
        spl_autoload_register(array($this, 'load'));        
    }
      
    private function load($class)
    {    	    	    
    	$classFilePath = str_replace('_', '/', $class) . '.php';
    	    	    	    	
    	foreach ($this->incPaths as $path)
    	{    		
    		$fullClassPath = $path . '/' . $classFilePath;     
    			
    		if (file_exists($fullClassPath)) 
        	{        		  		
    			require_once($fullClassPath);     			
  			}    	
    	}     	
    }
       	
}

?>
<?php
/**
 * Фабрика для создания провайдеров
 *
 * PHP version 5.3
 *
 * @category PHP
 * @package  WebService
 * @author   Eugene Kurbatov <eugene.kurbatov@gmail.com>
 * @license  license GPL
 * @version  SVN: $Id: APIProviderFactory.php 18.03.2011 17:18:57 evkur $
 * @link     nolink
 */
 
class APIProviderFactory
{
	const VKONTAKTE 	= "Vkontakte";
	const ODNOCLASSNIKI = "Odnoclassniki";
	const FACEBOOK 		= "Facebook";
	const MAILRU 		= "Mailru";
	const TWITTER 		= "Twitter";
	const LIVEJOURNAL 	= "Livejournal";
	
	/**
	 * типа Singleton, поэтому конструктор приватный
	 * 
	 * @return void  
	 */
	private function __construct() {}
	
	/**
	 * Cоздает объект провайдера и передам в конструткор 
	 * параметры из конфига соответсвующей секции,
	 * порядок параметров в ini-файле значения не имеет
	 *
	 * @param string $providerName Имя класса-провайдера	 
	 *
	 * @return object  
	 */
	public static function createProvider($providerName)
	{
		$providerName = strtolower($providerName);
		$providerClassName = ucfirst($providerName).'ApiProvider';
		$ref = new ReflectionClass($providerClassName);
		$refConstr = $ref->getConstructor();		
		$refConstrParams = $refConstr->getParameters();
	
		$params = array();		
		foreach ($refConstrParams as $constrParam)
		{		
			if ($constrParam->isOptional())
				$params[] = $constrParam->getDefaultValue();
			else 
				$params[] = APIConfigurator::getInstance()->get($providerName, $constrParam->getName());			
		}				
		return $ref->newInstanceArgs($params);								
	}
}
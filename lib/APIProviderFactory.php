<?php
class APIProviderFactory
{
	const VKONTAKTE 	= "Vkontakte";
	const ODNOCLASSNIKI = "Odnoclassniki";
	const FACEBOOK 		= "Facebook";
	const MAILRU 		= "Mailru";
	const TWITTER 		= "Twitter";
	const LIVEJOURNAL 	= "Livejournal";
	
	private function __construct() {}
	
	//создаем класс и передам в конструткор параметры и конфига соответсвующей секции
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
<?php
class APIProviderFactory
{
	const VKONTAKTE 	= "vkontakte";
	const ODNOCLASSNIKI = "odnoclassniki";
	const FACEBOOK 		= "facebook";
	const MAILRU 		= "mailru";
	const TWITTER 		= "twitter";
	const LIVEJOURNAL 	= "livejournal";
	
	private function __construct() {}
	
	public static function createProvider($alias)
	{
		switch ($alias) 
		{
			case self::VKONTAKTE:
				return new VKApiProvider(
						APIConfigurator::getInstance()->get(self::VKONTAKTE, 'appId'),
						APIConfigurator::getInstance()->get(self::VKONTAKTE, 'privateKey'),
						APIConfigurator::getInstance()->get(self::VKONTAKTE, 'login'),
						APIConfigurator::getInstance()->get(self::VKONTAKTE, 'pass')
					);
			break;
			case self::FACEBOOK:
				return new FacebookApiProvider(
					);
			break;
			case self::MAILRU:
				return new MailRuApiProvider(
						APIConfigurator::getInstance()->get(self::MAILRU, 'appId'),
						APIConfigurator::getInstance()->get(self::MAILRU, 'secretKey'),
						APIConfigurator::getInstance()->get(self::MAILRU, 'login'),
						APIConfigurator::getInstance()->get(self::MAILRU, 'pass')
					);
			break;	
			case self::ODNOCLASSNIKI:
				return new OdklApiProvider(
						APIConfigurator::getInstance()->get(self::ODNOCLASSNIKI, 'appId'),
						APIConfigurator::getInstance()->get(self::ODNOCLASSNIKI, 'publicKey'),
						APIConfigurator::getInstance()->get(self::ODNOCLASSNIKI, 'privateKey'),
						APIConfigurator::getInstance()->get(self::ODNOCLASSNIKI, 'login'),
						APIConfigurator::getInstance()->get(self::ODNOCLASSNIKI, 'pass')
					);
			break;
			case self::TWITTER:
				return new TwitterApiProvider();
			break;
			case self::LIVEJOURNAL:
				return new LiveJournalApiProvider();
			break;
			default:
				throw new APIException();
			break;
		}
	}
}
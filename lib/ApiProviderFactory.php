<?php
class ApiProviderFactory
{
	const VKOTAKTE = "vk";
	const ODNOCLASSNIKI = "odkl";
	const FACEBOOK = "fb";
	const MAILRU = "mr";
	const TWITTER = "tw";
	const LIVEJOURNAL = "lj";
	
	private function __construct() {}
	
	public static function createProvider($alias)
	{
		switch ($alias) 
		{
			case self::VKOTAKTE:
				return new VKApiProvider(
						APIConfigurator::getInstance()->get(self::VKOTAKTE, 'appId'),
						APIConfigurator::getInstance()->get(self::VKOTAKTE, 'privateKey'),
						APIConfigurator::getInstance()->get(self::VKOTAKTE, 'login'),
						APIConfigurator::getInstance()->get(self::VKOTAKTE, 'pass')
					);
			break;
			case self::FACEBOOK:
				return new FacebookApiProvider();
			break;
			case self::MAILRU:
				return new MailRuApiProvider();
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
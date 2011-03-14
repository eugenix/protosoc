<?php
$configs = array(
	'VK' => array(
		'APP_ID' 		=> 2215721,
		'PRIVATE_KEY' 	=> 'PNklLefcCI8t9DfMOVPI',
		'LOGIN' 		=> 'vivareal@list.ru',
		'PASS' 			=> 'valenly',
	)
);

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
				return new VKApiProvider(2215721, 'PNklLefcCI8t9DfMOVPI', 'vivareal@list.ru', 'valenly');
			break;
			case self::FACEBOOK:
				return new FacebookApiProvider();
			break;
			case self::MAILRU:
				return new MailRuApiProvider();
			break;	
			case self::ODNOCLASSNIKI:
				return new OdklApiProvider();
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
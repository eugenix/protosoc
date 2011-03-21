<?php
require_once 'providers/IAPIProvider.php';
require_once 'providers/BaseApiProvider.php';

class TestApiProvider extends BaseApiProvider
{
	protected $sessionPrefix = '_';
	
	/**
	 * Публичные свойства здесь только для тестирования
	 */	
	public $appId;
	public $apiUrl;
	public $secretToken;
	public $login;
	public $pass;
	
	function __construct($appId, $apiUrl, $secretToken, $login, $pass)
	{
		parent::__construct($appId, $apiUrl, $secretToken);

		$this->login = $login;
		$this->pass = $pass;
		
		$this->provideSessionData($login, $pass);
	}
	
	public function getFriends(){}
	
	public function getFriendsFeed()
	{
		return array(1, 12, 33, 48, 500);
	}
	
	public function getOnlineFriends(){}
	
	public function auth($login, $pass){}
	
	public function postStream($message) {}
}
<?php
/**
 * Провайдер для Graph API Facebook
 *
 * PHP version 5.3
 *
 * @category PHP
 * @package  WebService
 * @author   Eugene Kurbatov <eugene.kurbatov@gmail.com>
 * @license  license GPL
 * @version  SVN: $Id: FacebookApiProvider.php 21.03.2011 16:26:08 evkur $
 * @link     nolink
 */
 
require_once 'lib/facebook-sdk/facebook.php';

class FacebookApiProvider extends BaseApiProvider
{
	private $fb = null;
	
	function __construct($appId, $secretToken)
	{
		parent::__construct($appId, null, $secretToken);
		
		$this->fb = new Facebook(array(
			'appId'  => $appId,
  			'secret' => $secretToken,
  			'cookie' => true,
		));
											
		//$this->provideSessionData($login, $pass);
	
	}
	
	public function auth($login, $pass)
	{
		
	}
	
	public function getFriends()
	{
		try 
		{
			return $this->fb->api('/me/freinds');	
		} 
		catch (FacebookApiException $fe) 
		{
			throw new APIException($fe->getCode(), $fe->getMessage());
		}
		
		
	}
	
	public function getFriendsFeed(){}
	
	public function getOnlineFriends(){}		
	
	public function publish($message) {}
}
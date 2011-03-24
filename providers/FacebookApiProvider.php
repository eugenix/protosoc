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
											
		//$this->provideSessionData($login, $pass);
	
	}
	
	public function auth($login, $pass)
	{
		$my_url = "http://www.facebook.com/connect/login_success.html";
		
//		$dialog_url = "http://www.facebook.com/dialog/oauth?client_id=" 
//            . $this->appId . "&redirect_uri=" . urlencode($my_url);
           
            
        $dialog_url = "http://www.facebook.com/connect/uiserver.php?app_id="
        	. $this->appId ."&method=permissions.request&display=page&next="
        	. urlencode($my_url). "&response_type=code&fbconnect=1";
            
            
        $this->requester->setConfig('follow_redirects', false);
        $this->requester->setConfig('max_redirects', 2);
        $this->requester->setHeader(array(
   			'Referer'    => 'http://facebook.com/'
		));
        
        
        $this->requester->setUrl($dialog_url);
		$this->requester->setMethod(HTTP_Request2::METHOD_GET);
		$this->requester->setCookieJar();
		$response = $this->requester->send();

		$headers = $response->getHeader(); 
		$this->requester->setUrl($headers['location']);
		$response = $this->requester->send();
		
       	var_dump($response->getHeader());
        var_dump($response->getBody());
    	//$access_token = file_get_contents($token_url);
		
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
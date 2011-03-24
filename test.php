<?php

//require_once 'lib/twitter.lib.php';
//
//$twitter = new Twitter("eugenixus", "andromeda");
//$public_timeline = $twitter->getFriends();
//
//var_dump($public_timeline);
//



require_once 'lib/facebook-sdk/facebook.php';

$fb = new Facebook(array(
	'appId'  => '120629474678923',
  	'secret' => '81cf9c231d59cbd84e3c939b2fdc6ade',
  	'cookie' => false,
));

$url = $fb->getLoginUrl(array(  
    'req_perms' => 'email,user_birthday,status_update,publish_stream,user_photos,user_videos'  
));

echo $url;

exit();
$fbme = null;
// Session based graph API call.
if ($session) {
	echo 'You have session!';
	try {
		$uid = $fb->getUser ();
		$fbme = $fb->api ( '/me' );
	} catch ( FacebookApiException $e ) {
		d ( $e );
	}
} else {
	echo 'There is no session';
}






//
//require_once 'Services/Facebook.php';
//
//Services_Facebook::$apiKey = '120629474678923';
//Services_Facebook::$secret = '81cf9c231d59cbd84e3c939b2fdc6ade';
//
//$api = new Services_Facebook();
//
//echo $auth_token = $api->auth->createToken();
//echo $session = $api->auth->getSession($auth_token);
//$api->stream->publish('Test message');

//require_once 'Services/Twitter.php';
//require_once 'HTTP/OAuth/Consumer.php';
//
//define('CONSUMER_KEY', 'd2hMncBFsjf5f623r2U20w');
//define('CONSUMER_SECRET', 'e0B6QSTEzuzFNGJbXflZUCZjVhzJP4rRETOJb9X7c4');
//
//$httpRequest = new HTTP_Request2(null, HTTP_Request2::METHOD_GET, 
//		array('ssl_verify_peer'   => false, 'ssl_verify_host'   => false));
//		
//$httpRequest->setHeader('Accept-Encoding', '.*');
//$request = new HTTP_OAuth_Consumer_Request;
//$request->accept($httpRequest);
//
//
//$oauth = new HTTP_OAuth_Consumer(CONSUMER_KEY,CONSUMER_SECRET);
//$oauth->accept($request);
//
//$oauth->getRequestToken('https://api.twitter.com/oauth/request_token', "http://streetcoder.ru"); 
//
//$_SESSION['token']        = $oauth->getToken();
//$_SESSION['token_secret'] = $oauth->getTokenSecret();
//
//$authorize_link_twitter = $oauth->getAuthorizeUrl('https://api.twitter.com/oauth/authorize');
//


?>
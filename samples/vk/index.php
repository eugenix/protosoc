<?php
require 'vkapi.class.php';

//4623643

$api_id = 2215721; // Insert here id of your application
$secret_key = 'PNklLefcCI8t9DfMOVPI'; // Insert here secret key of your application

$VK = new vkapi($api_id, $secret_key);

//$resp = $VK->api('getProfiles', array('uids'=>'4623643'));

//$resp = $VK->api('friends.get', array('uid'=>'4623643'));

//$resp = $VK->api('getUserSettings', array('uid'=>'4623643'));




//not work
//$resp = $VK->api('friends.getOnline', array('uid'=>'4623643'));

//$resp = $VK->api('wall.get', array('owner_id'=>'4623643'));


dump($resp);

function dump($var)
{
	echo '<pre>';
	print_r($var);
	echo '</pre>';	
}

?>

<?php
require('MyApi.class.php');
 
$app_id = '487011';
$app_secret = '456b0bcc7af9e141b80f123f0a1abc58';
 
 
$uids = Array('236708913');
$text = 'http://flapps.ru';
 
function get_url($query) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $query);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    return curl_exec($ch);
    curl_close($ch);
}
 
 
$api = new MyApiNode($app_id, $app_secret);
$query = $api->sendNotifications($uids, $text);
get_url($query);
 
echo "sended";
?>
<?php

//http://api-sandbox.odnoklassniki.ru:8088/api/fb.do?method=friends.get

class odnklapi {
	private $applicationKey;
	private $appcilationSecretKey;
	private $appId;
	private $apiUrl;
	
	function __construct($applicationKey, $appcilationSecretKey, $appId, $apiUrl) {
		$this->appId = $appId;
		$this->applicationKey = $applicationKey;
		$this->appcilationSecretKey = $appcilationSecretKey;
		$this->apiUrl = $apiUrl;
	}
	
	public function api($method, $params=false) {
		if (!$params) 
			$params = array(); 
		$params['application_key'] = $this->applicationKey;		
		$params['method'] = $method;
		$params['format'] = 'JSON';
		ksort($params);
		$sig = '';
		foreach($params as $k=>$v) {
			$sig .= $k.'='.$v;
		}
		
				
		if (isset($params['session_secret_key'])) {
			$sig .= $params['session_secret_key'];
		} else {
			$sig .= $this->appcilationSecretKey;
		}
		
		echo $sig;
		
		$params['sig'] = md5($sig);
		$query = $this->apiUrl.'?'.http_build_query($params);
		$res = file_get_contents($query);
		return json_decode($res, true);
	}	
}

function dump($var)
{
	echo '<pre>';
	print_r($var);
	echo '</pre>';	
}


$odnklapi = new odnklapi(
	'CBAEJBABABABABABA', 
	'SampleAppSecret',
	'37632', 
	'http://api-sandbox.odnoklassniki.ru:8088/api/fb.do'
);

//$sess = $odnklapi->api('auth.login', 
//	array('user_name' => 'eugene.kurbatov', 'password' => 'eugene.kurbatov_pwd', 'gen_token' => true));
//
//dump($sess);	
	
$result = $odnklapi->api('stream.publish', array(
	'session_key' => 'FDGFHDHDGJGPGOCADBDCDJDJDIDDDBDCDDDHDDDJDDDJDIDJDADAK', 
	'session_secret_key' => 'd41d8cd98f00b204e9800998ecf8427e', 
	'message' => 'Just test message')); 	
	
dump($result);


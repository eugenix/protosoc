<?php
class OdnoklassnikiAppRestException extends Exception {
}

class OdnoklassnikiAppRest {
	private $__m_appkey;
	private $__m_apiserver;
	private $__m_appsecret;
	private $__m_sesskey;
	private $__m_sesssecret;
	
	public function __construct($restserverurl, $appkey, $appsecret, $sesskey, $sesssecret) {
		$this->__m_appkey = $appkey;
		$this->__m_appsecret = $appsecret;
		$this->__m_sesskey = $sesskey;
		$this->__m_apiserver = $restserverurl;
		$this->__m_sesssecret = $sesssecret;
	}
	
	private static function __parse_headers($headers) {
		$retval = array ();
		
		$l_chunks = preg_split ( "/\r\n|\n/", $headers );
		array_shift ( $l_chunks );
		
		foreach ( $l_chunks as $l_i => $l_line ) {
			if ($l_line) {
				list ( $l_name, $l_value ) = explode ( ":", $l_line, 2 );
				$retval [trim ( $l_name )] = trim ( $l_value );
			}
			;
		}		
		
		return $retval;
	}
	
	private function __makerpc($url) {
		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_HEADER, true );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, 1 );
		curl_setopt ( $ch, CURLOPT_TIMEOUT, 3 );
		
		$l_response = curl_exec ( $ch );
		
		if (! curl_errno ( $ch )) {
			$l_responceinfo = curl_getinfo ( $ch );
			curl_close ( $ch );
			
			$l_headers = self::__parse_headers ( substr ( $l_response, 0, $l_responceinfo ['header_size'] ) );
			$l_result = json_decode ( substr ( $l_response, $l_responceinfo ['header_size'] ), true );
			
			if (array_key_exists ( 'invocation-error', $l_headers )) {
				throw new OdnoklassnikiAppRestException ( $l_result ['error_msg'], $l_result ['error_code'] );
			}			
			
			return $l_result;
		} else {
			$err = curl_error ( $ch );
			curl_close ( $ch );
			
			throw new OdnoklassnikiAppRestException ( $err );
		}
		
	}
	
	private function __makecall($method, $params = array()) {
		$l_params = array ("application_key" => $this->__m_appkey, "format" => "JSON" );
		$l_params = array_merge ( $l_params, $params );
		
		if (! array_key_exists ( "uid", $l_params )) {
			$l_params ["session_key"] = $this->__m_sesskey;
		} else {
			unset ( $l_params ["session_key"] );
		}		
		
		ksort ( $l_params );
		$l_params_str = "";
		
		foreach ( $l_params as $l_key => $l_value ) {
			$l_params_str .= sprintf ( "%s=%s", $l_key, $l_value );
		}	
		
		$l_params_str .= array_key_exists ( 'session_key', $l_params ) ? $this->__m_sesssecret : $this->__m_appsecret;
		$l_params ["sig"] = md5 ( $l_params_str );
		
		$l_url = sprintf ( "%sapi/%s?", $this->__m_apiserver, $method );
		$l_begin = true;
		
		foreach ( $l_params as $key => $value ) {
			$l_url .= $l_begin ? '' : '&';
			$l_begin = false;
			
			$l_url .= sprintf ( "%s=%s", $key, urlencode ( $value ) );
		}		
		
		return $this->__makerpc ( $l_url );
	}
	
	public function users_getInfo($uids) {
		$l_count = count ( $uids );
		
		if ($l_count) {
			$l_retval = array ();
			$_reqcount = ( int ) (($l_count + 99) / 100);
			
			for($l_i = 0; $l_i < $_reqcount; ++ $l_i) {
				$l_uids = array_slice ( $uids, $l_i * 100, 100 );
				$l_result = $this->__makecall ( "users/getInfo", array ("fields" => "uid,first_name,last_name,birthday,gender,pic_1", "uids" => join ( ',', $l_uids ) ) );
				$l_retval = array_merge ( $l_retval, is_array ( $l_result ) ? $l_result : array () );
			}			
			
			return $l_retval;
		} else {
			return array ();
		}		
	}
	
	public function friends_getAppUsers() {
		$result = $this->__makecall ( "friends/getAppUsers" );
		return is_array ( $result ["uids"] ) ? $result ["uids"] : array ();
	}
	
	public function friends_get() {
		return $this->__makecall ( "friends/get" );
	}
}
?>
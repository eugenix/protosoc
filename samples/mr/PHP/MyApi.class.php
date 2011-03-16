<?
/*

Библиотека для работы с API Мой Мир@Mail.Ru

http://flapps.ru/forum/ - форум о создании флеш приложений с использованием API различных социальных сетей

*/
class MyApiNode
{
	public function __construct ($app_id,
									$secret, 
									$format = 'XML',
									$secure = '1',
									$server_url = 'http://www.appsmail.ru/platform/api?')
	{
		$this->app_id = $app_id;
		$this->method = $method;
		$this->secret = $secret;
		$this->format = $format;
		$this->secure = $secure;
		$this->server_url = $server_url;
	}
	
	public function sendNotifications ($uids, $text)
	{
		$api = new MyApi($this->app_id,
							'notifications.send',
							$this->secret,
							$this->format,
							$this->secure,
							$this->server_url);
		$api->addParameter('uids', join(',', $uids));
		$api->addParameter('text', $text);
		return $api->getQuery();
	}

	public function widgetSet ($uid, $html)
	{
		$api = new MyApi($this->app_id,
							'widget.set',
							$this->secret,
							$this->format,
							$this->secure,
							$this->server_url);
		$api->addParameter('uid', $uid);
		$api->addParameter('html', $html);
		return $api->getQuery();
	}
}


class MyApi
{	
	public function __construct ($app_id,
									$method,
									$secret, 
									$format,
									$this->secure,
									$server_url)
	{
		$this->app_id = $app_id;
		$this->method = $method;
		$this->secret = $secret;
		$this->format = $format;
		$this->server_url = $server_url;


		$this->parameters = array();

		$this->parameters[] = array('name' => 'app_id', 'value' => $this->app_id);
		$this->parameters[] = array('name' => 'method', 'value' => $this->method);
		$this->parameters[] = array('name' => 'format', 'value' => $this->format);
		$this->parameters[] = array('name' => 'secure', 'value' => $this->secure);
	}

	public function __toString ()
	{
		$this->parameters[] = array('name' => 'sig', 'value' => $this->getSig());

		foreach($this->parameters as $p) 
			$query[] = $p['name'].'='.rawurlencode($p['value']);


		return $this->server_url . join('&', $query);
	}

	public function addParameter ($p_name, $p_value)
	{
		$this->parameters[] = array('name' => $p_name, 'value' => $p_value);
	}
	
	public function getQuery ()
	{
		return $this->__toString();
	}
	
	private function getSig ()
	{
		sort($this->parameters);
		
		foreach($this->parameters as $p)
			$sigStr .= join('=',$p);
		return md5($sigStr . $this->secret);
	}
}

?>
<?php
/**
 * Специальное исключение для API
 *
 * PHP version 5.3
 *
 * @category PHP
 * @package  WebService
 * @author   Eugene Kurbatov <eugene.kurbatov@gmail.com>
 * @license  license GPL
 * @version  SVN: $Id: APIException.php 18.03.2011 17:03:54 evkur $
 * @link     nolink
 */
 
class APIException extends Exception 
{
	function __construct($code, $message)
	{
		$this->code = $code;
		$this->message = $message;		
	}
}
?>
<?php
/**
 * Специальное исключение, генерируемое методами API
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
<?php
/**
 * Точка входа в API
 */
require_once 'init.php';

$invoke = $_GET['invoke'];

try 
{
	list($providerName, $methodName) = explode('.', $invoke); 

	$handler = APIHandler::getInstance();	
	
	$res = $handler->executeMethod($providerName, $methodName, APIHandler::getFixedParams($_GET));	
	
	APIHandler::sendResponse($res);	
} 
catch (APIException $apie)
{
	APIHandler::sendError($apie->getCode(), $apie->getMessage());
}
catch (Exception $e) 
{
	APIHandler::sendError($e->getCode(), $e->getMessage());
}



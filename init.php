<?php
/**
 * Инициализация приложения
 *
 * PHP version 5.3
 *
 * @category PHP
 * @package  WebService
 * @author   Eugene Kurbatov <eugene.kurbatov@gmail.com>
 * @license  license GPL
 * @version  SVN: $Id: init.php 23.03.2011 17:21:33 evkur $
 * @link     nolink
 */
 		
error_reporting(E_ALL);

session_start();

define('APP_ROOT', dirname(__FILE__));

require_once APP_ROOT.'/lib/APIAutoLoader.php';

APIAutoLoader::init(APP_ROOT);

APIConfigurator::getInstance()->init('config.ini');





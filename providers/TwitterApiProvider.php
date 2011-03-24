<?php
/**
 * TODO: eugene: Добавить здесь комментарий
 *
 * PHP version 5.3
 *
 * @category PHP
 * @package  WebService
 * @author   Eugene Kurbatov <eugene.kurbatov@gmail.com>
 * @license  license GPL
 * @version  SVN: $Id: TwitterApiProvider.php 21.03.2011 16:26:51 evkur $
 * @link     nolink
 */
 
class TwitterApiProvider extends BaseApiProvider
{
	public function getFriends()
	{
		
	}
	
	public function getFriendsFeed(){}
	
	public function getOnlineFriends(){}
	
	public function auth($login, $pass){}
	
	public function publish($message) {}
}
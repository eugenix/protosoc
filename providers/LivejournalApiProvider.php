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
 * @version  SVN: $Id: LivejournalApiProvider.php 21.03.2011 16:26:20 evkur $
 * @link     nolink
 */
 
class LivejournalApiProvider extends BaseApiProvider
{
	public function getFriends(){}
	
	public function getFriendsFeed(){}
	
	public function getOnlineFriends(){}
	
	public function auth($login, $pass){}
	
	public function publish($message) {}
}
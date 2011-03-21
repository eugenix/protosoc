<?php
/**
 * Интерфейс провайдера
 *
 * PHP version 5.3
 *
 * @category PHP
 * @package  WebService
 * @author   Eugene Kurbatov <eugene.kurbatov@gmail.com>
 * @license  license GPL
 * @version  SVN: $Id: IAPIProvider.php 21.03.2011 15:52:55 evkur $
 * @link     nolink
 */
 
interface IAPIProvider
{
	/**
	 * Авторизауется от пользователя и возвращает данные сессии
	 *
	 * @param string $login Логин пользователя
	 * @param string $pass Пароль пользователя
	 * 
	 * @return array
	 */
	public function auth($login, $pass);
		
	/**
	 * Возвращает друзей, которые онлайн
	 *
	 * @return array
	 */
	public function getOnlineFriends();
	
	/**
	 * Возвращает всех друзей
	 *
	 * @return array
	 */
	public function getFriends();
		
	/**
	 * Публикует сообщение на стене пользователя
	 *
	 * @param MessageEntity $message Объект сообщения
	 * 
	 * @return MessageEntity
	 */
	public function publish($message);
		
	/**
	 * Возвращает ленту друзей
	 *
	 * @return array
	 */
	public function getFriendsFeed();
				 
}
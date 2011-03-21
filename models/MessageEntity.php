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
 * @version  SVN: $Id: MessageEntity.php 21.03.2011 14:37:12 evkur $
 * @link     nolink
 */
 
require_once 'models/BaseEntity.php';

class MessageEntity extends BaseEntity 
{
	private $text = null;
	
	function __construct($text) 
	{	
		$this->text = $text;	
	}
	
	/**
	 * Возвращает текст сообщения 
	 *
	 * @return $text
	 */
	public function getText() {
		return $this->text;
	}

	/**
	 * Устанавливает текст сообщения
	 *
	 * @param field_type $text
	 *
	 * @return void
	 */
	public function setText($text) {
		$this->text = $text;
	}	
}

?>
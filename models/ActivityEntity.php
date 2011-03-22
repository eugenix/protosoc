<?php
/**
 * Представляет событие в ленте друзей (новости): посты, изменения статусов, комментарии, заметки
 *
 * PHP version 5.3
 *
 * @category PHP
 * @package  WebService
 * @author   Eugene Kurbatov <eugene.kurbatov@gmail.com>
 * @license  license GPL
 * @version  SVN: $Id: ActivityEntity.php 21.03.2011 14:32:16 evkur $
 * @link     nolink
 */
 
require_once 'models/BaseEntity.php';

class ActivityEntity extends BaseEntity 
{
	const POST = 'POST';
	
	/**
	 * Тип новости
	 *
	 * @var string
	 */
	private $type = null;
	
	/**
	 * Текст новости
	 *
	 * @var string
	 */
	private $text = null;
	
	/**
	 * Заголовок новости
	 *
	 * @var string
	 */
	private $title = null;
	
	/**
	 * Дата публикации новости
	 *
	 * @var string
	 */
	private $date = null;
	
	/**
	 * Id автора новости
	 *
	 * @var int
	 */
	private $authorId = null;

	/**
	 * Конструктор
	 *
	 * @param string $type Тип новости
	 * @param string $title Текст новости
	 * @param string $text Заголовок новости
	 * @param string $date Дата публикации новости
	 */
	function __construct($type = null, $title = null, $text = null, $date = null, $authorId = null)	 
	{
		$this->type = $type;
		$this->title = $title;
		$this->text = $text;
		$this->date = $date;	
		$this->authorId = $authorId;
	}
	/**
	 * Возвращает id автора
	 *
	 * @return $authorId
	 */
	public function getAuthorId() {
		return $this->authorId;
	}

	/**
	 * Устанавливает id автора
	 *
	 * @param int $authorId
	 *
	 * @return void
	 */
	public function setAuthorId($authorId) {
		$this->authorId = $authorId;
	}
	
	/**
	 * Возвращает тип новости
	 *
	 * @return string
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * Возвращает текст новости
	 *
	 * @return string
	 */
	public function getText() {
		return $this->text;
	}

	/**
	 * Возвращает заголовок новости
	 *
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Возвращает дату публикации новости
	 *
	 * @return string
	 */
	public function getDate() {
		return $this->date;
	}

	/**
	 * Устанавливает тип новости
	 *
	 * @param string $type
	 *
	 * @return void
	 */
	public function setType($type) {
		$this->type = $type;
	}

	/**
	 * Устанавливает текст новости
	 *
	 * @param string $text
	 *
	 * @return void
	 */
	public function setText($text) {
		$this->text = $text;
	}

	/**
	 * Устанавливает заголовок новотси
	 *
	 * @param string $title
	 *
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Устанавливает дату публикации новости
	 *
	 * @param string $date
	 *
	 * @return void
	 */
	public function setDate($date) {
		$this->date = $date;
	}

	
	
}

?>
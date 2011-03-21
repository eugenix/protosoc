<?php
/**
 * Представляет человека в социальном сервисе
 *
 * PHP version 5.3
 *
 * @category PHP
 * @package  WebService
 * @author   Eugene Kurbatov <eugene.kurbatov@gmail.com>
 * @license  license GPL
 * @version  SVN: $Id: PersonEntity.php 21.03.2011 14:02:25 evkur $
 * @link     nolink
 */
 
require_once 'models/BaseEntity.php';

class PersonEntity extends BaseEntity 
{
	/**
	 * Имя персоны
	 *
	 * @var string
	 */
	private $name = null;
	
	/**
	 * Фамилия персоны
	 *
	 * @var string
	 */
	private $surname = null;
	
	/**
	 * Дата рождения
	 *
	 * @var string
	 */
	private $birthday = null;
	
	/**
	 * Конструктор
	 *
	 * @param string $name Имя персоны
	 * @param string $surname Фамилия персоны
	 * @param string $birthday Дата рождения
	 *
	 * @return void  
	 */
	public function __construct($name, $surname, $birthday)
	{
		$this->name = $name;
		$this->surname = $surname;
		$this->birthday = $birthday;
	}
	
	
	/**
	 * Возвращает имя персоны
	 *
	 * @return string	   
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Возвращает фамилию персоны
	 * 
	 * @return string
	 */
	public function getSurname() {
		return $this->surname;
	}

	/**
	 * Возвращает дату рождения
	 * 
	 * @return string
	 */
	public function getBirthday() {
		return $this->birthday;
	}

	/**
	 * Устанавливает имя персоны
	 * 
	 * @param string $name
	 * 
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Устанавливает фамилию персоны
	 * 
	 * @param string $surname
	 * 
	 * @return void
	 */
	public function setSurname($surname) {
		$this->surname = $surname;
	}

	/**
	 * Устанавливает дату рождения персоны
	 * 
	 * @param string $birthday
	 * 
	 * @return void
	 */
	public function setBirthday($birthday) {
		$this->birthday = $birthday;
	}

	
	
}

?>
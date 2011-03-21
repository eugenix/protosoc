<?php
/**
 * Базовый класс сущности модели
 *
 * PHP version 5.3
 *
 * @category PHP
 * @package  WebService
 * @author   Eugene Kurbatov <eugene.kurbatov@gmail.com>
 * @license  license GPL
 * @version  SVN: $Id: BaseEntity.php 21.03.2011 13:55:47 evkur $
 * @link     nolink
 */
 
abstract class BaseEntity 
{
	/**
	 * Id сущности
	 *
	 * @var int
	 */
	private $id = null;
	
	
	/**
	 * Возвращает идентификатор сущности	 	 
	 *
	 * @return int  
	 */
	public function getId() {
		return $this->id;
	}

	
	/**
	 * Установка идентификатора сущности
	 *
	 * @param int $id Id сущности
	 *
	 * @return void  
	 */
	public function setId($id) {
		$this->id = $id;
	}

}

?>
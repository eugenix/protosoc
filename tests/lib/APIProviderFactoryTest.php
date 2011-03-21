<?php

require_once 'init.php';
require_once dirname(__FILE__).'/../data/TestApiProvider.php';

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * APIProviderFactory test case.
 */
class APIProviderFactoryTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * @var APIProviderFactory
	 */
	private $APIProviderFactory;
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp() {
		parent::setUp ();	
		APIConfigurator::getInstance()->init(dirname(__FILE__).'/../data/config.ini');
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {		
		parent::tearDown ();
	}
	
	/**
	 * Constructs the test case.
	 */
	public function __construct() {
		// TODO Auto-generated constructor
	}
	
	/**
	 * Tests APIProviderFactory::createProvider()
	 */
	public function testCreateProvider() {						
		$this->assertTrue(APIProviderFactory::createProvider('Test') instanceof TestApiProvider);
		$this->assertTrue(APIProviderFactory::createProvider('test') instanceof TestApiProvider);	
		
		try {
			$this->assertTrue(APIProviderFactory::createProvider('invalid') instanceof TestApiProvider);
			$this->assertTrue(false);	
		} catch (ReflectionException $re) {
			$this->assertTrue(true);			
		}		
	}
	
	/**	 
	 * Тест на правильность получения параметров из файла конфигурации	 
	 */
	public function testGettingParams() {
		$testProvider = APIProviderFactory::createProvider('Test');
		
		$prop = new ReflectionProperty('TestApiProvider', 'appId');		
		$this->assertEquals(APIConfigurator::getInstance()->get('test', 'appId'), $prop->getValue($testProvider));		
		
		$prop = new ReflectionProperty('TestApiProvider', 'apiUrl');		
		$this->assertEquals(APIConfigurator::getInstance()->get('test', 'apiUrl'), $prop->getValue($testProvider));
		
		$prop = new ReflectionProperty('TestApiProvider', 'secretToken');		
		$this->assertEquals(APIConfigurator::getInstance()->get('test', 'secretToken'), $prop->getValue($testProvider));
		
		$prop = new ReflectionProperty('TestApiProvider', 'login');		
		$this->assertEquals(APIConfigurator::getInstance()->get('test', 'login'), $prop->getValue($testProvider));
		
		$prop = new ReflectionProperty('TestApiProvider', 'pass');		
		$this->assertEquals(APIConfigurator::getInstance()->get('test', 'pass'), $prop->getValue($testProvider));			
	}

}


<?php
/**
 * APIConfigurator test case.
 */
class APIConfiguratorTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * @var APIConfigurator
	 */
	private $APIConfigurator;
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp() {
		parent::setUp ();	
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		$this->APIConfigurator = null;
		
		parent::tearDown ();
	}
	
	/**
	 * Constructs the test case.
	 */
	public function __construct() {				
	}
	
	public function test__construct() {
		$ref = new ReflectionClass('APIConfigurator');
		$refConstr = $ref->getConstructor();		
		$this->assertTrue($refConstr->isPrivate(), 'Конструктор должен быть приватный');				
	}
	
	/**
	 * Tests APIConfigurator->__clone()
	 */
	public function test__clone() {
		try {
			clone APIConfigurator::getInstance();
			$this->assertTrue(false, 'Клонирование запрещено');			
		} catch (Exception $e) {
			$this->assertTrue(true, 'Клонирование запрещено');
		}		
	}
	
	/**
	 * Tests APIConfigurator::getInstance()
	 */
	public function testGetInstance() {				
		$this->assertNotNull(APIConfigurator::getInstance());
		$this->assertTrue(APIConfigurator::getInstance() instanceof APIConfigurator);
	}
	
	/**
	 * Tests APIConfigurator::getInstance()->init($filename)
	 */
	public function testInit() {		
		$this->assertEquals(file_exists(dirname(__FILE__).'/../data/config.ini'), true);
		APIConfigurator::getInstance()->init('../data/config.ini');	
		$this->assertTrue(true);
	}
	
	/**
	 * Tests APIConfigurator->get()
	 */
	public function testGet() {			
		$this->assertEquals(file_exists(dirname(__FILE__).'/../data/config.ini'), true);
		APIConfigurator::getInstance()->init(dirname(__FILE__).'/../data/config.ini');	
		$this->assertEquals(APIConfigurator::getInstance()->get('test', 'appId'), '37632');	
		$this->assertEquals(APIConfigurator::getInstance()->get('test', 'publicKey'), 'CBAEJBABABABABABA');
	
	}

}


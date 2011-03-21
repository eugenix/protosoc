<?php

require_once 'init.php';
require_once dirname(__FILE__).'/../data/TestApiProvider.php';


require_once 'PHPUnit/Framework/TestCase.php';

/**
 * APIHandler test case.
 */
class APIHandlerTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * @var APIHandler
	 */
	private $APIHandler;
	private $testParams;
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp() {
		parent::setUp ();	
		
		$this->testParams = array('invoke' => 'method', 'param1' => 'value1');
		APIConfigurator::getInstance()->init(dirname(__FILE__).'/../data/config.ini');	
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
		$ref = new ReflectionClass('APIHandler');
		$refConstr = $ref->getConstructor();		
		$this->assertTrue($refConstr->isPrivate(), 'Конструктор должен быть приватный');		
	}
	
	/**
	 * Tests APIConfigurator->__clone()
	 */
	public function test__clone() {
		try {
			clone APIHandler::getInstance();
			$this->assertTrue(false, 'Клонирование запрещено');			
		} catch (Exception $e) {
			$this->assertTrue(true, 'Клонирование запрещено');
		}		
	}
	
	/**
	 * Tests APIConfigurator::getInstance()
	 */
	public function testGetInstance() {				
		$this->assertNotNull(APIHandler::getInstance());
		$this->assertTrue(APIHandler::getInstance() instanceof APIHandler);
	}
		
	/**
	 * Tests APIHandler->executeMethod()
	 */
	public function testExecuteMethod() {
		$result = APIHandler::getInstance()->executeMethod('Test', 'getFriendsFeed', $this->testParams);
		$this->assertEquals(array(1, 12, 33, 48, 500), $result);
	
	}
	
	/**
	 * Tests APIHandler::getFixedParams()
	 */
	public function testGetFixedParams() {				
		$testFixedParams = APIHandler::getFixedParams($this->testParams);
		
		$this->assertEquals(count($testFixedParams), 1);
		$this->assertEquals(isset($testFixedParams['invoke']), false);
	
	}
	
	/**
	 * Tests APIHandler::sendResponse()
	 */
	public function testSendResponse() {		
		ob_start();
		
		APIHandler::sendResponse("This is result");
		
		$out = ob_get_clean();
		
		//TODO: eugene: сделать проверку на формат возвращаемых значений
		$this->assertGreaterThan(0, strlen($out));
	
	}
	
	/**
	 * Tests APIHandler::sendError()
	 */
	public function testSendError() {
		ob_start();
		
		APIHandler::sendError(100, "This is error");
		
		$out = ob_get_clean();
		
		//TODO: eugene: сделать проверку на формат возвращаемых значений
		$this->assertGreaterThan(0, strlen($out));
	
	}

}


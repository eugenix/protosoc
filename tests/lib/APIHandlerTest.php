<?php

require_once 'lib/APIHandler.php';

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * APIHandler test case.
 */
class APIHandlerTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * @var APIHandler
	 */
	private $APIHandler;
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp() {
		parent::setUp ();
		
		// TODO Auto-generated APIHandlerTest::setUp()
		

		$this->APIHandler = new APIHandler(/* parameters */);
	
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		// TODO Auto-generated APIHandlerTest::tearDown()
		

		$this->APIHandler = null;
		
		parent::tearDown ();
	}
	
	/**
	 * Constructs the test case.
	 */
	public function __construct() {
		// TODO Auto-generated constructor
	}
	
	/**
	 * Tests APIHandler->__clone()
	 */
	public function test__clone() {
		// TODO Auto-generated APIHandlerTest->test__clone()
		$this->markTestIncomplete ( "__clone test not implemented" );
		
		$this->APIHandler->__clone(/* parameters */);
	
	}
	
	/**
	 * Tests APIHandler::getInstance()
	 */
	public function testGetInstance() {
		// TODO Auto-generated APIHandlerTest::testGetInstance()
		$this->markTestIncomplete ( "getInstance test not implemented" );
		
		APIHandler::getInstance(/* parameters */);
	
	}
	
	/**
	 * Tests APIHandler->init()
	 */
	public function testInit() {
		// TODO Auto-generated APIHandlerTest->testInit()
		$this->markTestIncomplete ( "init test not implemented" );
		
		$this->APIHandler->init(/* parameters */);
	
	}
	
	/**
	 * Tests APIHandler->executeMethod()
	 */
	public function testExecuteMethod() {
		// TODO Auto-generated APIHandlerTest->testExecuteMethod()
		$this->markTestIncomplete ( "executeMethod test not implemented" );
		
		$this->APIHandler->executeMethod(/* parameters */);
	
	}
	
	/**
	 * Tests APIHandler::getFixedParams()
	 */
	public function testGetFixedParams() {
		// TODO Auto-generated APIHandlerTest::testGetFixedParams()
		$this->markTestIncomplete ( "getFixedParams test not implemented" );
		
		APIHandler::getFixedParams(/* parameters */);
	
	}
	
	/**
	 * Tests APIHandler::sendResponse()
	 */
	public function testSendResponse() {
		// TODO Auto-generated APIHandlerTest::testSendResponse()
		$this->markTestIncomplete ( "sendResponse test not implemented" );
		
		APIHandler::sendResponse(/* parameters */);
	
	}
	
	/**
	 * Tests APIHandler::sendError()
	 */
	public function testSendError() {
		// TODO Auto-generated APIHandlerTest::testSendError()
		$this->markTestIncomplete ( "sendError test not implemented" );
		
		APIHandler::sendError(/* parameters */);
	
	}

}


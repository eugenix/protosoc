<?php

/**
 * APIException test case.
 */
class APIExceptionTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * @var APIException
	 */
	private $APIException;
	
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
		// TODO Auto-generated APIExceptionTest::tearDown()
		

		$this->APIException = null;
		
		parent::tearDown ();
	}
	
	/**
	 * Constructs the test case.
	 */
	public function __construct() {
		// TODO Auto-generated constructor
	}
	
	/**
	 * Tests APIException->__construct()
	 */
	public function test__construct() {		
		$this->APIException = new APIException(0, "Description");
	
		$this->assertEquals($this->APIException->getCode(), 0);
		$this->assertEquals($this->APIException->getMessage(), "Description");
	}

}


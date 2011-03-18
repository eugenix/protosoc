<?php

require_once 'lib/APIProviderFactory.php';

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
		
		// TODO Auto-generated APIProviderFactoryTest::setUp()
		

		$this->APIProviderFactory = new APIProviderFactory(/* parameters */);
	
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		// TODO Auto-generated APIProviderFactoryTest::tearDown()
		

		$this->APIProviderFactory = null;
		
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
		// TODO Auto-generated APIProviderFactoryTest::testCreateProvider()
		$this->markTestIncomplete ( "createProvider test not implemented" );
		
		APIProviderFactory::createProvider(/* parameters */);
	
	}

}


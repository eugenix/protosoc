<?php

require_once 'providers/OdnoclassnikiApiProvider.php';

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * OdnoclassnikiApiProvider test case.
 */
class OdnoclassnikiApiProviderTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * @var OdnoclassnikiApiProvider
	 */
	private $OdnoclassnikiApiProvider;
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp() {
		parent::setUp ();
		
		// TODO Auto-generated OdnoclassnikiApiProviderTest::setUp()
		

		$this->OdnoclassnikiApiProvider = new OdnoclassnikiApiProvider(/* parameters */);
	
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		// TODO Auto-generated OdnoclassnikiApiProviderTest::tearDown()
		

		$this->OdnoclassnikiApiProvider = null;
		
		parent::tearDown ();
	}
	
	/**
	 * Constructs the test case.
	 */
	public function __construct() {
		// TODO Auto-generated constructor
	}
	
	/**
	 * Tests OdnoclassnikiApiProvider->__construct()
	 */
	public function test__construct() {
		// TODO Auto-generated OdnoclassnikiApiProviderTest->test__construct()
		$this->markTestIncomplete ( "__construct test not implemented" );
		
		$this->OdnoclassnikiApiProvider->__construct(/* parameters */);
	
	}
	
	/**
	 * Tests OdnoclassnikiApiProvider->getFriends()
	 */
	public function testGetFriends() {
		// TODO Auto-generated OdnoclassnikiApiProviderTest->testGetFriends()
		$this->markTestIncomplete ( "getFriends test not implemented" );
		
		$this->OdnoclassnikiApiProvider->getFriends(/* parameters */);
	
	}
	
	/**
	 * Tests OdnoclassnikiApiProvider->getFriendsFeed()
	 */
	public function testGetFriendsFeed() {
		// TODO Auto-generated OdnoclassnikiApiProviderTest->testGetFriendsFeed()
		$this->markTestIncomplete ( "getFriendsFeed test not implemented" );
		
		$this->OdnoclassnikiApiProvider->getFriendsFeed(/* parameters */);
	
	}
	
	/**
	 * Tests OdnoclassnikiApiProvider->getOnlineFriends()
	 */
	public function testGetOnlineFriends() {
		// TODO Auto-generated OdnoclassnikiApiProviderTest->testGetOnlineFriends()
		$this->markTestIncomplete ( "getOnlineFriends test not implemented" );
		
		$this->OdnoclassnikiApiProvider->getOnlineFriends(/* parameters */);
	
	}
	
	/**
	 * Tests OdnoclassnikiApiProvider->auth()
	 */
	public function testAuth() {
		// TODO Auto-generated OdnoclassnikiApiProviderTest->testAuth()
		$this->markTestIncomplete ( "auth test not implemented" );
		
		$this->OdnoclassnikiApiProvider->auth(/* parameters */);
	
	}
	
	/**
	 * Tests OdnoclassnikiApiProvider->postStream()
	 */
	public function testPostStream() {
		// TODO Auto-generated OdnoclassnikiApiProviderTest->testPostStream()
		$this->markTestIncomplete ( "postStream test not implemented" );
		
		$this->OdnoclassnikiApiProvider->postStream(/* parameters */);
	
	}

}


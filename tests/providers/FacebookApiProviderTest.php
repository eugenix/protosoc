<?php

require_once 'providers/FacebookApiProvider.php';

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * FacebookApiProvider test case.
 */
class FacebookApiProviderTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * @var FacebookApiProvider
	 */
	private $FacebookApiProvider;
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp() {
		parent::setUp ();
		
		// TODO Auto-generated FacebookApiProviderTest::setUp()
		

		$this->FacebookApiProvider = new FacebookApiProvider(/* parameters */);
	
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		// TODO Auto-generated FacebookApiProviderTest::tearDown()
		

		$this->FacebookApiProvider = null;
		
		parent::tearDown ();
	}
	
	/**
	 * Constructs the test case.
	 */
	public function __construct() {
		// TODO Auto-generated constructor
	}
	
	/**
	 * Tests FacebookApiProvider->getFriends()
	 */
	public function testGetFriends() {
		// TODO Auto-generated FacebookApiProviderTest->testGetFriends()
		$this->markTestIncomplete ( "getFriends test not implemented" );
		
		$this->FacebookApiProvider->getFriends(/* parameters */);
	
	}
	
	/**
	 * Tests FacebookApiProvider->getFriendsFeed()
	 */
	public function testGetFriendsFeed() {
		// TODO Auto-generated FacebookApiProviderTest->testGetFriendsFeed()
		$this->markTestIncomplete ( "getFriendsFeed test not implemented" );
		
		$this->FacebookApiProvider->getFriendsFeed(/* parameters */);
	
	}
	
	/**
	 * Tests FacebookApiProvider->getOnlineFriends()
	 */
	public function testGetOnlineFriends() {
		// TODO Auto-generated FacebookApiProviderTest->testGetOnlineFriends()
		$this->markTestIncomplete ( "getOnlineFriends test not implemented" );
		
		$this->FacebookApiProvider->getOnlineFriends(/* parameters */);
	
	}
	
	/**
	 * Tests FacebookApiProvider->auth()
	 */
	public function testAuth() {
		// TODO Auto-generated FacebookApiProviderTest->testAuth()
		$this->markTestIncomplete ( "auth test not implemented" );
		
		$this->FacebookApiProvider->auth(/* parameters */);
	
	}
	
	/**
	 * Tests FacebookApiProvider->postStream()
	 */
	public function testPostStream() {
		// TODO Auto-generated FacebookApiProviderTest->testPostStream()
		$this->markTestIncomplete ( "postStream test not implemented" );
		
		$this->FacebookApiProvider->postStream(/* parameters */);
	
	}

}


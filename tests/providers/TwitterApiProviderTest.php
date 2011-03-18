<?php

require_once 'providers/TwitterApiProvider.php';

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * TwitterApiProvider test case.
 */
class TwitterApiProviderTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * @var TwitterApiProvider
	 */
	private $TwitterApiProvider;
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp() {
		parent::setUp ();
		
		// TODO Auto-generated TwitterApiProviderTest::setUp()
		

		$this->TwitterApiProvider = new TwitterApiProvider(/* parameters */);
	
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		// TODO Auto-generated TwitterApiProviderTest::tearDown()
		

		$this->TwitterApiProvider = null;
		
		parent::tearDown ();
	}
	
	/**
	 * Constructs the test case.
	 */
	public function __construct() {
		// TODO Auto-generated constructor
	}
	
	/**
	 * Tests TwitterApiProvider->getFriends()
	 */
	public function testGetFriends() {
		// TODO Auto-generated TwitterApiProviderTest->testGetFriends()
		$this->markTestIncomplete ( "getFriends test not implemented" );
		
		$this->TwitterApiProvider->getFriends(/* parameters */);
	
	}
	
	/**
	 * Tests TwitterApiProvider->getFriendsFeed()
	 */
	public function testGetFriendsFeed() {
		// TODO Auto-generated TwitterApiProviderTest->testGetFriendsFeed()
		$this->markTestIncomplete ( "getFriendsFeed test not implemented" );
		
		$this->TwitterApiProvider->getFriendsFeed(/* parameters */);
	
	}
	
	/**
	 * Tests TwitterApiProvider->getOnlineFriends()
	 */
	public function testGetOnlineFriends() {
		// TODO Auto-generated TwitterApiProviderTest->testGetOnlineFriends()
		$this->markTestIncomplete ( "getOnlineFriends test not implemented" );
		
		$this->TwitterApiProvider->getOnlineFriends(/* parameters */);
	
	}
	
	/**
	 * Tests TwitterApiProvider->auth()
	 */
	public function testAuth() {
		// TODO Auto-generated TwitterApiProviderTest->testAuth()
		$this->markTestIncomplete ( "auth test not implemented" );
		
		$this->TwitterApiProvider->auth(/* parameters */);
	
	}
	
	/**
	 * Tests TwitterApiProvider->postStream()
	 */
	public function testPostStream() {
		// TODO Auto-generated TwitterApiProviderTest->testPostStream()
		$this->markTestIncomplete ( "postStream test not implemented" );
		
		$this->TwitterApiProvider->postStream(/* parameters */);
	
	}

}


<?php

require_once 'init.php';

require_once 'providers/VkontakteApiProvider.php';

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * VkontakteApiProvider test case.
 */
class VkontakteApiProviderTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * @var VkontakteApiProvider
	 */
	private $VkontakteApiProvider;
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp() {
		parent::setUp ();
		
		$this->VkontakteApiProvider = new VkontakteApiProvider();	
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		// TODO Auto-generated VkontakteApiProviderTest::tearDown()
		

		$this->VkontakteApiProvider = null;
		
		parent::tearDown ();
	}
	
	/**
	 * Constructs the test case.
	 */
	public function __construct() {
		// TODO Auto-generated constructor
	}
	
	/**
	 * Tests VkontakteApiProvider->__construct()
	 */
	public function test__construct() {
		// TODO Auto-generated VkontakteApiProviderTest->test__construct()
		$this->markTestIncomplete ( "__construct test not implemented" );
		
		$this->VkontakteApiProvider->__construct(/* parameters */);
	
	}
	
	/**
	 * Tests VkontakteApiProvider->auth()
	 */
	public function testAuth() {
		// TODO Auto-generated VkontakteApiProviderTest->testAuth()
		$this->markTestIncomplete ( "auth test not implemented" );
		
		$this->VkontakteApiProvider->auth(/* parameters */);
	
	}
	
	/**
	 * Tests VkontakteApiProvider->getOnlineFriends()
	 */
	public function testGetOnlineFriends() {
		// TODO Auto-generated VkontakteApiProviderTest->testGetOnlineFriends()
		$this->markTestIncomplete ( "getOnlineFriends test not implemented" );
		
		$this->VkontakteApiProvider->getOnlineFriends(/* parameters */);
	
	}
	
	/**
	 * Tests VkontakteApiProvider->getFriends()
	 */
	public function testGetFriends() {
		// TODO Auto-generated VkontakteApiProviderTest->testGetFriends()
		$this->markTestIncomplete ( "getFriends test not implemented" );
		
		$this->VkontakteApiProvider->getFriends(/* parameters */);
	
	}
	
	/**
	 * Tests VkontakteApiProvider->postStream()
	 */
	public function testPostStream() {
		// TODO Auto-generated VkontakteApiProviderTest->testPostStream()
		$this->markTestIncomplete ( "postStream test not implemented" );
		
		$this->VkontakteApiProvider->publish(/* parameters */);
	
	}
	
	/**
	 * Tests VkontakteApiProvider->getFriendsFeed()
	 */
	public function testGetFriendsFeed() {
		// TODO Auto-generated VkontakteApiProviderTest->testGetFriendsFeed()
		$this->markTestIncomplete ( "getFriendsFeed test not implemented" );
		
		$this->VkontakteApiProvider->getFriendsFeed(/* parameters */);
	
	}

}


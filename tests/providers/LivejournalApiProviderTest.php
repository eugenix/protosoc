<?php

require_once 'providers/LivejournalApiProvider.php';

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * LivejournalApiProvider test case.
 */
class LivejournalApiProviderTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * @var LivejournalApiProvider
	 */
	private $LivejournalApiProvider;
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp() {
		parent::setUp ();
		
		// TODO Auto-generated LivejournalApiProviderTest::setUp()
		

		$this->LivejournalApiProvider = new LivejournalApiProvider(/* parameters */);
	
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		// TODO Auto-generated LivejournalApiProviderTest::tearDown()
		

		$this->LivejournalApiProvider = null;
		
		parent::tearDown ();
	}
	
	/**
	 * Constructs the test case.
	 */
	public function __construct() {
		// TODO Auto-generated constructor
	}
	
	/**
	 * Tests LivejournalApiProvider->getFriends()
	 */
	public function testGetFriends() {
		// TODO Auto-generated LivejournalApiProviderTest->testGetFriends()
		$this->markTestIncomplete ( "getFriends test not implemented" );
		
		$this->LivejournalApiProvider->getFriends(/* parameters */);
	
	}
	
	/**
	 * Tests LivejournalApiProvider->getFriendsFeed()
	 */
	public function testGetFriendsFeed() {
		// TODO Auto-generated LivejournalApiProviderTest->testGetFriendsFeed()
		$this->markTestIncomplete ( "getFriendsFeed test not implemented" );
		
		$this->LivejournalApiProvider->getFriendsFeed(/* parameters */);
	
	}
	
	/**
	 * Tests LivejournalApiProvider->getOnlineFriends()
	 */
	public function testGetOnlineFriends() {
		// TODO Auto-generated LivejournalApiProviderTest->testGetOnlineFriends()
		$this->markTestIncomplete ( "getOnlineFriends test not implemented" );
		
		$this->LivejournalApiProvider->getOnlineFriends(/* parameters */);
	
	}
	
	/**
	 * Tests LivejournalApiProvider->auth()
	 */
	public function testAuth() {
		// TODO Auto-generated LivejournalApiProviderTest->testAuth()
		$this->markTestIncomplete ( "auth test not implemented" );
		
		$this->LivejournalApiProvider->auth(/* parameters */);
	
	}
	
	/**
	 * Tests LivejournalApiProvider->postStream()
	 */
	public function testPostStream() {
		// TODO Auto-generated LivejournalApiProviderTest->testPostStream()
		$this->markTestIncomplete ( "postStream test not implemented" );
		
		$this->LivejournalApiProvider->postStream(/* parameters */);
	
	}

}


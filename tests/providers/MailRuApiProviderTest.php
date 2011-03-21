<?php

require_once 'providers/MailRuApiProvider.php';

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * MailRuApiProvider test case.
 */
class MailRuApiProviderTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * @var MailRuApiProvider
	 */
	private $MailRuApiProvider;
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp() {
		parent::setUp ();
		
		// TODO Auto-generated MailRuApiProviderTest::setUp()
		

		$this->MailRuApiProvider = new MailRuApiProvider(/* parameters */);
	
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		// TODO Auto-generated MailRuApiProviderTest::tearDown()
		

		$this->MailRuApiProvider = null;
		
		parent::tearDown ();
	}
	
	/**
	 * Constructs the test case.
	 */
	public function __construct() {
		// TODO Auto-generated constructor
	}
	
	/**
	 * Tests MailRuApiProvider->__construct()
	 */
	public function test__construct() {
		// TODO Auto-generated MailRuApiProviderTest->test__construct()
		$this->markTestIncomplete ( "__construct test not implemented" );
		
		$this->MailRuApiProvider->__construct(/* parameters */);
	
	}
	
	/**
	 * Tests MailRuApiProvider->getFriends()
	 */
	public function testGetFriends() {
		// TODO Auto-generated MailRuApiProviderTest->testGetFriends()
		$this->markTestIncomplete ( "getFriends test not implemented" );
		
		$this->MailRuApiProvider->getFriends(/* parameters */);
	
	}
	
	/**
	 * Tests MailRuApiProvider->getFriendsFeed()
	 */
	public function testGetFriendsFeed() {
		// TODO Auto-generated MailRuApiProviderTest->testGetFriendsFeed()
		$this->markTestIncomplete ( "getFriendsFeed test not implemented" );
		
		$this->MailRuApiProvider->getFriendsFeed(/* parameters */);
	
	}
	
	/**
	 * Tests MailRuApiProvider->getOnlineFriends()
	 */
	public function testGetOnlineFriends() {
		// TODO Auto-generated MailRuApiProviderTest->testGetOnlineFriends()
		$this->markTestIncomplete ( "getOnlineFriends test not implemented" );
		
		$this->MailRuApiProvider->getOnlineFriends(/* parameters */);
	
	}
	
	/**
	 * Tests MailRuApiProvider->auth()
	 */
	public function testAuth() {
		// TODO Auto-generated MailRuApiProviderTest->testAuth()
		$this->markTestIncomplete ( "auth test not implemented" );
		
		$this->MailRuApiProvider->auth(/* parameters */);
	
	}
	
	/**
	 * Tests MailRuApiProvider->postStream()
	 */
	public function testPostStream() {
		// TODO Auto-generated MailRuApiProviderTest->testPostStream()
		$this->markTestIncomplete ( "postStream test not implemented" );
		
		$this->MailRuApiProvider->publish(/* parameters */);
	
	}

}


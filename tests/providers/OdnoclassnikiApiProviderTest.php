<?php
require_once 'init.php';

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
	
		$this->OdnoclassnikiApiProvider = new OdnoclassnikiApiProvider(
			37632,
			"http://api-sandbox.odnoklassniki.ru:8088/api/fb.do",
			"CBAEJBABABABABABA",
			"SampleAppSecret",
			"eugene.kurbatov", 
			"eugene.kurbatov_pwd"
		);
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {		
		$this->OdnoclassnikiApiProvider = null;
		
		parent::tearDown ();
	}
	
	/**
	 * Constructs the test case.
	 */
	public function __construct() {		
	}		
	
	/**
	 * Tests OdnoclassnikiApiProvider->getFriends()
	 */
	public function testGetFriends() {

		try 
		{
			$res = $this->OdnoclassnikiApiProvider->getFriends();
			$this->assertEquals(count($res), 19);
		} 
		catch (APIException $apie) 
		{
			$this->assertTrue(false);
		}		
	}
	
	/**
	 * Tests OdnoclassnikiApiProvider->getFriendsFeed()
	 */
	public function testGetFriendsFeed() {
		$this->markTestIncomplete ("getFriendsFeed test not implemented");	
	}
	
	/**
	 * Tests OdnoclassnikiApiProvider->getOnlineFriends()
	 */
	public function testGetOnlineFriends() {
		try 
		{
			$res = $this->OdnoclassnikiApiProvider->getOnlineFriends();
			$this->assertNotNull($res);
			$this->assertTrue(is_array($res));
		} 
		catch (APIException $apie) 
		{
			$this->assertTrue(false);
		}	
	}
	
	/**
	 * Tests OdnoclassnikiApiProvider->auth()
	 */
	public function testAuth() {
		$sessionData = $this->OdnoclassnikiApiProvider->auth('eugene.kurbatov', 'eugene.kurbatov_pwd');	
		
		print_r($sessionData);
		
		$this->assertTrue(isset($sessionData['session_key']));
		$this->assertTrue(isset($sessionData['session_secret_key']));
		$this->assertEquals(98900, $sessionData['uid']);
	
	}
	
	/**
	 * Tests OdnoclassnikiApiProvider->postStream()
	 */
	public function testPostStream() {
		
		$activity = $this->OdnoclassnikiApiProvider->publish('This is a test message!');
		$this->assertNotNull($activity->getId());
		$this->assertEquals('This is a test message!', $activity->getText());
	
	}

}


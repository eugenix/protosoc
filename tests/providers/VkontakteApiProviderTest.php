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
	 * @todo убрать реальные данные
	 * Prepares the environment before running a test.
	 */
	protected function setUp() {
		parent::setUp ();
		
		$this->VkontakteApiProvider = new VkontakteApiProvider(
			2215721, 
			'http://api.vkontakte.ru/api.php',
			'PNklLefcCI8t9DfMOVPI',
			'vivareal@list.ru',
			'valenly');	
		date_default_timezone_set('Europe/Moscow');			
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {	
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
	 * @todo убрать реальные данные
	 * Tests VkontakteApiProvider->auth()
	 */
	public function testAuth() {
		$sessionData = $this->VkontakteApiProvider->auth('vivareal@list.ru', 'valenly');	
		$this->assertTrue(isset($sessionData['sid']));
		$this->assertTrue(isset($sessionData['mid']));
		$this->assertTrue(isset($sessionData['secret']));
		
	}
	
	/**
	 * Tests VkontakteApiProvider->getOnlineFriends()
	 */
	public function testGetOnlineFriends() {								
		try 
		{
			$res = $this->VkontakteApiProvider->getOnlineFriends();
			$this->assertNotNull($res);
			$this->assertTrue(is_array($res));
		} 
		catch (APIException $apie) 
		{
			$this->assertTrue(false);
		}
					
	}
	
	/**
	 * Tests VkontakteApiProvider->getFriends()
	 */
	public function testGetFriends() {							
		try 
		{
			$res = $this->VkontakteApiProvider->getFriends();
			$this->assertEquals(count($res), 172);
		} 
		catch (APIException $apie) 
		{
			$this->assertTrue(false);
		}
	}
	
	/**
	 * Tests VkontakteApiProvider->postStream()
	 * @todo реализовать публикацию с тестовыми данными
	 */
	public function testPostStream() {		
		$this->markTestIncomplete ( "postStream test not implemented" );
		
		$this->VkontakteApiProvider->publish(/* parameters */);
	
	}
	
	/**
	 * Tests VkontakteApiProvider->getFriendsFeed()
	 */
	public function testGetFriendsFeed() {						
		try 
		{
			$res = $this->VkontakteApiProvider->getFriendsFeed();
			$this->assertNotNull($res);
			$this->assertTrue(is_array($res));
		} 
		catch (APIException $apie) 
		{
			$this->fail('Операция не должна завершаться эксепшеном');
		}
	}

}


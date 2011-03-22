<?php

require_once 'PHPUnit/Framework/TestSuite.php';

require_once 'tests/lib/APIConfiguratorTest.php';
require_once 'tests/lib/APIExceptionTest.php';
require_once 'tests/lib/APIHandlerTest.php';
require_once 'tests/lib/APIProviderFactoryTest.php';
require_once 'tests/providers/VkontakteApiProviderTest.php';
require_once 'tests/providers/OdnoclassnikiApiProviderTest.php';

/*
require_once 'tests/providers/FacebookApiProviderTest.php';

require_once 'tests/providers/LivejournalApiProviderTest.php';

require_once 'tests/providers/MailRuApiProviderTest.php';

require_once 'tests/providers/TwitterApiProviderTest.php';

*/

/**
 * Static test suite.
 */
class AllTests extends PHPUnit_Framework_TestSuite {
	
	/**
	 * Constructs the test suite handler.
	 */
	public function __construct() {
		$this->setName ( 'AllTests' );
		
		$this->addTestSuite ( 'APIConfiguratorTest' );		
		$this->addTestSuite ( 'APIExceptionTest' );		
		$this->addTestSuite ( 'APIHandlerTest' );		
		$this->addTestSuite ( 'APIProviderFactoryTest' );
		$this->addTestSuite ( 'VkontakteApiProviderTest' );
		$this->addTestSuite ( 'OdnoclassnikiApiProviderTest' );
		
		/*
		$this->addTestSuite ( 'FacebookApiProviderTest' );
		
		$this->addTestSuite ( 'LivejournalApiProviderTest' );
		
		$this->addTestSuite ( 'MailRuApiProviderTest' );
		
		
		
		$this->addTestSuite ( 'TwitterApiProviderTest' );				
		*/
	}
	
	/**
	 * Creates the suite.
	 */
	public static function suite() {
		return new self ();
	}
}


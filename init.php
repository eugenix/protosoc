<?php

session_start();

require_once 'HTTP/Request2.php';
require_once 'HTTP/Request2/Adapter/Curl.php';
require_once 'Config/Lite.php';

require_once 'lib/APIConfigurator.php';
require_once 'lib/APIException.php';
require_once 'lib/APIHandler.php';
require_once 'lib/APIProviderFactory.php';

require_once 'providers/IAPIProvider.php';
require_once 'providers/BaseApiProvider.php';
require_once 'providers/VkontakteApiProvider.php';
require_once 'providers/OdnoclassnikiApiProvider.php';
require_once 'providers/MailRuApiProvider.php';

require_once 'models/BaseEntity.php';
require_once 'models/PersonEntity.php';
require_once 'models/ActivityEntity.php';
require_once 'models/MessageEntity.php';
require_once 'models/StatusEntity.php';

/*
require_once 'providers/LiveJournalApiProvider.php';
require_once 'providers/FacebookApiProvider.php';
require_once 'providers/TwitterApiProvider.php';
*/



APIConfigurator::getInstance()->init('config.ini');


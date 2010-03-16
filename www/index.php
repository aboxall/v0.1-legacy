<?php

// define several important path constants
define('SYS_PATH', realpath('../system/'));
define('APP_PATH', realpath('../system/application'));
define('LIB_PATH', realpath('../system/library'));
define('LOG_PATH', realpath('../system/logs'));

// include the Load class for all future object instantiation                                    
require_once LIB_PATH . '/Load.php';

// include the base Controller class
require_once LIB_PATH . '/Controller.php';

// include the base Model class
require_once LIB_PATH . '/Model.php';

 // create the Config instance and set to singleton
$config = Load::library('Config');

// instantiate the router class
$router = Load::library('Router');

// EOF

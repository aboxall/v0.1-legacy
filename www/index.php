<?php
// ensure session is started first
session_start();

// include constants file
require_once '../system/configs/constants.php';

// include autoload functionality
require_once SYS_PATH.'/configs/autoload.php';

// include base controller
require_once 'Controller.php';

// include base model
require_once 'Model.php';

// init the router class
$router = new Router();

// EOF

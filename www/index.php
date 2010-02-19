<?php

// absolute system path
define('SYS_PATH', realpath('../system'));

// include autoload functionality
require_once SYS_PATH.'/configs/autoload.php';

// include base controller
require_once 'Controller.php';

// include base model
require_once 'Model.php';

// init the router class
$router = new Router();

/* EOF */

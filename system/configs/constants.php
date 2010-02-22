<?php

// absolute file path to system dir
define('SYS_PATH', realpath('../system'));

// user's IP address
define('USER_IP', $_SERVER['REMOTE_ADDR']);

// web accessible document room
$href_base = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$href_base = dirname($href_base);
$href_base = rtrim($href_base, '/');

define('HREF_BASE', $href_base);

// EOF

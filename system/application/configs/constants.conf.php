<?php

$properties = array();

$properties['const'] = array(
    'SYS_PATH'  => realpath('../system'),
    'APP_PATH'  => realpath('../system/application'),
    'USER_IP'   => $_SERVER['REMOTE_ADDR'],
    'ENV_LEVEL' => 'dev',
);

// EOF

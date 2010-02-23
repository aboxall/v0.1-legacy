<?php

$inc_paths = array(
    SYS_PATH.'/configs',
    SYS_PATH.'/libraries',
	SYS_PATH.'/libraries/Smarty',
);

//$set_paths  = get_include_path();
//$set_paths .= PATH_SEPARATOR;
$set_paths = implode(PATH_SEPARATOR, $inc_paths);

set_include_path($set_paths);

function __autoload($class)
{
	$path = null;

	if (strpos($class, 'Controller') !== false)
	{
		$path  = SYS_PATH.'/controllers/';
		$class = str_replace('Controller', '', $class);
	}
	elseif (strpos($class, 'Model') !== false)
	{
		$path  = SYS_PATH.'/models/';
		$class = str_replace('Model', '', $class);
	}

    require_once $path.$class.'.php';
}

// EOF

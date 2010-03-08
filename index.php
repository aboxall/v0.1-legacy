<?php
$include_paths = array(
    'library',
    'library/Smarty',
    'applications',
);

set_include_path(implode(PATH_SEPARATOR, $include_paths) . PATH_SEPARATOR . get_include_path());

include_once('Loader.php');
Loader::LoadConfFile('config', 'applications/configs/');
Loader::LoadConfFile('database', 'applications/configs/');
Loader::LibLoad('Charlee');
// GO GO GO!
include_once('controllers/Index.php');


$charlee = new Charlee();
$router = new Router();
echo "<pre>";
print_r($config);
print_r(get_included_files());
echo "</pre>";

// EOF
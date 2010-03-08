<?php
$include_paths = array(
    'library',
);

set_include_path(implode(PATH_SEPARATOR, $include_paths) . PATH_SEPARATOR . get_include_path());

include_once('Loader.php');
Loader::LibLoad('Charlee', true);
// GO GO GO!
Charlee::dispatch();

// EOF
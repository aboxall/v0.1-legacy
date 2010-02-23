<?php

require_once 'Smarty.class.php';

class Template extends Smarty
{
    public function __construct()
    {
		parent::__construct();

        $this->template_dir = SYS_PATH.'/views/';
		$this->compile_dir  = SYS_PATH.'/views/.compiled/';
        $this->config_dir   = SYS_PATH.'/libraries/Smarty/configs/';
        $this->cache_dir    = SYS_PATH.'/views/.cache/';

		$this->caching = true;

		$this->assign('href_base', '');
    }
}

// EOF
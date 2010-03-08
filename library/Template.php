<?php

require_once 'Smarty.class.php';

class Template extends Smarty {
    public $template_dir;
    public $compile_dir;
    public $config_dir;
    public $cache_dir;
    public $caching = true;
    public $suppress_headers = false;

    public function __construct() {
        parent::__construct();

        $this->template_dir = 'applications/views/';
        $this->compile_dir  = 'applications/views/.compiled/';
        $this->config_dir   = 'applications/libraries/Smarty/configs/';
        $this->cache_dir    = 'applications/views/.cache/';

        $this->assign('HREF_BASE', HREF_BASE);
    }

    public function suppressHeaders($bool = true) {
        $this->suppress_headers = $bool ? true : false;
    }

    public function enableCaching($bool = true) {
        $this->caching = $bool ? true : false;
    }
}

// EOF

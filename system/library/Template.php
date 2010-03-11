<?php

require_once 'Smarty.class.php';

class Template extends Smarty
{
    public $template_dir;
    public $compile_dir;
    public $config_dir;
    public $cache_dir;
	public $caching = true;
	public $suppress_headers = false;

    public function __construct()
    {
		parent::__construct();

        $this->template_dir = SYS_PATH.'/views/';
		$this->compile_dir  = SYS_PATH.'/views/.compiled/';
        $this->config_dir   = SYS_PATH.'/libraries/Smarty/configs/';
        $this->cache_dir    = SYS_PATH.'/views/.cache/';

		$this->assign('HREF_BASE', HREF_BASE);
    }

	public function suppressHeaders($bool = true)
	{
		$this->suppress_headers = $bool ? true : false;
	}

	public function enableCaching($bool = true)
	{
		$this->caching = $bool ? true : false;
	}
}

// EOF

<?php

require_once 'Smarty.class.php';

class Template extends Smarty
{
    public $template_dir;
    public $compile_dir;
    public $config_dir;
    public $cache_dir;
	public $caching = true;
	public $blank_page = false;

    public function __construct()
    {
		parent::__construct();

        $this->template_dir = SYS_PATH.'/views/';
		$this->compile_dir  = SYS_PATH.'/views/.compiled/';
        $this->config_dir   = SYS_PATH.'/libraries/Smarty/configs/';
        $this->cache_dir    = SYS_PATH.'/views/.cache/';

		$this->assign('HREF_BASE', HREF_BASE);
    }

	public function blankPage($bool = true)
	{
		$this->blank_page = $bool ? true : false;
	}

	public function useCaching($bool = true)
	{
		$this->caching = $bool ? true : false;
	}
}

// EOF

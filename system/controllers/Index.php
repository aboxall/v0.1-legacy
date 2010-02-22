<?php

class IndexController extends Controller
{
    public function __construct()
    {
		parent::__construct();
    }

    public function index()
    { 
		$this->template->assign('test', 'Hello, World!');

		$this->template->display('test.tpl');
	}

    public function custom()
    {
        echo 'Custom methods work!';
    }

}

// EOF

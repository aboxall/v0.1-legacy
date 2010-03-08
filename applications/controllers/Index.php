<?php

class IndexController extends Controller
{
    public function __construct()
    {
		parent::__construct();
    }

    public function index()
    {
		$this->template_name = 'index/homepage.tpl';
	}
}

// EOF

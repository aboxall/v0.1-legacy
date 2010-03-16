<?php

class IndexController extends Controller
{

    public function __construct()
    {
	   parent::__construct();
    }

    public function index()
    {
        $this->view->head = 'Welcome from the ' . __CLASS__;
        $this->view->add('index');
    }
}
// EOF

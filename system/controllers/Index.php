<?php

class IndexController extends Controller
{
    public function __construct()
    {
		parent::__construct();
    }

    public function index()
    {
		//print_r(debug_backtrace()); echo "\n\n\n\n\n\n\n";
        echo 'Basic controller works!<br />This is being called from the index method of the index controller!';
    }

    public function custom()
    {
        echo 'Custom methods work!';
    }
}

// EOF

<?php

class URI
{
    public $uri_request;
    public $uri_parts = array();

    public function __construct()
    {
        if (isset($_GET['route']))
        {
            $this->uri_parts = explode('/', trim($_GET['route'], '/'));
        }

        $this->uri_request = $_SERVER['REQUEST_URI'];
    }

}

// EOF

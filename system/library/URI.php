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

        if (!defined('HREF_BASE'))
        {
            $href_base = $_SERVER['REQUEST_URI'];

            if (isset($_GET['route']))
            {
                $href_base = str_replace($_GET['route'], '', $href_base);
            }

            $href_base = rtrim($href_base, '/');

            define('HREF_BASE', $href_base);
        }
    }
}

// EOF

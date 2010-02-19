<?php

class Config
{
    private $properties = array();

    public function __construct()
    {
        $this->properties['default_controller'] = 'index';
        $this->properties['default_method'] = 'index';
    }

    public function get($name)
    {
        return $this->properties[$name];
    }



}

// EOF

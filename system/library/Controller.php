<?php

abstract class Controller
{
    protected $view;

    public function __construct()
    {
        $this->view = Load::library('View');
    }

    final public function _draw()
    {
        // ready for new View library functionality
    }

    abstract public function index();
}

// EOF

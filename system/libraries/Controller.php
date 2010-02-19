<?php

abstract class Controller
{
    protected $template;

    public function __construct()
    {
        $this->template = new Template();
    }

    abstract public function index();
}

// EOF

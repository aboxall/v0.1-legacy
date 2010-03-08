<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Router
 *
 * @author Bogdan Olteanu
 */
class Router {

    private $Uri;
    private $config;


    protected $controller;
    protected $method;
    protected $draw;

    public function __construct()
    {
        $this->Uri = new URI();
        $this->Charlee = new Charlee();

        $this->InitRouting();

    }

    protected function initRouting()
    {
        try
        {
            $this->ParseRoute();
        }
        catch(Exception $e)
        {
            throw new $e->Exception;
        }
    }

    protected function ParseRoute()
    {
        $method = $this->method;
        $controller = $this->controller;
        if(!empty($this->Uri->uri_parts))
        {
            if(isset($this->Uri->uri_parts))
            {
                $this->controller = $this->Uri->uri_parts[0];
            }

            if(isset($this->Uri->uri_parts[1]))
            {
                $this->method = $this->Uri->uri_parts[1];
            }
        }

        if(empty($this->controller))
        {
            $this->controller = $this->Charlee->get('DefaultController');
        }

        if(empty($this->method))
        {
            $this->method = $this->Charlee->get('DefaultMethod');
        }

        $this->controller = ucwords($this->controller);

            $this->controller .= 'Controller';
            $this->controller = new $this->controller;
            $this->method = call_user_func(array($this->controller, $this->method));
            $this->draw   = call_user_func(array($this->controller, '_draw'));
    }
}
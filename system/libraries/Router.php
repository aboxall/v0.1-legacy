<?php

class Router
{
    private $uri;
    private $config;

    protected $controller;
    protected $method;
	protected $draw;

    public function __construct()
    {
        $this->uri = new URI();
        $this->config = new Config();

        $this->initRouting();
    }

    protected function initRouting()
    {
        try
        {
            $this->parseRoute();
        }
        catch (Exception $e)
        {
            // FIXME
            $error = new Error($e->getMessage());
        }
    }

    protected function parseRoute()
    {
        // parse the route from the URL
        if (!empty($this->uri->uri_parts))
        {
            $controller = $this->uri->uri_parts[0];

            if (isset($this->uri->uri_parts[1]))
            {
                $method = $this->uri->uri_parts[1];
            }
        }

        // use default if no controller has been found
        if (empty($controller))
        {
            $controller = $this->config->get('default_controller');
        }

        // use default if no method has been found
        if (empty($method))
        {
            $method = $this->config->get('default_method');
        }

        // convert class name into expected casing
        $controller = ucwords($controller);

        // check the class file exists
        if (!file_exists(SYS_PATH.'/controllers/'.$controller.'.php'))
        {
            throw new Exception('CLASS_FILE_CANNOT_BE_FOUND');
        }

        // append controller class name
        $controller .= 'Controller';

        // init controller
        $this->controller = new $controller;

        // ensure method exists
        if (!method_exists($this->controller, $method))
        {
            throw new Exception('METHOD_CANNOT_BE_FOUND');
        }

        // call the method
        $this->method = call_user_func(array($this->controller, $method));

        // call draw method
        $this->draw   = call_user_func(array($this->controller, '_draw'));
    }
}

// EOF

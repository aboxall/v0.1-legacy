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
            $error = new Error();

            switch ($e->getMessage())
            {
                case 'ROUTER_INVALID':
                    $error->raise(404);
                    break;
                default:
                    $error->raise($e->getMessage());
            }
        }
    }

    protected function parseRoute()
    {
        if (!empty($this->uri->uri_parts))
        {
            $controller = $this->uri->uri_parts[0];

            if (isset($this->uri->uri_parts[1]))
            {
                $method = $this->uri->uri_parts[1];
            }
        }

        if (empty($controller))
        {
            $controller = $this->config->get('default_controller');
        }

        if (empty($method))
        {
            $method = $this->config->get('default_method');
        }

        if (!$this->validRoute($controller, $method))
        {
            // invalid route
            if (!$this->validRoute($controller))
            {
                throw new Exception('INVALID_ROUTE');
            }
            else
            {
                $method = $this->config->get('default_method');
            }
        }

        $controller = ucwords($controller).'Controller';

        // init controller
        $this->controller = new $controller;

        // call controller method
        $this->method = call_user_func(array($this->controller, $method));

		// call draw method
		$this->draw   = call_user_func(array($this->controller, '_draw'));
    }

    protected function validRoute($controller, $method = null)
    {
        // FIXME: add route validation
        return true;
    }

}

// EOF

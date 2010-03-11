<?php

class Config
{
    private $properties = array();

    public function __construct()
    {
		require_once 'config.conf';

		$this->properties = $config;
    }

    public function get($name)
    {
		if (isset($this->properties[$name]))
		{
        	return $this->properties[$name];
		}
    }

	public function set($name, $value)
	{
		$this->properties[$name] = $value;
	}

	public function rem($name)
	{
		if (isset($this->properties[$name]))
		{
			unset($this->properties[$name]);
		}
	}

}

// EOF

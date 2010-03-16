<?php

class Config
{
    private $properties = array();
    public $path;

    public function __construct()
    {
        $this->path = APP_PATH . '/configs/';

        // default config files to load
        $this->parse('config.ini', true);
        $this->parse('database.ini', true);
    }

    public function parse($ini, $file = false, $return = false)
    {
        $path = $ini;

        if ($file && !file_exists($path))
        {
            $path = $this->path . $ini;
        }

        $parsed = $file ? parse_ini_file($path, true) : parse_ini_string($ini, true);

        if ($return)
        {
            return $parsed;
        }

        foreach ($parsed as $section => $properties)
        {
            $this->properties[$section] = $properties;
        }
    }

    public function get($property)
    {
        $tokens = explode('.', $property);
        $return = $this->properties;

        foreach ($tokens as $token)
        {
            $return = $this->recurseGet($token, $return);

            if (!$return)
            {
                break;
            }
        }

        return $return;
    }

	public function set($property, $value)
	{
        // FIXME - got frustrated and did this as a temp fix

        $tokens = explode('.', $property);
        $count  = count($tokens);

        switch ($count)
        {
            case 1:
                $this->properties[$property] = $value;
                break;
            case 2:
                $this->properties[$tokens[0]][$tokens[1]] = $value;
                break;
            case 3:
                $this->properties[$tokens[0]][$tokens[1]][$tokens[2]] = $value;
                break;
        }

        return true;
	}

    private function recurseGet($token, $properties)
    {
        if (array_key_exists($token, $properties))
        {
            return $properties[$token];
        }

        return false;
    }
}

// EOF
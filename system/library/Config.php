<?php

class Config
{
    private $properties = array();
    private static $instance;

    public $path;

    public static function getInstance()
    {
        if (!self::$instance)
        {
            self::$instance = new Config;
        }

        return self::$instance;
    }

    private function __construct()
    {
        // create a local var for the configs dir path
        $this->path = APP_PATH . '/configs/';

        // default config files to load
        $this->parse('config.ini', true);
        $this->parse('database.ini', true);

        // check whether we're using enviroment levels
        if ($this->get('server.use_enviroment'))
        {
            // set the dev/prod enviroment
            $this->setEnviroment();
        }
    }

    public function parse($ini, $file = false, $return = false)
    {
        // if $ini is a file..
        if ($file)
        {
            // preserve the original $ini var for later
            $path = $ini;

            // check if $ini param contains the relative/absolute
            // path to the config file by seeing if it exists
            if (!file_exists($path))
            {
                // if it doesn't prepend the default config path
                $path = $this->path . $path;

                // make sure the config file now exists
                if (!file_exists($path))
                {
                    // if not throw a Config exception
                    throw new ConfigException('Config file doesn\'t exist: ' . $ini);
                }
            }
        }

        // if $file is true we need to parse $ini as 
        $parsed = $file ? parse_ini_file($ini, true) : parse_ini_string($ini, true);

        // if the return param is set we want to return the parsed
        // INI file instead of adding to the properties array
        if ($return)
        {
            return $parsed;
        }

        // loop through the parsed array and add
        // each section to the properties array
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

    private function setEnviroment($overwrite = false, $debug_mode = false)
    {
        if (!empty($overwrite))
        {
            // if a custom enviroment has been passed or we're overwriting
            // the default handling of dev/prod, set the enviroment to that 
            $env  = $overwrite;
        }
        elseif ($_SERVER['SERVER_NAME'] == $this->get('server.prod_domain'))
        {
            // we're on the production server
            $env = 'prod';
        }
        else
        {
            // default to a dev enviroment
            $env = 'dev';
            
            // debug mode should always be enabled on dev
            $debug_mode = true;
        }

        // set the server enviroment property
        $this->set('server.enviroment', $env);

        // set the debug mode property
        $this->set('server.debug_mode', $debug_mode);

        // write debug log
        Logger::write('Enviroment set: ' . $env);
    }

    public function getEnviroment()
    {
        // returns the enviroment string (by default dev or prod)
        return $this->get('server.enviroment');
    }

    public function isDev()
    {
        // return true if we're in the dev enviroment
        return ($this->get('server.enviroment') == 'dev') ? true : false;
    }

    public function isProd()
    {
        // return true if we're in the prod enviroment
        return ($this->get('server.enviroment') == 'prod') ? true : false;
    }
}

// EOF

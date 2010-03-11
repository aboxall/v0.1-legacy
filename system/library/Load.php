<?php

require_once APP_PATH . '/exceptions/Load.php';

class Load
{
    private static $_objects = array();

    public static function library($class_name, $singleton = false)
    {
        if (!class_exists($class_name))
        {
            $path = LIB_PATH . '/' . $class_name . '.php';

            if (!file_exists($path))
            {
                throw new LoadException('LOAD_LIBRARY_FILE_NOT_FOUND');
            }

            require $path;
        }
        elseif ($singleton && in_array($class_name, self::_objects))
        {
            return self::$_objects[$class_name];
        }

        if (!class_exists($class_name))
        {
            throw new LoadException('LOAD_LIBRARY_CLASS_NOT_FOUND');
        }

        $obj = new $class_name;

        if ($singleton)
        {
            self::$_objects[$class_name] = $obj;
        }

        return $obj;
    }

    public static function controller($class_name)
    {
        if (!class_exists($class_name))
        {
            $path = APP_PATH . '/controllers/' . $class_name . '.php';

            if (!file_exists($path))
            {
                throw new LoadException('LOAD_CONTROLLER_FILE_NOT_FOUND');
            }

            require $path;
        }

        $class_name .= 'Controller';

        if (!class_exists($class_name))
        {
            throw new LoadException('LOAD_CONTROLLER_CLASS_NOT_FOUND');
        }

        return new $class_name;
    }

    public static function model($class_name)
    {
        if (!class_exists($class_name))
        {
            $path = APP_PATH . '/models/' . $class_name . '.php';

            if (!file_exists($path))
            {
                throw new LoadException('LOAD_MODEL_FILE_NOT_FOUND');
            }

            require $path;
        }

        if (!class_exists($class_name))
        {
            throw new LoadException('LOAD_MODEL_CLASS_NOT_FOUND');
        }

        $class_name .= 'Model';

        return new $class_name;
    }

    public static function config($file)
    {
        $path = APP_PATH . '/configs/' . $file;

        if (!file_exists($path))
        {
            throw new Exception('LOAD_CONFIG_FILE_NOT_FOUND');
        }

        require $path;
    }
}

// EOF

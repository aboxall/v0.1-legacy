<?php
 
require_once APP_PATH . '/exceptions/Load.php';
 
class Load
{
    private static $_objects = array();
 
    public static function library($class_name, $clean_copy = false)
    {
        // if we don't want a fresh instantiation of the object and
        // there's a copy available
        if (!$clean_copy && in_array($class_name, self::$_objects))
        {
            // .. return the copy
            return self::$_ojects[$class_name];
        }

        // check if we need to attempt to load the class file first
        if (!class_exists($class_name))
        {
            $path = LIB_PATH . '/' . $class_name . '.php';
 
            // make sure the file exists before we attempt to include it
            if (!file_exists($path))
            {
                throw new LoadException('LOAD_LIBRARY_FILE_NOT_FOUND');
            }
 
            // include the file
            require $path;
        }

        // if class still doesn't exist we have a problem 
        if (!class_exists($class_name))
        {
            throw new LoadException('LOAD_LIBRARY_CLASS_NOT_FOUND');
        }

        // check if this is a singleton object 
        if (method_exists($class_name, 'getInstance'))
        {
            // return singleton instance of object
            return call_user_func(array($class_name, 'getInstance'));
        }

        // instantiate the object
        $obj = new $class_name;
 
        // cache a clean copy for later instances
        self::$_objects[$class_name] = $obj;

        // return object
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

    public static function template($file)
    {
        $path = APP_PATH . '/views/' . $file;

        if (!file_exists($path))
        {
            throw new Exception('LOAD_TEMPLATE_FILE_NOT_FOUND');
        }
 
        require $path;
    }
}
 
// EOF

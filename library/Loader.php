<?php
/**
 * Description of Loader
 * Most of the functions from here are wrappers for php functions
 * with few improvments.
 * @author Bogdan Olteanu
 */
class Loader
{
    public $filename; //Holds the name of $filename
    public $dirname; //Holds the name of the dir

    static public function LibLoad($classname, $require = false)
    {
        self::ClassExists($classname);
        $classname = ltrim($classname, '\\');
        $dirs = 'libraries/';
        if($require)
        {
            self::LoadFile($classname, $dirs, true);
        }
        else
        {
            self::LoadFile($classname, $dirs);
        }

    }

    static public function ModelLoad($model, $require = false)
    {
        self::ClassExists($model);
        $model = ltrim($model, '\\');
        $dirs = 'models/';

        if($require)
        {
            self::LoadFile($model, $dirs, true);
        }
        else
        {
            self::LoadFile($model, $dirs);
        }
    }

    static public function ControllerLoad($controller)
    {
        self::ClassExists($controller);
        $controller = ltrim($controller, '\\');
        $dirs = 'controllers';

        if($require)
        {
            self::LoadFile($controller, $dirs, true);
        }
        else
        {
            self::LoadFile($controller, $dirs);
        }

    }

    static public function LoadFile($filename, $dirs, $require = false)
    {
        self::CheckNames($filename);


        $incPath = false;
        if(!empty($dirs) && (is_array($dirs) || is_string($dirs)))
        {
            if(is_array($dirs))
            {
                $dirs = implode(PATH_SEPARATOR, $dirs);
            }

            $incPath = get_include_path();
            set_include_path($dirs . PATH_SEPARATOR . $incPath);
        }

        if($require)
        {
            include_once($filename . '.php');
        }
        else
        {
            include($filename . '.php');
        }
    }

    static public function IsFile($filename)
    {
        if(is_file($filename))
        {
            return true;
        }
    }

    static public function IsReadable($filename)
    {
        if(is_readable($filename))
        {
            return true;
        }
    }

    static public function IsDir($dirname)
    {
        if(is_dir($dirname))
        {
            return true;
        }
    }

    static public function CheckExtension($filename)
    {
        $details = pathinfo($filename);

        return $details;
    }

    static public function FileExists()
    {

    }

    static protected function CheckNames($filename)
    {
        if(preg_match('/[^a-z0-9\\/\\\\_.:-]/i', $filename))
        {
            throw new Exception('This' . $filename . 'Contains Illegal Characters.');
        }
    }

    static protected function CreatePathFromFileName($filename)
    {
        $filename = str_replace("_", "/", $filename);

        return $filename;
    }

    static protected function ClassExists($classname)
    {
        if(class_exists($classname) || interface_exists($classname, false))
        {
            return;
        }
    }
}
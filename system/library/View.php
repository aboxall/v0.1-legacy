<?php
class View
{
    public $vars = array();
    protected $path;
    protected $config;

    public function __construct()
    {
        $this->config = Load::library('Config');
    }

    public function __set($index, $value)
    {
        $this->vars[$index] = $value;
    }
    public function add($name)
    {
        try
        {
            $this->path = $this->config->get('default.view_dir') . $name . $this->config->get('default.view_ext');
            if(!file_exists($this->path) && (!is_file($this->path)))
            {
                throw new Exception('The ' . $this->path . ' doesn\'t exists');
            }
            else
            {
                foreach ($this->vars as $key => $value)
                {
                    $$key = $value;
                }

                include_once($this->path);
            }
        }
        catch(Exception $e)
        {
            echo $e->getMessage() . '<br /> On Line: ' .$e->getLine() . '<br />In File: '. $e->getFile();
        }
    }
}
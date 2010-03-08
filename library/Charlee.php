<?php
/**
 * Description of Charlee
 *
 * @author Bogdan Olteanu
 */
class Charlee
{
    private $properties = array();
    public $config;

    public function __construct()
    {
        global $config;
        $this->properties = $config;

        self::Dispatch();
    }

    public function Get($name)
    {
        if(isset($this->properties[$name]))
        {
            return $this->properties[$name];
        }
    }
    
    public function Set($name, $value)
    {
        $this->properties[$name] = $value;
    }
    
    public function Rem($name)
    {
        if(isset($this->properties[$name]))
        {
            unset($this->properties[$name]);
        }
    }
    
    public function Dispatch()
    {
        $files = array(
            'URI',
            'Controller',
            'Router',
            'Model',
            'Template',
            'Constants',
        );
        Loader::LoadFromArray($files);
    }
}
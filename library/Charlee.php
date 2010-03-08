<?php
/**
 * Description of Charlee
 *
 * @author Bogdan Olteanu
 */
class Charlee
{
    private $charlee;

    public function __construct()
    {
        $this->charlee = $charlee;
    }

    public function Get($name)
    {
        if(isset($this->charlee[$name]))
        {
            return $this->charlee[$name];
        }
    }
    
    public function Set($name, $value)
    {
        $this->charlee[$name] = $value;
    }
    
    public function Rem($name)
    {
        if(isset($this->charlee[$name]))
        {
            unset($this->charlee[$name]);
        }
    }
    
    public function SetApplicationDirectory($dir = false)
    {
        
    }

    public function SetControllerDirectory($dir = false)
    {

    }

    public function SetModelsDirectory($dir = false)
    {

    }

    public function SetErrorsDirectory($dir = false)
    {

    }

    static public function Dispatch()
    {
        Loader::LibLoad('Autoload', true);
    }


}
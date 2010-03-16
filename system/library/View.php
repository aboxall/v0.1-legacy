<?php
class View {
    public $template_dir = 'template/';
    public $template_ext = '.php';
    public $path;
    public $vars = array();

    public function __set($index, $value) {
        $this->vars[$index] = $value;
    }
    public function add($name) {
        try {
            $this->path = $this->template_dir . $name . $this->template_ext;
            if(!file_exists($this->path) && (!is_file($this->path))) {
                throw new Exception('The ' . $this->path . ' doesn\'t exists');
            }
            else {
                foreach ($this->vars as $key => $value) {
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
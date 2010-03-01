<?php

abstract class Controller
{
    protected $template;
	protected $template_name;

    public function __construct()
    {
        $this->template = new Template();
    }

	public function _draw()
	{
		$this->template->display('global/head.tpl');
		$this->template->display('global/header.tpl');

		if (!empty($this->template_name))
		{
			$this->template->display($this->template_name);
		}

		$this->template->display('global/footer.tpl');
	}

    abstract public function index();
}

// EOF

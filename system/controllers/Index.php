<?php

class IndexController extends Controller
{
    public function __construct()
    {
		parent::__construct();
    }

    public function index()
    {
		$model = new IndexModel();

		foreach ($model->test() as $row)
		{
			echo '<p>'.$row['str'].'</p>';
		}

		$this->template->assign('test', 'Hello, World!');
		$this->template->display('test.tpl');
    }

    public function custom()
    {
        echo 'Custom methods work!';
    }
}

// EOF

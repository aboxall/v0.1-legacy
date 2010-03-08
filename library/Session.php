<?php

class Session
{
	public function __construct()
	{
		session_start();
	}
	
	public function setVar($name, $value)
	{
		$_SESSION[$name] = $value;
	}

	public function getVar($name)
	{
		return isset($_SESSION[$name]) ? $_SESSION[$name] : false;
	}
}

// EOF

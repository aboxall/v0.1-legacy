<?php

class DB extends PDO
{
    private $connections;

    public function __construct()
    {
        // FIXME: These won't be defined here
        $conn_name = 'dev';

        $this->connections = array(
            'dev' => array(
                'dsn'  => 'mysql:dbname=adamswork1;host=213.171.220.32',
                'user' => 'adamswork1',
                'pass' => 'swordfish',
            ),
        );

        try
        {
            // Instantiate PDO object
            parent::__construct(
                $this->connections[$conn_name]['dsn'],
                $this->connections[$conn_name]['user'],
                $this->connections[$conn_name]['pass']
            );
        }
        catch (Exception $e)
        {
            // FIXME: Catch connection error - temporary handle method
            trigger_error('Unable to connect to database!', E_USER_ERROR);
        }

        parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

	public function escape($str)
	{
		return $str;
	}

	public function hash($str)
	{
		$str  = trim($tr);
		$salt = '15b29ffdce66e10527a65bc6d71ad94d';

		return sha1($salt.md5($str));
	}
}

// EOF

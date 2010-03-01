<?php

class DB extends PDO
{
    private $connections;

    public function __construct()
    {
		// Require database configuration
		require_once 'database.conf';

        try
        {
            // Instantiate PDO object
            parent::__construct(
                $this->connections[ENV_LEVEL]['dsn'],
                $this->connections[ENV_LEVEL]['user'],
                $this->connections[ENV_LEVEL]['pass']
            );
        }
        catch (Exception $e)
        {
            // FIXME: Catch connection error - temporary handle method
            trigger_error('Unable to connect to database!', E_USER_ERROR);
        }

        parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

	public function hash($str)
	{
		$str  = trim($str);
		$salt = '15b29ffdce66e10527a65bc6d71ad94d';

		return sha1($salt.md5($str));
	}
}

// EOF

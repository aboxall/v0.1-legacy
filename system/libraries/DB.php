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
}

// EOF

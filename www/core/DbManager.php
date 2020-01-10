<?php

namespace core;

use PDO;

class DbManager
{
    protected $connections = [];

    public function connect($name, $params)
    {
        $params = array_merge([
            'dsn' => null,
            'user' => '',
            'password' => '',
            'options' => [],
        ], $params);

        $con = new PDO(
            $params['dsn'],
            $params['user'],
            $params['password'],
            $params['options']
        );

        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->connections[$name] = $con;
    }

    public function getConnection($name = null)
    {
        if (is_null($name)) {
            current($this->connections);
        }

        return $this->connections[$name];
    }
}

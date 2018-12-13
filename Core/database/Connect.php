<?php

namespace App\Core\Database;

class Connect
{
    public static function make($config)
    {
        try {
            return new \PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['db'], $config['user'], $config['password']);
        } catch (PDOException $e) {
            die($e);
        }
    }
}

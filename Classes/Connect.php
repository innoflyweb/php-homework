<?php

class Connect
{
    public static function db($config)
    {
        try {
            return new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['db'], $config['user'], $config['password']);
        } catch (PDOException $e) {
            die($e);
        }
    }
}

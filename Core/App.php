<?php

namespace App\Core;

class App
{
    protected static $config = [];

    public static function put($key, $value)
    {
        static::$config[$key] = $value;
    }

    public static function get($key)
    {
        return static::$config[$key];
    }
}

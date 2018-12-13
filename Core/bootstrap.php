<?php

use App\Core\App;
use App\Core\Database\Connect;
use App\Core\Database\Database;

App::put('config', require 'config.php');

App::put('database', new Database(Connect::make(App::get('config'))));

function view($name, $data=[])
{
    extract($data);

    return require("Views/{$name}.view.php");
}

function redirect($name)
{
    return header("Location: {$name}");
}

function dd($data)
{
    echo '<pre>';
    die(var_dump($data));
    echo '</pre>';
}

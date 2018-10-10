<?php

require 'config.php';
require 'Classes/Connect.php';
require 'Classes/Database.php';

function redirect()
{
    header('location: /');
}

return new DataBase(Connect::db($config));

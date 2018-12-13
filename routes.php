<?php

$router->get('', 'UserController@index');
$router->post('store', 'UserController@store');
$router->post('update', 'UserController@update');
$router->post('delete', 'UserController@delete');

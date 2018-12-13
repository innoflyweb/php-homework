<?php

namespace App\Core;

class Router
{
    protected $routes = [
        'GET' => [],
        'POST' =>[]
    ];

    public static function load($file)
    {
        $router = new static;

        require $file;

        return $router;
    }

    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    public function direct($uri, $requestType)
    {
        if (array_key_exists($uri, $this->routes[$requestType])) {
            return $this->call(...explode('@', $this->routes[$requestType][$uri]));
        }
    }

    protected function call($controller, $method)
    {
        $controller = "App\\Controllers\\{$controller}";
        $controller = new $controller;

        if (!method_exists($controller, $method)) {
            throw new Exception("Method {$method} not  found on controller {$controller}");
        }

        return $controller->$method();
    }
}

<?php
namespace Router;

class Router
{
    public $routes = [];

    public function add($method, $uri, $controller)
    {
        $this->routes [] = compact('method', 'uri', 'controller');
    }

    public function get($uri, $controller)
    {
        $this->add('GET', $uri, $controller);
    }

    public function post($uri, $controller)
    {
        $this->add('POST', $uri, $controller);
    }

    public function redirectTo($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($uri == $route['uri'] && $method == $route['method']) {
                return require_once base_path($route['controller']);
            }
        }
    }

    public static function view($path, $attributes)
    {
        extract($attributes);
        return require_once './../views/'. $path;
    }
}
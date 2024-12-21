<?php

namespace Core;

class Router {
    private $routes = [];

    public function add($method, $path, $handler) {
        $this->routes[] = compact('method', 'path', 'handler');
    }

    public function resolve() {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['path'] === $path) {
                $request = new Request();
                if (is_callable($route['handler'])) {
                    return $route['handler']($request);
                } else {
                    return $this->invoke($route['handler'], $request);
                }
            }
        }

        Response::json(404, null, 'Route not found');
    }

     private function invoke($handler, $request) {
        [$controller, $method] = explode('@', $handler);
        $class = "App\\Controllers\\$controller";
        $instance = new $class();
        return $instance->$method($request);
    }
}

<?php

namespace Core\Routing;

class Route
{
    private static function make(): static
    {
        return new static;
    }

    public static function get($route, $controller, $action): Route
    {
        return static::make()->addRoute($route, $controller, $action, "GET");
    }

    public static function post($route, $controller, $action): Route
    {
        return static::make()->addRoute($route, $controller, $action, "POST");
    }

    private function addRoute(string $route, string $controller, string $action, string $method): Route
    {
        Routes::$routes[$method][$route] = [
            'controller' => $controller,
            'action' => $action,
        ];
        return $this;
    }
}
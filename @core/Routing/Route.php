<?php

namespace Core\Routing;

/**
 * @method static get(string $string, string $class, string $string1)
 * @method static post(string $string, string $class, string $string1)
 */
class Route
{
    private static function make(): static
    {
        return new static;
    }

    public static function __callStatic(string $name, array $arguments)
    {
        if (in_array($name, ['post', 'put', 'delete','get','patch'])) {
            return static::make()->addRoute(strtoupper($name), ...$arguments);
        }

        throw new \InvalidArgumentException("Invalid method");
    }

    private function addRoute(string $method, string $route, string $controller, string $action): Route
    {
        Routes::$routes[$method][$route] = [
            'controller' => $controller,
            'action' => $action,
        ];
        return $this;
    }
}
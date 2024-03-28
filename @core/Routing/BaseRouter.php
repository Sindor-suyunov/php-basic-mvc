<?php

namespace Core\Routing;

class BaseRouter
{
    private array $routes = [];

    /**
     * @throws \Exception
     */
    private function dispatch(): void
    {
        $uri = strtok($_SERVER['REQUEST_URI'], '?');
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes[$method] as $key => $item) {
            if ($this->isTrueRoute($uri, $key)) {
                $controller = $item['controller'];
                $action = $item['action'];
                $params = $this->getParams($uri, $key);

                $controller = new $controller();
                $controller->$action(...$params);
                return;
            }
        }

        throw new \Exception("No route found for URI: $uri");
    }


    private function isTrueRoute($uri, $route): bool
    {
        $explodedUri = explode('/', $uri);
        $explodedRoute = explode('/', $route);

        if (count($explodedUri) !== count($explodedRoute)) {
            return false;
        }

        for ($i = 0; $i < count($explodedRoute); $i++) {
            if (is_param($explodedRoute[$i])) {
                continue;
            }
            if ($explodedUri[$i] != $explodedRoute[$i]) {
                return false;
            }
        }

        return true;
    }


    private function getParams($uri, $route): array
    {
        $params = [];
        $explodedUri = explode('/', $uri);
        $explodedRoute = explode('/', $route);

        for ($i = 0; $i < count($explodedRoute); $i++) {
            if (is_param($explodedRoute[$i])) {
                $params[substr($explodedRoute[$i], 1, strlen($explodedRoute[$i]) - 2)] = $explodedUri[$i];
            }
        }

        return $params;
    }

    public static function make(): static
    {
        return new static();
    }

    public function setRoutes(array $routes): static
    {
        $this->routes = $routes;
        return $this;
    }

    /**
     * @throws \Exception
     */
    public function __destruct()
    {
        $this->dispatch();
    }
}
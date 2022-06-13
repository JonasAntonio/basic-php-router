<?php

namespace Basic\Router;

class Routes
{
    /**
     * Routes in application
     *
     * @var array<Route>
     */
    private array $routes;

    public function add(Route $route, string $method, string $endpoint): Route
    {
        $this->routes[$method][$endpoint][] = $route;
        return $route;
    }

    public function getAll()
    {
        return $this->routes;
    }

    public function get(string $method, string $endpoint): ?Route
    {
        return $this->routes[$method][$endpoint] ?? null;
    }
}

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
        $this->routes[$method][Str::endpointPattern($endpoint)] = $route;
        return $route;
    }

    public function getAll()
    {
        return $this->routes;
    }

    public function get(Request $request): ?Route
    {
        return $this->routes[$request->method()][Str::endpointPattern($request->endpoint())] ?? null;
    }
}

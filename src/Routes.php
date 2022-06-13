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

    /**
     * Adds a route to the list
     *
     * @param Route $route
     * @param string $method
     * @param string $endpoint
     * @return Route
     */
    public function add(Route $route, string $method, string $endpoint): Route
    {
        $this->routes[$method][Str::endpointPattern($endpoint)] = $route;
        return $route;
    }

    /**
     * All routes
     *
     * @return array
     */
    public function getAll(): array
    {
        return $this->routes;
    }

    /**
     * Returns a requested route if found
     * If route is not found, null will be returned
     *
     * @param Request $request
     * @return Route|null
     */
    public function getRoute(Request $request): ?Route
    {
        return @$this->routes[$request->method()][Str::endpointPattern($request->endpoint())];
    }
}

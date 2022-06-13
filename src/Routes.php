<?php

namespace Basic\Router;

class Routes
{
    /**
     * Routes in application
     *
     * @var array<Route> [
     *  string "METHOD" => [
     *      bool hasPathParameters => [
     *          string "endpoint" => Basic\Router\Route
     *      ]
     *  ]
     * ]
     */
    private array $routes;

    /**
     * Adds a route to the list
     *
     * @param Route $route
     * @param string $method
     * @param string $endpoint
     * @param Request $request
     * @return Route
     */
    public function add(Route $route, string $method, string $endpoint, Request $request): Route
    {
        $endpoint = Str::endpointPattern($endpoint);
        $pathParameters = $request->pathParameters($endpoint);

        if ($pathParameters !== []) {
            $route->pathParameters = $pathParameters;
            return $this->routes[$method][1][$endpoint] = $route;
        }

        return $this->routes[$method][0][$endpoint] = $route;
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
        $route = @$this->routes[$request->method()][0][$request->endpoint()];

        if ($route !== null) {
            return $route;
        }

        $requestedEndpointParts = $request->endpointParts;
        $requestedEndpointPartsCount = count($requestedEndpointParts);

        $routesWithPathParameters = @$this->routes[$request->method()][1] ?? [];

        foreach ($routesWithPathParameters as $endpointName => $route) {
            $endpointParts = explode('/', $endpointName);

            if ($requestedEndpointPartsCount === count($endpointParts)) {
                foreach (array_keys($route->pathParameters) as $key) {
                    unset($requestedEndpointParts[$key]);
                    unset($endpointParts[$key]);
                }

                if ($requestedEndpointParts === $endpointParts) {
                    return $route;
                }
            }
        }

        return null;
    }
}

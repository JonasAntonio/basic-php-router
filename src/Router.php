<?php

namespace Basic\Router;

use Closure;

/**
 * Router singleton that adds routes to application
 */
class Router
{
    private static ?self $instance;
    private Request $request;
    public Routes $routes;

    private function __construct()
    {
        $this->request = Request::instance();
        $this->routes = new Routes();
    }

    /**
     * Singleton instance of itself
     *
     * @return self
     */
    public static function instance(): self
    {
        self::$instance ??= new Router();
        return self::$instance;
    }

    /**
     * Adds GET route
     *
     * @param string $endpoint
     * @param Closure $executable
     * @return Route
     */
    public function get(string $endpoint, Closure $executable): Route
    {
        return $this->addRoute($endpoint, "GET", $executable);
    }

    /**
     * Adds POST route
     *
     * @param string $endpoint
     * @param Closure $executable
     * @return Route
     */
    public function post(string $endpoint, Closure $executable): Route
    {
        return $this->addRoute($endpoint, "POST", $executable);
    }

    /**
     * Adds PUT route
     *
     * @param string $endpoint
     * @param Closure $executable
     * @return Route
     */
    public function put(string $endpoint, Closure $executable): Route
    {
        return $this->addRoute($endpoint, "PUT", $executable);
    }

    /**
     * Adds DELETE route
     *
     * @param string $endpoint
     * @param Closure $executable
     * @return Route
     */
    public function delete(string $endpoint, Closure $executable): Route
    {
        return $this->addRoute($endpoint, "DELETE", $executable);
    }

    /**
     * Adds PATCH route
     *
     * @param string $endpoint
     * @param Closure $executable
     * @return Route
     */
    public function patch(string $endpoint, Closure $executable): Route
    {
        return $this->addRoute($endpoint, "PATCH", $executable);
    }

    /**
     * Adds a route to routes array
     *
     * @param string $endpoint
     * @param string $method
     * @param Closure $executable
     * @return Route
     */
    private function addRoute(string $endpoint, string $method, Closure $executable): Route
    {
        return $this->routes->add(new Route($executable), $method, $endpoint, $this->request);
    }
}

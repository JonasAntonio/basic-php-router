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
        return $this->routes->add(new Route($executable), "GET", $endpoint);
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
        return $this->routes->add(new Route($executable), "POST", $endpoint);
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
        return $this->routes->add(new Route($executable), "PUT", $endpoint);
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
        return $this->routes->add(new Route($executable), "DELETE", $endpoint);
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
        return $this->routes->add(new Route($executable), "PATCH", $endpoint);
    }
}

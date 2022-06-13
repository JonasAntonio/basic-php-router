<?php

namespace Basic\Router;

class Runner
{
    private Router $router;
    private Request $request;

    public function __construct()
    {
        $this->router  = Router::instance();
        $this->request = Request::instance();
    }

    /**
     * Executes a route
     *
     * @return void
     */
    public function run(): void
    {
        $parameters = [];
        $route = $this->router->routes->get($this->request);

        if ($route === null) {
            $this->notFoundResponse();
            return;
        }

        $middlewareRunner = new MiddlewareRunner($this->request, $route);

        $middlewareRunner->before();
        echo call_user_func_array($route->executable, $parameters);
        $middlewareRunner->after();
    }

    /**
     * Prints a not found message with 404 status code
     *
     * @return void
     */
    private function notFoundResponse(): void
    {
        header('Content-Type: application/json', true, 404);
        echo json_encode(["message" => "Not found!"]);
    }
}

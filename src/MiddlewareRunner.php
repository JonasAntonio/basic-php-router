<?php

namespace Basic\Router;

class MiddlewareRunner
{
    private MiddlewareBefore $before;
    private MiddlewareAfter $after;

    public function __construct(Request $request, Route $route)
    {
        $this->after   = $route->after;
        $this->before  = $route->before;
        $this->request = $request;
    }

    /**
     * Executes all before middlewares
     *
     * @return void
     */
    public function before(): void
    {
        foreach ($this->before->getAll() as $middlewareBefore) {
            $middlewareBefore->handle($this->request);
        }
    }

    /**
     * Executes all after middlewares
     *
     * @return void
     */
    public function after(): void
    {
        foreach ($this->after->getAll() as $middlewareAfter) {
            $middlewareAfter->handle($this->request);
        }
    }
}

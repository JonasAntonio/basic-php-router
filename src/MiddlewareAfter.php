<?php

namespace Basic\Router;

class MiddlewareAfter
{
    /**
     * Middlewares list to execute after closure
     *
     * @var array<Middleware>
     */
    private array $after = [];

    public function add(Middleware $middleware)
    {
        $this->after[] = $middleware;
    }

    public function getAll()
    {
        return $this->after;
    }
}

<?php

namespace Basic\Router;

class MiddlewareBefore
{
    /**
     * Middlewares list to execute before closure
     *
     * @var array<Middleware>
     */
    private array $before = [];

    public function add(Middleware $middleware)
    {
        $this->before[] = $middleware;
    }

    public function getAll()
    {
        return $this->before;
    }
}

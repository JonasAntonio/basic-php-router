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

    /**
     * All before middlewares
     *
     * @return array
     */
    public function getAll(): array
    {
        return $this->before;
    }
}

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

    /**
     * Adds a middleware
     * 
     * @return self
     */
    public function add(Middleware $middleware): self
    {
        $this->before[] = $middleware;
        return $this;
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

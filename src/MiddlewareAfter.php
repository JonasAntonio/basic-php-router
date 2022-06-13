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

    /**
     * Adds a middleware
     * 
     * @return self
     */
    public function add(Middleware $middleware): self
    {
        $this->after[] = $middleware;
        return $this;
    }

    /**
     * All after middlewares
     *
     * @return array
     */
    public function getAll(): array
    {
        return $this->after;
    }
}

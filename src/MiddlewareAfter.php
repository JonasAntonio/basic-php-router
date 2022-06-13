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

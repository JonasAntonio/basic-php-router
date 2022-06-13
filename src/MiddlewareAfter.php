<?php

namespace Basic\Router;

class MiddlewareAfter
{
    private array $after;

    public function add(Middleware $middleware)
    {
        $this->after[] = $middleware;
    }

    public function getAll()
    {
        return $this->after;
    }
}

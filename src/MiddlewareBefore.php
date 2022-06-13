<?php

namespace Basic\Router;

class MiddlewareBefore
{
    private array $before;

    public function add(Middleware $middleware)
    {
        $this->before[] = $middleware;
    }

    public function getAll()
    {
        return $this->before;
    }
}

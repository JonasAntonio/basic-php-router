<?php

namespace Basic\Router;

use Closure;

/**
 * Route object
 */
class Route
{
    /**
     * Closure this route will execute
     *
     * @var Closure
     */
    public Closure $executable;

    /**
     * Execute after closure
     *
     * @var MiddlewareAfter
     */
    public MiddlewareAfter $after;

    /**
     * Execute before closure
     *
     * @var MiddlewareBefore
     */
    public MiddlewareBefore $before;

    public function __construct(Closure $executable)
    {
        $this->executable = $executable;
        $this->before = new MiddlewareBefore();
        $this->after = new MiddlewareAfter();
    }

    /**
     * Add after middleware
     *
     * @param Middleware $middleware
     * @return self
     */
    public function after(Middleware $middleware): self
    {
        $this->after->add($middleware);
        return $this;
    }

    /**
     * Add before middleware
     *
     * @param Middleware $middleware
     * @return self
     */
    public function before(Middleware $middleware): self
    {
        $this->before->add($middleware);
        return $this;
    }
}

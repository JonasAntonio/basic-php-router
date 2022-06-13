<?php

namespace Basic\Router;

interface Middleware
{
    /**
     * Executes middleware validation
     *
     * @param Request $request
     * @return void
     */
    public function handle(Request $request): void;
}

<?php

namespace Basic\Router;

interface Middleware
{
    public function handle(Request $request): void;
}

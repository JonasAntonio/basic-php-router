<?php

namespace Basic\Router;

class Str
{
    /**
     * Formats an endpoint
     * 
     * @param string $endpoint
     * @return string
     */
    public static function endpointPattern(string $endpoint): string
    {
        $endpoint = explode('?', $endpoint);
        return preg_replace('/\/$/', '', preg_replace('/^\//', '', trim($endpoint[0])));
    }
}

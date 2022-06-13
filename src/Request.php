<?php

namespace Basic\Router;

/**
 * Singleton class to get request body and header
 */
class Request
{
    private static ?self $instance = null;

    private function __construct()
    {
    }

    /**
     * Singleton instance of self
     *
     * @return self
     */
    public static function instance(): self
    {
        self::$instance ??= new Request();
        return self::$instance;
    }

    /**
     * Requested endpoint
     * 
     * @return string
     */
    public function endpoint(): string
    {
        return $_GET['url'];
    }

    /**
     * Request method
     * 
     * @return string
     */
    public function method(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Requested data as array
     * 
     * @return array
     */
    public function array(): array
    {
        return json_decode($this->json(), true) ?? [];
    }

    /**
     * Requested data as object
     * 
     * @return object
     */
    public function object(): object
    {
        return json_decode($this->json()) ?? (object) [];
    }

    /**
     * Lower case request header as array
     *
     * @return array
     */
    public function lowerCaseHeader(): array
    {
        $header = apache_request_headers();
        foreach ($header as $key => $value) {
            $header[strtolower($key)] = $value;
        }

        return $header;
    }

    /**
     * Requested path parameters
     * 
     * @return array
     */
    public function pathParameters(string $endpoint): array
    {
        $pathParameters = [];
        foreach (explode('/', $endpoint) as $key => $value) {
            if (preg_match("/{(.*)}/", $value)) {
                $pathParameters[$key] = $value;
            }
        }

        return $pathParameters;
    }

    /**
     * Request json
     * 
     * @return string
     */
    private function json(): string
    {
        $json = file_get_contents('php://input');

        if (empty($json)) {
            return json_encode(
                "GET" === $this->method() ? $_GET : $_POST
            );
        }

        return $json;
    }
}

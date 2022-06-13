<?php

namespace Basic\Router;

use RuntimeException;

/**
 * Singleton class to get request body and header
 */
class Request
{
    /**
     * Instance of Request
     *
     * @var self|null
     */
    private static ?self $instance = null;

    /**
     * Request json as string
     *
     * @var string
     */
    private string $json;

    /**
     * Exploded request endpoint array
     *
     * @var array
     */
    public array $endpointParts = [];

    private function __construct()
    {
        $this->endpointParts = explode('/', $this->endpoint());
        $this->setJson();
    }

    /**
     * Singleton instance of itself
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
        return Str::endpointPattern($_GET['url']);
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
    public function toArray(): array
    {
        return (array) json_decode($this->json, true);
    }

    /**
     * Requested data as object
     * 
     * @return object
     */
    public function json(): object
    {
        return (object) json_decode($this->json);
    }

    /**
     * Lower case request header as array
     *
     * @return array
     */
    public function header(): array
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
     * Set json
     * 
     * @return void
     */
    private function setJson(): void
    {
        $json = file_get_contents('php://input');

        if (empty($json)) {
            $json = json_encode("GET" === $this->method() ? $_GET : $_POST);
        }

        $this->json = $json;
    }
}

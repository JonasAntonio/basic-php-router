<?php

use Basic\Router\Router;
use Basic\Router\Runner;

require_once 'vendor/autoload.php';

$router = Router::instance();

$router->get('/test', function () {
    header('Content-Type: application/json', true, 404);
    echo json_encode(["message" => "Do or do not. There is no try."]);
});

$runner = new Runner();

$runner->run();

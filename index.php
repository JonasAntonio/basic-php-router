<?php

use Basic\Router\Router;
use Basic\Router\Runner;

require_once 'vendor/autoload.php';

$router = Router::instance();

$router->get('/test', function () {
    header('Content-Type: application/json', true, 404);
    echo json_encode(["message" => "Do or do not. There is no try."]);
});

$router->get('/test/{id}', function ($id) {
    header('Content-Type: application/json', true, 404);
    echo json_encode(["id" => $id]);
});

$router->post('/test', function () {
    header('Content-Type: application/json', true, 404);
    echo json_encode(["message" => "Do or do not. There is no try."]);
});

$router->post('/test/{id}', function ($id) {
    header('Content-Type: application/json', true, 404);
    echo json_encode(["id" => $id]);
});

$runner = new Runner();

$runner->run();

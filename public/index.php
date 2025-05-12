<?php
// public/index.php

declare(strict_types=1);

// 1) Autoload
require __DIR__ . '/../vendor/autoload.php';

use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

// 2) Fetch method & URI
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

// 3) Define routes
// …
$dispatcher = simpleDispatcher(function(RouteCollector $r) {
    $r->addRoute('GET',  '/',     ['BIMS\Core\Controllers\BaseController', 'index']);
    $r->addRoute('GET',  '/login', ['BIMS\Modules\IAM\Controllers\LoginController', 'showForm']);
    // …
});

// 4) Dispatch
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        http_response_code(404);
        echo "404 — Not Found";
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        http_response_code(405);
        echo "405 — Method Not Allowed";
        break;
    case FastRoute\Dispatcher::FOUND:
        [$class, $method] = $routeInfo[1];
        $vars = $routeInfo[2];

        // Simple controller call
        $controller = new $class();
        call_user_func_array([$controller, $method], $vars);
        break;
}

<?php

use League\Route\Router;
use Laminas\Diactoros\Response;
use App\Controllers\ProductController;

$router = new Router;

// Define routes
$router->get('/', [ProductController::class, 'all']);
$router->get('/test',function(){
    $response = new Response;
    $html =  "<h1>Hello Test</h1>";
    $response->getBody()->write($html);
    return $response;
});

return $router;

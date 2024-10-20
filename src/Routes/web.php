<?php

use League\Route\Router;
use Laminas\Diactoros\Response;
use App\Controllers\ProductController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

$router = new Router();

// Define routes
$router->setHost($_SERVER['HTTP_HOST']);
$router->get('/redirect', function (ServerRequestInterface $request, ResponseInterface $response) {
 $response->withHeader('Location', '/')
        ->withStatus(302);

        return $response;
});
$router->get('/', [ProductController::class, 'all']);
$router->get('/create', [ProductController::class, 'getProductsFormFields']);
$router->post('/create', [ProductController::class, 'create']);
//END

return $router;

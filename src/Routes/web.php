<?php

use League\Route\Router;
use Laminas\Diactoros\Response;
use App\Controllers\ProductController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

$container = new League\Container\Container();

$container->delegate(new League\Container\ReflectionContainer());

$container->addServiceProvider(new App\Providers\HttpServiceProvider());

$strategy = (new League\Route\Strategy\ApplicationStrategy())->setContainer($container);

$router = (new League\Route\Router())->setStrategy($strategy);

// Define routes
$router->setHost($_SERVER['HTTP_HOST']);
$router->get('/', [ProductController::class, 'all']);
$router->get('/create', [ProductController::class, 'getProductsFormFields']);
$router->post('/create', [ProductController::class, 'create']);
//END

return $router;

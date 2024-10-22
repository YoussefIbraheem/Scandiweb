<?php

use League\Route\Router;
use App\Controllers\ProductController;
use Psr\Http\Message\ServerRequestInterface;
use League\Container\Container;
use League\Route\Strategy\ApplicationStrategy;
use Laminas\Diactoros\Response;

$container = new Container();

$container->delegate(new League\Container\ReflectionContainer());

$container->addServiceProvider(new App\Providers\HttpServiceProvider());

$strategy = (new ApplicationStrategy())->setContainer($container);

$router = new Router;

$router->setStrategy($strategy);

$router->get('/', [ProductController::class, 'all']);
$router->get('/add-product', [ProductController::class, 'getProductsFormFields']);
$router->post('/add-product', [ProductController::class, 'create']);
$router->post('/delete-selected',[ProductController::class,'deleteSelected']);

return $router;

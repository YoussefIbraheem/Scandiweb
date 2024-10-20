<?php

use League\Route\Router;
use App\Controllers\ProductController;
use Psr\Http\Message\ServerRequestInterface;
use League\Container\Container;
use League\Route\Strategy\ApplicationStrategy;
use Laminas\Diactoros\Response;

// Initialize the container
$container = new Container();

// Enable auto-wiring (reflection container)
$container->delegate(new League\Container\ReflectionContainer());

// Add service providers (like HttpServiceProvider)
$container->addServiceProvider(new App\Providers\HttpServiceProvider());

// Set up the routing strategy with the container
$strategy = (new ApplicationStrategy())->setContainer($container);

// Initialize the router with the strategy
$router = (new Router())->setStrategy($strategy);

// Define routes, now resolving controllers via the container
$router->get('/', [ProductController::class, 'all']);
$router->get('/create', [ProductController::class, 'getProductsFormFields']);
$router->post('/create', [ProductController::class, 'create']);

// Return the configured router
return $router;

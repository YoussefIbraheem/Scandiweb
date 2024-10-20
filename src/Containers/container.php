<?php

use League\Container\Container;
use App\Providers\HttpServiceProvider;
use App\Models\Product;
use App\Models\Type;
use App\Logger;
use Laminas\Diactoros\Response;

// Create a new Container instance
$container = new Container();

// Register the HttpServiceProvider
$container->addServiceProvider(new HttpServiceProvider());

// Register models
$container->addShared(Product::class, Product::class);
$container->addShared(Type::class, Type::class);

// Register logger
$container->addShared(Logger::class, Logger::getInstance());

// Register response
$container->addShared(Response::class, Response::class);

// Register the ProductController
$container->addShared(App\Controllers\ProductController::class, function () use ($container) {
    return new App\Controllers\ProductController(
        $container->get(Product::class),
        $container->get(Type::class),
        $container->get(Logger::class),
        $container->get(Response::class)
    );
});

return $container;

<?php

use App\Commands\DatabaseSeeder;
use App\Logger;
use App\Models\Type;
use App\Models\Product;
use Laminas\Diactoros\Response;
use League\Container\Container;
use App\Providers\HttpServiceProvider;
use App\Seeders\ProductSeeder;
use App\Seeders\TypeSeeder;
use Laminas\Diactoros\ServerRequestFactory;
use League\Route\Route;
use Psr\Http\Message\ServerRequestInterface;

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

$container->addShared(Route::class, Route::class);

//seeders
$container->addShared(TypeSeeder::class, TypeSeeder::class)->addArgument(Type::class);
$container->addShared(ProductSeeder::class, ProductSeeder::class)->addArgument(Product::class);
$container->addShared(DatabaseSeeder::class, function () use ($container) {
    return new DatabaseSeeder(
        $container->get(TypeSeeder::class),
        $container->get(ProductSeeder::class)
    );
});

// Register the ProductController
$container->addShared(App\Controllers\ProductController::class, function () use ($container) {
    return new App\Controllers\ProductController(
        $container->get(Product::class),
        $container->get(Type::class),
        $container->get(Logger::class),
        $container->get(Response::class),
        $container->get(Route::class),
    );
});

$container->addShared(ServerRequestInterface::class, function () {

    $request = ServerRequestFactory::fromGlobals($_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);

    return $request;
});

return $container;

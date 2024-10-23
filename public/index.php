<?php

declare(strict_types=1);

use Laminas\Diactoros\ServerRequestFactory;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;

require_once __DIR__ . '/../vendor/autoload.php';




// Initialize .env 
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->safeLoad();

// Initialize the container
$container = require_once __DIR__ . '/../src/Containers/container.php';

// Initialize Routes
$router = require_once __DIR__ . '/../src/Routes/web.php';

$request = $container->get(ServerRequestInterface::class);

$response = $router->dispatch($request);

(new SapiEmitter())->emit($response);

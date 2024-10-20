<?php

declare(strict_types=1);

use Laminas\Diactoros\ServerRequestFactory;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;

require_once __DIR__ . '/../vendor/autoload.php';

// Initialize the container
$container = require_once __DIR__ . '/../src/Containers/container.php';

$router = require_once __DIR__ . '/../src/Routes/web.php';

require_once __DIR__ . '/../src/config.php';


$request = $container->get(ServerRequestInterface::class);

$response = $router->dispatch($request);

(new SapiEmitter())->emit($response);

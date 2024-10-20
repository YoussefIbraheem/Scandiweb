<?php declare(strict_types=1);

use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;

require_once __DIR__ . '/../vendor/autoload.php';

// Initialize the container
$container = require_once __DIR__ . '/../src/Containers/container.php';

// Set up your routing (your existing router)
$router = require_once __DIR__ . '/../src/Routes/web.php';

// Strip the base URI
$uri = '/Scandiweb';
$_SERVER['REQUEST_URI'] = substr($_SERVER['REQUEST_URI'], strlen($uri));

// Create the server request object from globals
$request = ServerRequestFactory::fromGlobals($_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);

// Dispatch the request using the router
$response = $router->dispatch($request);

// Emit the response to the browser
(new SapiEmitter())->emit($response);

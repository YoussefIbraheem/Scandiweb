<?php

declare(strict_types=1);

use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;

require_once __DIR__ . '/../vendor/autoload.php';

// Load config
$config = require_once __DIR__ . '/../src/config.php';

// Initialize the container
$container = require_once __DIR__ . '/../src/Containers/container.php';

// Set up your routing
$router = require_once __DIR__ . '/../src/Routes/web.php';

$projectBase = $config['base_url'];

// Check if running on PHP built-in server
if (php_sapi_name() === 'cli-server') {
    // For built-in PHP server: Remove base path from `REQUEST_URI`
    if (strpos($_SERVER['REQUEST_URI'], $projectBase) === 0) {
        $_SERVER['REQUEST_URI'] = substr($_SERVER['REQUEST_URI'], strlen($projectBase));
    }
} else {
    // For Apache, manually adjust `REQUEST_URI` if needed (this might not be necessary)
    if (strpos($_SERVER['REQUEST_URI'], $projectBase) === 0) {
        $_SERVER['REQUEST_URI'] = substr($_SERVER['REQUEST_URI'], strlen($projectBase));
    }
}

$request = ServerRequestFactory::fromGlobals($_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);

$response = $router->dispatch($request);

(new SapiEmitter())->emit($response);

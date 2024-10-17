<?php declare(strict_types=1);

use App\Views\Footer;
use App\Views\Header;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;

require_once __DIR__ . '/../vendor/autoload.php';

$router = require_once __DIR__ . '/../src/Routes/web.php';

$uri = '/Scandiweb';
$_SERVER['REQUEST_URI'] = substr($_SERVER['REQUEST_URI'], strlen($uri));

$request = ServerRequestFactory::fromGlobals($_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);

$response = $router->dispatch($request);

(new SapiEmitter())->emit($response);


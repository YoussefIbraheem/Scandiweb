<?php
use Laminas\Diactoros\Response;
use App\Controllers\ProductController;
use League\Route\Router;

$router = new Router();

// Define routes
$router->get('/', [ProductController::class, 'all']);






//END

return $router;

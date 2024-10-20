<?php
use Laminas\Diactoros\Response;
use App\Controllers\ProductController;
use League\Route\Router;

$router = new Router();

// Define routes

$router->setScheme('https')->setHost('localhost/Scandiweb');
$router->get('/', [ProductController::class, 'all']);
$router->get('/create',[ProductController::class,'getProductsFormFields']);
$router->post('/create',[ProductController::class,'create']);
//END

return $router;

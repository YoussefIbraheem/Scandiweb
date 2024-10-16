<?php

use App\Http\Request;
use App\Views\Footer;
use App\Views\Header;
use App\Views\Navbar;
use App\Views\ProductList;
require_once __DIR__ . '/../vendor/autoload.php';


$products = [
    ['id' => 1, 'title' => 'Product 1', 'body' => 'Description for Product 1'],
    ['id' => 2, 'title' => 'Product 2', 'body' => 'Description for Product 2'],
    ['id' => 3, 'title' => 'Product 3', 'body' => 'Description for Product 3'],
    ['id' => 1, 'title' => 'Product 1', 'body' => 'Description for Product 1'],
    ['id' => 2, 'title' => 'Product 2', 'body' => 'Description for Product 2'],
    ['id' => 3, 'title' => 'Product 3', 'body' => 'Description for Product 3'],
    ['id' => 1, 'title' => 'Product 1', 'body' => 'Description for Product 1'],
    ['id' => 2, 'title' => 'Product 2', 'body' => 'Description for Product 2'],
    ['id' => 3, 'title' => 'Product 3', 'body' => 'Description for Product 3'],
];


(new Header('Scandiweb product List 2'))->render();
print_r ((new Request)->getPath());
(new Footer)->render();
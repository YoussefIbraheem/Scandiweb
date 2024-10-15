<?php
require_once __DIR__ . '../../vendor/autoload.php';

use App\Layouts\Card;
use App\Layouts\Footer;
use App\Layouts\Header;
use App\Layouts\Navbar;
use App\Layouts\ProductList;

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

(new Navbar(['About'=>'https://google.com']))->render();
(new ProductList($products))->render();
(new Footer)->render();
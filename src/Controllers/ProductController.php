<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Views\ProductList;
use Twig\Environment;
use Laminas\Diactoros\Response;
use Twig\Loader\FilesystemLoader;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ProductController
{
   /**
    * Controller.
    *
    * @param \Psr\Http\Message\ServerRequestInterface $request
    */
   public function all(ServerRequestInterface $request): ResponseInterface
   {
      $response = new Response;
      $data = [
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
      
      $html = (new ProductList($data))->render();

      $response->getBody()->write($html);
      return $response;
   }
}

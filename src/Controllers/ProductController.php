<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Logger;
use App\Models\Type;
use Twig\Environment;
use App\Models\Product;
use App\Views\ProductList;
use Laminas\Diactoros\Response;
use Twig\Loader\FilesystemLoader;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ProductController
{
   public function all(ServerRequestInterface $request): ResponseInterface
   {
      $response = new Response;

      $product_model = new Product;
      $product_data = $product_model->getAll();

      if (empty($product_data)) {
         $product_model->seed();
         $product_data = $product_model->getAll();
         Logger::getInstance()->log("Seeded products count: " . count($product_data));
      }

      $html = (new ProductList($product_data))->render();
      $response->getBody()->write($html);

      return $response;
   }
}

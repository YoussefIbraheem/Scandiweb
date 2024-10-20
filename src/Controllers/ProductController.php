<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Logger;
use App\Models\Product;
use App\Models\Type;
use App\Views\ProductForm;
use App\Views\ProductList;
use Laminas\Diactoros\Request;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ProductController
{

   private Product $product_model;
   private Type $type_model;
   private Response $response;
   
   public function __construct()
   {
      $this->product_model = new Product;
      $this->type_model = new Type;
      $this->response = new Response;
   }


   public function all(): ResponseInterface
   {
      

      $product_data = $this->product_model->getAll();

      if (empty($product_data)) {
         $this->product_model->seed();
         $product_data = $this->product_model->getAll();
         Logger::getInstance()->log("Seeded products count: " . count($product_data));
      }

      $html = (new ProductList($product_data))->render();
      $this->response->getBody()->write($html);

      return $this->response;
   }


   public function getProductsFormFields(): ResponseInterface
   {
        $this->type_model = new Type;
        $type_data = $this->type_model->getAll();
        if(empty($type_data))
        {
         $this->type_model->seed();
         $type_data = $this->type_model->getAll();
         Logger::getInstance()->log("Seeded products count: " . count($type_data));
        }
        $html = (new ProductForm($type_data))->render();
        $this->response->getBody()->write($html);
        return $this->response;
    }



}

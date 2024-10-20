<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Logger;
use App\Models\Product;
use App\Models\Type;
use App\Views\ProductForm;
use App\Views\ProductList;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ProductController
{

   private Product $productModel;
   private Type $typeModel;
   private Response $response;

   public function __construct()
   {
      $this->productModel = new Product;
      $this->typeModel = new Type;
      $this->response = new Response;
   }


   public function all(): ResponseInterface
   {


      $productData = $this->productModel->getAll();

      if (empty($productData)) {
         $this->productModel->seed();
         $productData = $this->productModel->getAll();
         Logger::getInstance()->log("Seeded products count: " . count($productData));
      }

      $html = (new ProductList($productData))->render();
      $this->response->getBody()->write($html);

      return $this->response;
   }


   public function getProductsFormFields(): ResponseInterface
   {
      $this->typeModel = new Type;
      $typeData = $this->typeModel->getAll();
      if (empty($typeData)) {
         $this->typeModel->seed();
         $typeData = $this->typeModel->getAll();
         Logger::getInstance()->log("Seeded products count: " . count($typeData));
      }
      $html = (new ProductForm($typeData))->render();
      $this->response->getBody()->write($html);
      return $this->response;
   }


   public function create(ServerRequestInterface $request)
   {

      $data = $request->getParsedBody();

      $selectedType = $this->typeModel->find((int)$data['product_type'])->toArray();

      $productTypeClass = "App\\ProductTypes\\" . ucfirst(strtolower($selectedType['name']));

      $response = new Response();

      if (class_exists($productTypeClass)) {
         $productTypeInstance = new $productTypeClass();
         $processedData = $productTypeInstance->processData($data);

         $this->productModel->create([
            'sku' => $processedData['sku'],
            'name' => $processedData['name'],
            'price' => $processedData['price'],
            'type_id' => $processedData['product_type'],
            'amount' => $processedData[strtolower($selectedType['attribute_value'])]
         ]);

         Logger::getInstance()->log('Processed Form Data: ' . print_r($processedData, true));

         $response
            ->withHeader('Location', '/')
            ->withStatus(302);

         return $response;
      }

      $response = new Response();
      $response->getBody()->write('Invalid product type selected.');
      return $response;
   }
}

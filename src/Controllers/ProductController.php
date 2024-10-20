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
   private Logger $logger;
   private Response $response;

   public function __construct(Product $productModel, Type $typeModel, Logger $logger, Response $response)
   {
      $this->productModel = $productModel;
      $this->typeModel = $typeModel;
      $this->logger = $logger;
      $this->response = $response;
   }

   public function all(): ResponseInterface
   {
      $productData = $this->productModel->getAll();

      if (empty($productData)) {
         $this->productModel->seed();
         $productData = $this->productModel->getAll();
         $this->logger->log(Logger::INFO,"Seeded products count: " . count($productData));
      }

      $html = (new ProductList($productData))->render();
      $this->response->getBody()->write($html);

      return $this->response;
   }

   public function getProductsFormFields(): ResponseInterface
   {
      $typeData = $this->typeModel->getAll();
      if (empty($typeData)) {
         $this->typeModel->seed();
         $typeData = $this->typeModel->getAll();
         $this->logger->log(Logger::INFO, "Seeded product types count: " . count($typeData));
      }

      $html = (new ProductForm($typeData))->render();
      $this->response->getBody()->write($html);
      return $this->response;
   }

   public function create(ServerRequestInterface $request): ResponseInterface
   {
      $data = $request->getParsedBody();
      $selectedType = $this->typeModel->find((int)$data['product_type'])->toArray();
      $productTypeClass = "App\\ProductTypes\\" . ucfirst(strtolower($selectedType['name']));

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

         $this->logger->log(Logger::INFO, 'Processed Form Data: ' . print_r($processedData, true));

         return $this->response
            ->withHeader('Location', '/Scandiweb')
            ->withStatus(302);
      }

      $this->response->getBody()->write('Invalid product type selected.');
      return $this->response;
   }
}

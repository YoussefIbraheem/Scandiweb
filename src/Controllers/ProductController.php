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
use Twig\Environment;

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
      $this->logger = $logger::getInstance();
      $this->response = $response;
   }

   public function all(): ResponseInterface
   {
      $productData = $this->productModel->getAll();

      $html = (new ProductList($productData))->render();
      $this->response->getBody()->write($html);

      return $this->response;
   }

   public function getProductsFormFields(): ResponseInterface
   {
      $typeData = $this->typeModel->getAll();
      
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

         $skuExists = $this->productModel->checkSkuExists($processedData['sku']);

         if ($skuExists) {
            $errorMessage = "SKU already exists. Please use a unique SKU.";

            $html = (new ProductForm($this->typeModel->getAll(), $errorMessage, $data))->render();
            $this->response->getBody()->write($html);
            return $this->response;
         }

         $this->productModel->create([
            'sku' => $processedData['sku'],
            'name' => $processedData['name'],
            'price' => $processedData['price'],
            'type_id' => $processedData['product_type'],
            'amount' => $processedData[strtolower($selectedType['attribute_value'])]
         ]);

         $this->logger->info('Processed Form Data: ' . print_r($processedData, true));

         return $this->response
            ->withHeader('Location', '/')
            ->withStatus(302);
      }

      $this->response->getBody()->write('Invalid product type selected.');
      return $this->response;
   }


   public function deleteSelected(ServerRequestInterface $request): ResponseInterface
   {
      $data = $request->getParsedBody();
      $productIds = $data['ids'] ?? [];

      if (!empty($productIds)) {
         $this->productModel->deleteByIds($productIds);
         $this->logger->info('Deleted Products: ' . implode(', ', $productIds));

         return $this->response
            ->withHeader('Location', '/')
            ->withStatus(302);
      }

      $this->response->getBody()->write('No products selected for deletion.');
      return $this->response;
   }
}

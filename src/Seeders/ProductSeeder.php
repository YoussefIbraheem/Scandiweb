<?php

namespace App\Seeders;

use App\Models\Product;

class ProductSeeder
{
    private Product $productModel;

    public function __construct(Product $productModel)
    {
        $this->productModel = $productModel;
    }

    public function seed(): void
    {
        $this->productModel->seed();
    }
}

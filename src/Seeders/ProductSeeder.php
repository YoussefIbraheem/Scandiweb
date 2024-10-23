<?php

namespace App\Seeders;

use App\Models\Product;

/**
 * Class ProductSeeder
 *
 * Seeds the database with product data.
 *
 * This class is responsible for populating the database with initial or test
 * product data using the provided Product model.
 *
 * @package App\Seeders
 */
class ProductSeeder
{
    /**
     * @var Product The product model used for seeding data.
     */
    private Product $productModel;

    /**
     * ProductSeeder constructor.
     *
     * Initializes the ProductSeeder with the specified Product model.
     *
     * @param Product $productModel An instance of the Product model to use for seeding.
     */
    public function __construct(Product $productModel)
    {
        $this->productModel = $productModel;
    }

    /**
     * Seeds the product data into the database.
     *
     * This method invokes the seed method of the Product model to populate
     * the database with product records.
     */
    public function seed(): void
    {
        $this->productModel->seed();
    }
}

<?php

namespace App\Commands;

use App\Seeders\TypeSeeder;
use App\Seeders\ProductSeeder;

/**
 * Class DatabaseSeeder
 *
 * Handles the seeding of the database by coordinating 
 * the TypeSeeder and ProductSeeder classes.
 *
 * This class is responsible for executing the seeding 
 * operations for both product types and products in the database.
 *
 * @package App\Commands
 */
class DatabaseSeeder
{
    private TypeSeeder $typeSeeder;
    private ProductSeeder $productSeeder;

    /**
     * DatabaseSeeder constructor.
     *
     * @param TypeSeeder $typeSeeder An instance of TypeSeeder to seed product types.
     * @param ProductSeeder $productSeeder An instance of ProductSeeder to seed products.
     */
    public function __construct(TypeSeeder $typeSeeder, ProductSeeder $productSeeder)
    {
        $this->typeSeeder = $typeSeeder;
        $this->productSeeder = $productSeeder;
    }

    /**
     * Executes the seeding process for types and products.
     *
     * This method will first seed the types, followed by the products.
     * It outputs messages indicating the progress of the seeding process.
     *
     * @return void
     */
    public function run(): void
    {
        echo "Seeding types...\n";
        $this->typeSeeder->seed();

        echo "Seeding products...\n";
        $this->productSeeder->seed();

        echo "Seeding complete!\n";
    }
}

<?php

namespace App\Commands;

use App\Database;
use App\Seeders\TypeSeeder;
use App\Seeders\ProductSeeder;

class DatabaseSeeder
{
    private TypeSeeder $typeSeeder;
    private ProductSeeder $productSeeder;

    public function __construct(TypeSeeder $typeSeeder, ProductSeeder $productSeeder)
    {
        $this->typeSeeder = $typeSeeder;
        $this->productSeeder = $productSeeder;
    }

    public function run(): void
    {
        echo "Seeding types...\n";
        $this->typeSeeder->seed();

        echo "Seeding products...\n";
        $this->productSeeder->seed();

        echo "Seeding complete!\n";
    }
}

<?php 
namespace App\ProductTypes;

use App\ProductType;

class Book implements ProductType
{
    public function processData(array $data): array
    {
        return $data;
    }
}
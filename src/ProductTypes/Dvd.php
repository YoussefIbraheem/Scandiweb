<?php

namespace App\ProductTypes;

use App\ProductType;

class Dvd implements ProductType
{   
    public function processData(array $data): array
    {
        return $data;
    }
}

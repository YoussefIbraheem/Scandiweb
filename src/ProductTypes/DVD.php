<?php

namespace App\Models;

use App\ProductType;

class DVD implements ProductType
{
    public function processData(array $data): array
    {
        return $data;
    }
}

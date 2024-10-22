<?php

namespace App;

interface ProductType
{
    public function processData(array $data): array;
}

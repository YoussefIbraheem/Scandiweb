<?php

namespace App\ProductTypes;

use App\ProductType;

/**
 * Class Dvd
 *
 * Represents a product type for DVDs.
 *
 * This class implements the ProductType interface and provides a method
 * to process DVD-related data.
 *
 * @package App\ProductTypes
 */
class Dvd implements ProductType
{
    /**
     * Processes the DVD data.
     *
     * This method takes an array of data as input and returns it without
     * any modifications. It can be extended in the future to include
     * specific processing logic for DVD data.
     *
     * @param array $data The DVD data to process.
     * 
     * @return array The processed DVD data.
     */
    public function processData(array $data): array
    {
        return $data;
    }
}

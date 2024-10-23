<?php

namespace App;

/**
 * Interface ProductType
 *
 * Defines the contract for processing product data.
 */
interface ProductType
{
    /**
     * Process product data.
     *
     * This method is responsible for processing the given data according to the specific product type.
     * It returns an array of processed data that can be used for storing or further manipulation.
     *
     * @param array $data The input data to be processed.
     * @return array The processed data.
     */
    public function processData(array $data): array;
}

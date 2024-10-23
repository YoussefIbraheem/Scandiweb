<?php

namespace App\ProductTypes;

/**
 * Class Furniture
 *
 * Represents a product type for furniture.
 *
 * This class provides a method to process furniture-related data, specifically
 * for managing dimensions.
 *
 * @package App\ProductTypes
 */
class Furniture
{
    /**
     * Processes the furniture data.
     *
     * This method takes an array of data as input, concatenates the height,
     * width, and length into a single dimensions string, and removes the 
     * individual dimension fields from the data array.
     *
     * @param array $data The furniture data to process, which must include
     *                    height, width, and length.
     * 
     * @return array The processed furniture data with dimensions as a single
     *               string and individual dimension fields removed.
     */
    public function processData(array $data): array
    {
        // Concatenate dimensions for furniture
        $height = $data['height'] ?? null;
        $width = $data['width'] ?? null;
        $length = $data['length'] ?? null;

        $data['dimensions'] = "{$height}x{$width}x{$length}";

        // Remove individual dimension fields
        unset($data['height'], $data['width'], $data['length']);

        return $data;
    }
}

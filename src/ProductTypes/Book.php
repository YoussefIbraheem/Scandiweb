<?php 

namespace App\ProductTypes;

use App\ProductType;

/**
 * Class Book
 *
 * Represents a product type for books.
 *
 * This class implements the ProductType interface and provides a method
 * to process book-related data.
 *
 * @package App\ProductTypes
 */
class Book implements ProductType
{
    /**
     * Processes the book data.
     *
     * This method takes an array of data as input and returns it without
     * any modifications. It can be extended in the future to include
     * specific processing logic for book data.
     *
     * @param array $data The book data to process.
     * 
     * @return array The processed book data.
     */
    public function processData(array $data): array
    {
        return $data;
    }
}

<?php

namespace App\Views;

use App\Models\Product;
use App\Models\Type;
use App\Views\Card;

/**
 * Class ProductList
 *
 * Represents a list of products, rendering them as card objects.
 *
 * This class is responsible for transforming an array of product data
 * into card objects for presentation in the product list view.
 *
 * @package App\Views
 */
class ProductList extends Layout
{
    /**
     * @var array Array of card objects representing products.
     */
    private array $data = [];

    /**
     * ProductList constructor.
     *
     * Initializes the ProductList with an array of product data.
     * Each product is converted to a Card object.
     *
     * @param array $data Array of products, each containing keys for 'id', 'name', 'sku', 'price', 'amount', and 'type_id'.
     */
    public function __construct(array $data)
    {
        $this->data = array_map('self::convertToCardObject', $data);
    }

    /**
     * Renders the product list template with the card data.
     *
     * @return string Rendered HTML for the product list.
     */
    public function render(): string
    {
        return self::renderTemplate('product_list', $this->data);
    }

    /**
     * Converts a product array into a Card object.
     *
     * Retrieves the product type information and constructs a Card
     * object with the relevant product details.
     *
     * @param array $product An associative array containing product details.
     * 
     * @return Card A Card object representing the product.
     */
    private static function convertToCardObject(array $product): Card
    {
        $type = (new Type)->find($product['type_id'])->toArray();

        return new Card(
            id: $product['id'],
            name: $product['name'],
            sku: $product['sku'],
            price: $product['price'],
            amount: $product['amount'],
            typeName: $type['name'],
            attributeValue: $type['attribute_value'],
            measureUnit: $type['measure_unit']
        );
    }
}

<?php

namespace App\Views;

use App\Models\Product;
use App\Models\Type;
use App\Views\Card;

use function PHPSTORM_META\type;

class ProductList extends Layout
{
    private array $data = [];

    public function __construct($data)
    {
        $this->data = array_map('self::convertToCardObject', $data);
    }

    public function render()
    {
        return self::renderTemplate('product_list', $this->data);
    }

    private static function convertToCardObject($product)
    {
        $type = (new Type)->find($product['type_id'])->toArray();

        return (new Card(
            id: $product['id'],
            name: $product['name'],
            sku: $product['sku'],
            price: $product['price'],
            amount: $product['amount'],
            typeName: $type['name'],
            attributeValue: $type['attribute_value'],
            measureUnit: $type['measure_unit']
        ));
    }
}

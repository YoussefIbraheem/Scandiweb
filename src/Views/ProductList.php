<?php

namespace App\Views;

use App\Views\Card;


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
        return (new Card(
        id: $product['id'], 
        name: $product['name'], 
        sku: $product['sku'], 
        price: $product['price'], 
        amount: $product['amount'], 
        type_id: $product['type_id']));
    }
}

<?php

namespace App\Views;

/**
 * Class Card
 * 
 * Represents a card component that extends the Layout class and renders product information in a card format.
 */
class Card extends Layout
{
    /**
     * @var array $data Holds the product data that will be rendered in the card template.
     */
    private array $data;

    /**
     * Card constructor.
     * 
     * Initializes the card with specific product details.
     *
     * @param int    $id             The product ID.
     * @param string $name           The product name.
     * @param string $sku            The product SKU.
     * @param float  $price          The product price.
     * @param int    $amount         The amount or quantity of the product.
     * @param string $typeName       The type or category of the product.
     * @param mixed  $attributeValue A specific attribute value of the product (e.g., size, weight).
     * @param string $measureUnit    The unit of measurement for the attribute (e.g., kg, MB).
     */
    public function __construct($id, $name, $sku, $price = 0, $amount, $typeName, $attributeValue, $measureUnit)
    {
        $this->data = [
            'id' => $id,
            'name' => $name,
            'sku' => $sku,
            'price' => $price,
            'amount' => $amount,
            'typeName' => $typeName,
            'attributeValue' => $attributeValue,
            'measureUnit' => $measureUnit
        ];
    }

    /**
     * Renders the card component using the 'card' template and the provided product data.
     *
     * @return string The rendered HTML content of the card.
     */
    public function render()
    {
        return self::renderTemplate('card', $this->data);
    }
}

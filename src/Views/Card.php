<?php

namespace App\Views;

class Card extends Layout
{
  private array $data;


  public function __construct($id, $name, $sku, $price = 0, $amount, $typeName , $attributeValue , $measureUnit)
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

  public function render()
  {
    return self::renderTemplate('card', $this->data);
  }
}

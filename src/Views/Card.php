<?php

namespace App\Views;

class Card extends Layout
{
  private array $data;


  public function __construct($id, $name, $sku, $price = 0, $amount, $type_id)
  {
    $this->data = [
      'id' => $id,
      'name' => $name,
      'sku' => $sku,
      'price' => $price,
      'amount' => $amount,
      'type_id' => $type_id
    ];
  }

  public function render()
  {
    return self::renderTemplate('card', $this->data);
  }
}

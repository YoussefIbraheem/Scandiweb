<?php

namespace App\Views;

class Card extends Layout
{
  private array $data;


  public function __construct($id, $title, $body)
  {
    $this->data = [
      'id' => $id,
      'title' => $title,
      'body' => $body
    ];
  }

  public function render()
  {
    return self::renderTemplate('card', $this->data);
  }
}

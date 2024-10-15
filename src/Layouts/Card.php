<?php
namespace App\Layouts;

class Card extends Layout
{
    private array $data;
    

    public function __construct($id,$title,$body)
    {
      $this->data = [
        'id' => $id,
        'title' => $title,
        'body' => $body
      ];
    }

    public function render()
    {
        self::renderTemplate('views/card', $this->data);
    }
}

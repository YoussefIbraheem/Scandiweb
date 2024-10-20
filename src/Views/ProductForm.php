<?php 
namespace App\Views;

use App\Views\Layout;

class ProductForm extends Layout
{

    private array $data = [];

    public function __construct($types)
    {
        $this->data = $types;
    }

    public function render()
    {
        return self::renderTemplate('create_product_form',$this->data);
    }
}



?>
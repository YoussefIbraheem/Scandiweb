<?php 
namespace App\Views;

use App\Views\Layout;

class ProductForm extends Layout
{
    public function render()
    {
        return self::renderTemplate('create_product_form');
    }
}



?>
<?php 
namespace App\Models;

abstract class Product
{
    protected $sku;
    protected $name;
    protected $price;

    public function get()
    {
        
    }

    abstract public function getAttribute();
    abstract public function save();
    abstract public function delete();
}


?>
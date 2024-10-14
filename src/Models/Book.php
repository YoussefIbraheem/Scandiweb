<?php 
namespace App\Models; 
use App\Models\Product;

class Book extends Product {

    public function getAttribute()
    {
        return [
            'name' => $this->name,
            'sku' => $this->sku,
            'price' => $this->price
        ];
        
    }

    public function save()
    {
        
    }

    public function delete()
    {
        # code...
    }

}



?>
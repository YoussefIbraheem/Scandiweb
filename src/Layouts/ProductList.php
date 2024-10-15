<?php 
namespace App\Layouts;
use App\Layouts\Card;


class ProductList extends Layout
{
    private array $data;

    public function __construct($data)
    {
        $this->data = array_map('self::convertToCardObject',$data);
    }

    public function render()
    {
        self::renderTemplate('views/product_list', $this->data);
    }

    private static function convertToCardObject($product)
    {
        return (new Card($product['id'],$product['title'],$product['body']));
    }

}



?>
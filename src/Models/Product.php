<?php

namespace App\Models;

use App\Model;
use App\Database;

class Product extends Model
{
    protected static $table = 'products';
    private int $id;
    private string $sku;
    private string $name;
    private int $type_id;

    public static function fromArray(array $dbRecord): Model
    {
        $product = new self();
        $product->id = $dbRecord['id'];
        $product->sku = $dbRecord['sku'];
        $product->name = $dbRecord['name'] ;
        $product->type_id = $dbRecord['type_id'];

        return $product;
    }

    public static function create(array $data)
    {
        $db = Database::getInstance();
        $sql = 'INSERT INTO ' . static::getTable() . ' (title, body) VALUES (:title, :body)';
        $db->query($sql, [
            'title' => $data['title'],
            'body' => $data['body']
        ]);

        return $db->getConnection()->lastInsertId(); // Return the newly inserted product ID
    }
}

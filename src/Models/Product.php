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
        $product->name = $dbRecord['name'];
        $product->type_id = $dbRecord['type_id'];

        return $product;
    }

    public static function create(array $data)
    {
        $db = Database::getInstance();
        $sql = 'INSERT INTO ' . static::getTable() . ' (title, body) VALUES (:title, :body)';
        $db->query($sql, [
            'sku' => $data['sku'],
            'name' => $data['name'],
            'type_id' => $data['type_id']
        ]);

        return $db->getConnection()->lastInsertId(); // Return the newly inserted product ID
    }


    public function type()
    {
        $this->belongsTo(Type::class, 'type_id');
    }


    protected static function factory()
    {
        return [
            'sku' => strtoupper(parent::$faker->bothify('??-#####')),
            'name' => parent::$faker->name(),
            'type_id' => parent::$faker->randomDigit()
        ];
    }



    public static function seed()
    {

        $products = self::factory();
        foreach ($products as $product) {
            self::create([
                'sku' => $product['sku'],
                'name' => $product['name'],
                'type_id' => $product['type_id'],
            ]);
        };
    }
}

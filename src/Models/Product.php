<?php

namespace App\Models;

use App\Model;
use App\Database;
use App\Logger;
use Faker\Factory;

class Product extends Model
{
    protected static $table = 'products';
    private int $id;
    private string $sku;
    private string $name;
    private float $price;
    private string $amount;
    private int $type_id;

    public static function fromArray(array $dbRecord): Model
    {
        $product = new self();
        $product->id = $dbRecord['id'];
        $product->sku = $dbRecord['sku'];
        $product->name = $dbRecord['name'];
        $product->price = $dbRecord['price'];
        $product->amount = $dbRecord['amount'];
        $product->type_id = $dbRecord['type_id'];

        return $product;
    }

    public static function create(array $data)
    {
        $db = Database::getInstance();
        $sql = 'INSERT INTO ' . static::getTable() . ' (sku, name, price, amount, type_id) VALUES (:sku, :name, :price, :amount, :type_id)';
        $db->query($sql, [
            'sku' => $data['sku'],
            'name' => $data['name'],
            'price' => $data['price'],
            'amount' => $data['amount'],
            'type_id' => $data['type_id']
        ]);

        return $db->getConnection()->lastInsertId(); // Return the newly inserted product ID
    }


    public function type()
    {
        $this->belongsTo(Type::class, 'type_id');
    }

    public static function seed()
    {

        $types_empty = empty(Type::getAll());

        if($types_empty)
        {
            Type::seed();
        }

        $products = require __DIR__ . '/../../database/data.php';

        foreach ($products['products'] as $product) {
            self::create([
                'sku' => $product['sku'],
                'name' => $product['name'],
                'price' => $product['price'],
                'amount' => $product['amount'],
                'type_id' => $product['type_id'],
            ]);
        };

        Logger::getInstance()->log("Table products has been seeded!");
    }
}

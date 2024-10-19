<?php

namespace App\Models;

use App\Model;
use App\Database;
use App\Logger;

class Type extends Model
{
    protected static $table = 'types';
    private int $id;
    private string $name;
    private string $attribute_value;
    private string $measure_unit;

    public static function fromArray(array $dbRecord): Model
    {
        $type = new self();
        $type->id = $dbRecord['id'];
        $type->name = $dbRecord['name'];
        $type->attribute_value = $dbRecord['attribute_value'];
        $type->measure_unit = $dbRecord['measure_unit'];

        return $type;
    }

    public static function create(array $data)
    {
        $db = Database::getInstance();
        $sql = 'INSERT INTO ' . static::getTable() . ' (name, attribute_value, measure_unit) VALUES (:name, :attribute_value, :measure_unit)';
        $db->query($sql, [
            'name' => $data['name'],
            'attribute_value' => $data['attribute_value'],
            'measure_unit' => $data['measure_unit']
        ]);

        return $db->getConnection()->lastInsertId(); // Return the newly inserted product ID
    }

    public function products()
    {
        $this->hasMany(Product::class, 'type_id');
    }

    public static function seed()
    {
        $types = require __DIR__ . '/../../database/data.php';

        foreach ($types['types'] as $type) {
            self::create([
                'name' => $type['name'],
                'attribute_value' => $type['attribute_value'],
                'measure_unit' => $type['measure_unit']
            ]);
        }
        Logger::getInstance()->log("Table types has been seeded!");
    }
}



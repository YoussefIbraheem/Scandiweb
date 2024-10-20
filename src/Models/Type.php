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
    private string $attributeValue;
    private string $measureUnit;

    public static function fromArray(array $dbRecord): Model
    {
        $type = new self();
        $type->id = $dbRecord['id'];
        $type->name = $dbRecord['name'];
        $type->attributeValue = $dbRecord['attribute_value'];
        $type->measureUnit = $dbRecord['measure_unit'];

        return $type;
    }


    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'attribute_value' => $this->attributeValue,
            'measure_unit' => $this->measureUnit,
        ];
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

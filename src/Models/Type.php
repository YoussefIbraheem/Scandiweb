<?php

namespace App\Models;

use App\Model;
use App\Database;

class Type extends Model
{
    protected static $table = 'types';
    private int $id;
    private string $attribute_value;
    private string $measure_unit;

    public static function fromArray(array $dbRecord): Model
    {
        $type = new self();
        $type->attribute_value = $dbRecord['attribute_value'];
        $type->measure_unit = $dbRecord['measure_unit'];

        return $type;
    }

    public static function create(array $data)
    {
        $db = Database::getInstance();
        $sql = 'INSERT INTO ' . static::getTable() . ' (title, body) VALUES (:title, :body)';
        $db->query($sql, [
            'attribute_value' => $data['attribute_value'],
            'measure_unit' => $data['measure_unit']
        ]);

        return $db->getConnection()->lastInsertId(); // Return the newly inserted product ID
    }



    public function products()
    {
        $this->hasMany(Product::class, 'type_id');
    }
}

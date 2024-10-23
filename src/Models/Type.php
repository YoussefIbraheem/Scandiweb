<?php

namespace App\Models;

use App\Model;
use App\Database;
use App\Logger;

/**
 * Class Type
 *
 * Represents a product type in the application.
 *
 * This class extends the Model class and provides methods for interacting 
 * with the 'types' database table, including creating new types, 
 * converting to and from array formats, and seeding the database.
 *
 * @package App\Models
 */
class Type extends Model
{
    protected static string $table = 'types';
    
    private int $id;
    private string $name;
    private string $attributeValue;
    private string $measureUnit;

    /**
     * Creates a Type instance from an associative array.
     *
     * @param array $dbRecord The database record representing a type.
     * 
     * @return Model The Type instance populated with data from the array.
     */
    public static function fromArray(array $dbRecord): Model
    {
        $type = new self();
        $type->id = $dbRecord['id'];
        $type->name = $dbRecord['name'];
        $type->attributeValue = $dbRecord['attribute_value'];
        $type->measureUnit = $dbRecord['measure_unit'];

        return $type;
    }

    /**
     * Converts the Type instance to an associative array.
     *
     * @return array The array representation of the Type instance.
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'attribute_value' => $this->attributeValue,
            'measure_unit' => $this->measureUnit,
        ];
    }

    /**
     * Creates a new type in the database.
     *
     * @param array $data The type data, including name, attribute_value, 
     *                    and measure_unit.
     * 
     * @return int The ID of the newly created type.
     */
    public static function create(array $data): int
    {
        $db = Database::getInstance();
        $sql = 'INSERT INTO ' . static::getTable() . ' (name, attribute_value, measure_unit) VALUES (:name, :attribute_value, :measure_unit)';
        $db->query($sql, [
            'name' => $data['name'],
            'attribute_value' => $data['attribute_value'],
            'measure_unit' => $data['measure_unit']
        ]);

        return (int) $db->getConnection()->lastInsertId();
    }

    /**
     * Defines a relationship to the Product model.
     *
     * This method establishes a has-many relationship with the Product class
     * based on the type_id foreign key.
     */
    public function products(): void
    {
        $this->hasMany(Product::class, 'type_id');
    }

    /**
     * Seeds the types table with initial data.
     *
     * This method populates the types table with data from a predefined 
     * data file. It logs the seeding action.
     */
    public static function seed(): void
    {
        $types = require __DIR__ . '/../../database/data.php';

        foreach ($types['types'] as $type) {
            self::create([
                'name' => $type['name'],
                'attribute_value' => $type['attribute_value'],
                'measure_unit' => $type['measure_unit']
            ]);
        }
        
        Logger::getInstance()->info("Table types has been seeded!");
    }
}

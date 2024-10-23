<?php

namespace App\Models;

use App\Model;
use App\Database;
use App\Logger;

/**
 * Class Product
 *
 * Represents a product in the application.
 *
 * This class extends the Model class and provides methods for interacting 
 * with the 'products' database table, including creating new products, 
 * converting to and from array formats, and seeding the database.
 *
 * @package App\Models
 */
class Product extends Model
{
    protected static string $table = 'products';
    
    private int $id;
    private string $sku;
    private string $name;
    private float $price;
    private string $amount;
    private int $typeId;

    /**
     * Creates a Product instance from an associative array.
     *
     * @param array $dbRecord The database record representing a product.
     * 
     * @return Model The Product instance populated with data from the array.
     */
    public static function fromArray(array $dbRecord): Model
    {
        $product = new self();
        $product->id = $dbRecord['id'];
        $product->sku = $dbRecord['sku'];
        $product->name = $dbRecord['name'];
        $product->price = $dbRecord['price'];
        $product->amount = $dbRecord['amount'];
        $product->typeId = $dbRecord['type_id'];

        return $product;
    }

    /**
     * Converts the Product instance to an associative array.
     *
     * @return array The array representation of the Product instance.
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'sku'  => $this->sku,
            'name' => $this->name,
            'price' => $this->price,
            'amount' => $this->amount,
            'type_id' => $this->typeId,
        ];
    }

    /**
     * Creates a new product in the database.
     *
     * @param array $data The product data, including sku, name, price, 
     *                    amount, and type_id.
     * 
     * @return int The ID of the newly created product.
     */
    public static function create(array $data): int
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

        return (int) $db->getConnection()->lastInsertId();
    }

    /**
     * Checks if a SKU already exists in the database.
     *
     * @param string $sku The SKU to check.
     * 
     * @return bool True if the SKU exists, false otherwise.
     */
    public function checkSkuExists(string $sku): bool
    {
        $sql = "SELECT COUNT(*) FROM products WHERE sku = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$sku]);
        return $stmt->fetchColumn() > 0;
    }

    /**
     * Defines a relationship to the Type model.
     *
     * This method establishes a belongs-to relationship with the Type class
     * based on the type_id foreign key.
     */
    public function type(): void
    {
        $this->belongsTo(Type::class, 'type_id');
    }

    /**
     * Seeds the products table with initial data.
     *
     * This method populates the products table with data from a predefined 
     * data file. It checks if types exist and seeds them if necessary.
     * It logs the seeding action.
     */
    public static function seed(): void
    {
        $typesEmpty = empty(Type::getAll());

        if ($typesEmpty) {
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
        }

        Logger::getInstance()->info("Table products has been seeded!");
    }
}

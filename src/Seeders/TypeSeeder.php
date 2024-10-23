<?php

namespace App\Seeders;

use App\Models\Type;

/**
 * Class TypeSeeder
 *
 * Seeds the database with type data.
 *
 * This class is responsible for populating the database with initial or test
 * type data using the provided Type model.
 *
 * @package App\Seeders
 */
class TypeSeeder
{
    /**
     * @var Type The type model used for seeding data.
     */
    private Type $typeModel;

    /**
     * TypeSeeder constructor.
     *
     * Initializes the TypeSeeder with the specified Type model.
     *
     * @param Type $typeModel An instance of the Type model to use for seeding.
     */
    public function __construct(Type $typeModel)
    {
        $this->typeModel = $typeModel;
    }

    /**
     * Seeds the type data into the database.
     *
     * This method checks if type data already exists in the database.
     * If no types are found, it invokes the seed method of the Type model
     * to populate the database with type records.
     */
    public function seed(): void
    {
        $types = $this->typeModel->getAll();
        // Types are only seeded once
        if (empty($types)) {
            $this->typeModel->seed();
        }
    }
}

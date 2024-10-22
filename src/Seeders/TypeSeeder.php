<?php

namespace App\Seeders;

use App\Models\Type;

class TypeSeeder
{
    private Type $typeModel;

    public function __construct(Type $typeModel)
    {
        $this->typeModel = $typeModel;
    }

    public function seed(): void
    {
        $types = $this->typeModel->getAll();
        //types only get seeded once
        if(empty($types))
        {
            $this->typeModel->seed();
        }
    }
}

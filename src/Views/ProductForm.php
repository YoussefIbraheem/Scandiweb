<?php

namespace App\Views;

use App\Views\Layout;

class ProductForm extends Layout
{
    private array $data = [];
    private ?string $errorMessage;
    private array $inputData;

    public function __construct(array $types, ?string $errorMessage = null, array $inputData = [])
    {
        $this->data = $types;
        $this->errorMessage = $errorMessage;
        $this->inputData = $inputData;
    }

    public function render()
    {
        $viewData = array_merge([
            'types' => $this->data,
            'errorMessage' => $this->errorMessage,
            'inputData' => $this->inputData,
        ]);

        return self::renderTemplate('create_product_form', $viewData);
    }
}

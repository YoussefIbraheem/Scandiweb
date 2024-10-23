<?php

namespace App\Views;

use App\Views\Layout;

/**
 * Class ProductForm
 * 
 * This class represents a product form view component. It extends the `Layout` class and handles rendering of the product
 * creation form using Twig templates. It can handle different product types and pass error messages and form data to the view.
 */
class ProductForm extends Layout
{
    /**
     * @var array $data An array of product types to display as options in the form.
     */
    private array $data = [];
    
    /**
     * @var string|null $errorMessage A nullable string to display error messages if any.
     */
    private ?string $errorMessage;

    /**
     * @var array $inputData An array of input data for form fields, allowing the form to retain previously entered values.
     */
    private array $inputData;

    /**
     * ProductForm constructor.
     * 
     * Initializes the ProductForm object with product types, an optional error message, and optionally prefilled input data.
     * 
     * @param array $types Array of product types (e.g., DVD, Furniture, Book).
     * @param string|null $errorMessage A nullable string that stores an error message, passed to the form if available.
     * @param array $inputData Array of input data for form field values, allowing prefilled values.
     */
    public function __construct(array $types, ?string $errorMessage = null, array $inputData = [])
    {
        $this->data = $types;
        $this->errorMessage = $errorMessage;
        $this->inputData = $inputData;
    }

    /**
     * Renders the product form by passing product types, error messages, and input data to the view.
     * 
     * @return string The rendered HTML content of the product creation form.
     */
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

<?php

// dummy_data.php

// Array of types
$types = [
    [
        'id' => 1,
        'name' => 'Book',
        'attribute_value' => 'Weight',
        'measure_unit' => 'Kg',
    ],
    [
        'id' => 2,
        'name' => 'DVD',
        'attribute_value' => 'Size',
        'measure_unit' => 'MB',
    ],
    [
        'id' => 3,
        'name' => 'Furniture',
        'attribute_value' => 'Dimensions',
        'measure_unit' => 'cm', // Inferred unit for height, width, and length
    ],
];

// Array of products with corresponding type IDs
$products = [
    [
        'sku' => 'BOOK001',
        'name' => 'The Great Gatsby',
        'price' => 9.99,
        'amount' => '0.5', // Weight in Kg
        'type_id' => 1, // Corresponding to Book
    ],
    [
        'sku' => 'DVD001',
        'name' => 'Inception',
        'price' => 19.99,
        'amount' => '1500', // Size in MB
        'type_id' => 2, // Corresponding to DVD
    ],
    [
        'sku' => 'FURN001',
        'name' => 'Wooden Chair',
        'price' => 49.99,
        'amount' => '90x45x60', // Dimensions in cm (HxWxL)
        'type_id' => 3, // Corresponding to Furniture
    ],
    [
        'sku' => 'BOOK002',
        'name' => '1984',
        'price' => 12.99,
        'amount' => '0.4', // Weight in Kg
        'type_id' => 1, // Corresponding to Book
    ],
    [
        'sku' => 'DVD002',
        'name' => 'The Matrix',
        'price' => 14.99,
        'amount' => '1200', // Size in MB
        'type_id' => 2, // Corresponding to DVD
    ],
    [
        'sku' => 'FURN002',
        'name' => 'Office Desk',
        'price' => 99.99,
        'amount' => '75x120x60', // Dimensions in cm (HxWxL)
        'type_id' => 3, // Corresponding to Furniture
    ],
];

// Return the arrays
return [
    'types' => $types,
    'products' => $products,
];

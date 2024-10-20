<?php

namespace App\ProductTypes;

class Furniture
{
    public function processData(array $data): array
    {
        // Concatenate dimensions for furniture
        $height = $data['height'] ?? null;
        $width = $data['width'] ?? null;
        $length = $data['length'] ?? null;

        $data['dimensions'] = "{$height}x{$width}x{$length}";

        // Remove individual dimension fields
        unset($data['height'], $data['width'], $data['length']);

        return $data;
    }
}

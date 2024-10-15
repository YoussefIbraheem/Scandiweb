<?php

namespace App\Views;

use App\Views\Layout;

class Footer extends Layout
{
    public function render()
    {
        self::renderTemplate('views/footer');
    }
}

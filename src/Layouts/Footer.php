<?php

namespace App\Layouts;

use App\Layouts\Layout;

class Footer extends Layout
{
    public function render()
    {
        self::renderTemplate('footer');
    }
}

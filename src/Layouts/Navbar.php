<?php

namespace App\Layouts;

use App\Layouts\Layout;

class Navbar extends Layout
{
    private $menuItems;

    public function __construct(array $menuItems)
    {
        $this->menuItems = $menuItems;
    }

    public function render()
    {
        self::renderTemplate('views/navbar', $this->menuItems);
    }
}

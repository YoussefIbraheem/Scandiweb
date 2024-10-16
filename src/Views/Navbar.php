<?php

namespace App\Views;

use App\Views\Layout;

class Navbar extends Layout
{
    private $menuItems;

    public function __construct(array $menuItems)
    {
        $this->menuItems = $menuItems;
    }

    public function render()
    {
        self::renderTemplate('navbar', $this->menuItems);
    }
}

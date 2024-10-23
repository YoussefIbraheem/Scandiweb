<?php

namespace App\Views;

use App\Views\Layout;

/**
 * Class Navbar
 * 
 * This class represents a navigation bar view component. It extends the `Layout` class and provides a way to render a 
 * navigation menu using the Twig template engine.
 */
class Navbar extends Layout
{
    /**
     * @var array $menuItems An array of menu items to be displayed in the navigation bar.
     */
    private $menuItems;

    /**
     * Navbar constructor.
     * 
     * Initializes the Navbar object with an array of menu items.
     * 
     * @param array $menuItems An array of associative arrays, where each array represents a menu item with details like URL and label.
     */
    public function __construct(array $menuItems)
    {
        $this->menuItems = $menuItems;
    }

    /**
     * Renders the navigation bar by passing the menu items to the corresponding Twig template.
     * 
     * @return string The rendered HTML content of the navigation bar.
     */
    public function render()
    {
        return self::renderTemplate('navbar', $this->menuItems);
    }
}

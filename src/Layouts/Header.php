<?php

namespace App\Layouts;

use App\Layouts\Layout;

class Header extends Layout
{

    protected array $data = [];


    public function __construct($title)
    {
        $this->data = compact('title');
    }

    public function render()
    {
        self::renderTemplate('views/header', $this->data);
    }
}

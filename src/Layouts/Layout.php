<?php

namespace App\Layouts;

abstract class Layout
{
    protected static function renderTemplate($template, $data = [])
    {
        extract($data); 
        require __DIR__ . "/views/{$template}.view.php";
    }


    public abstract function render();
}

<?php

namespace App\Views;

abstract class Layout
{
    protected static function renderTemplate($template, $data = [])
    {
        $loader = new \Twig\Loader\FilesystemLoader('/');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load($template . '.html');
        echo $template->render(['data' => $data]);
    }


    public abstract function render();
}

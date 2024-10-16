<?php

namespace App\Views;

abstract class Layout
{
    protected static function renderTemplate($template, $data = [])
    {
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__);
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('html/' . $template . '.html');
        echo $template->render(['data' => $data]);
    }


    public abstract function render();
}

<?php

namespace App\Views;

abstract class Layout
{
    protected static function renderTemplate($template, $data = [])
    {
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/html');
        $twig = new \Twig\Environment($loader);
        $twig->addGlobal('baseUrl',$GLOBALS['projectBase']);
        $template = $twig->load($template .'.html');
        return $template->render(['data' => $data]);
    }


    public abstract function render();
}

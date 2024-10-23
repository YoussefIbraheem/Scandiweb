<?php

namespace App\Views;

/**
 * Class Layout
 * 
 * This abstract class provides a structure for rendering templates using the Twig templating engine. 
 * It defines a static method for rendering templates and requires child classes to implement the `render` method.
 */
abstract class Layout
{
    /**
     * Renders a Twig template with the given data.
     * 
     * @param string $template The name of the template to load and render (without the .html extension).
     * @param array  $data     An associative array of data to be passed to the template for rendering.
     * 
     * @return string The rendered HTML content of the template.
     */
    protected static function renderTemplate($template, $data = [])
    {
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/html');
        $twig = new \Twig\Environment($loader);
        
        // Adds a global variable `baseUrl` to the Twig environment using the base path defined in the environment.
        $twig->addGlobal('baseUrl', $_ENV['BASE_PATH']);
        
        // Loads and renders the specified template with the provided data.
        $template = $twig->load($template . '.html');
        return $template->render(['data' => $data]);
    }

    /**
     * Abstract render method to be implemented by subclasses.
     * 
     * This method will define how the specific view or layout is rendered.
     *
     * @return string The rendered output.
     */
    public abstract function render();
}

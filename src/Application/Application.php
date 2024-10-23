<?php

namespace App\Application;

use League\Route\Router;

/**
 * Class Application
 *
 * This class serves as the main entry point for the application.
 * It initializes the router for handling HTTP routes and requests.
 *
 * @package App\Application
 */
class Application
{
    public Router $router;

    /**
     * Application constructor.
     *
     * Initializes the router instance for the application.
     */
    public function __construct()
    {
        $this->router = new Router;
    }
}

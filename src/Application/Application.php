<?php

namespace App\Application;

use League\Route\Router;

class Application
{

    public Router $router;

    public function __construct()
    {
        $this->router = new Router;
    }
}

<?php

namespace App\Application;

use App\Routers\Router;

class Application
{

    public Router $router;

    public function __construct()
    {
        $this->router = new Router;
    }

    public function run()
    {
        $this->router->resolve();
    }
}

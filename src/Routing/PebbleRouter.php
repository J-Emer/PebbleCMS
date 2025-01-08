<?php 

namespace Jemer\PebbleCms\Routing;

use Bramus\Router\Router;

class PebbleRouter
{
    private Router $router;

    public function __construct()
    {
        $this->router = new Router();
        $this->SetRoutes();
    }

    private function SetRoutes()
    {
        $this->router->setNamespace("Jemer\PebbleCms\Controllers");

        $this->router->get("/", "MainController@index");
        $this->router->get("/post/{slug}", "MainController@post");
        $this->router->get("/page/{slug}", "MainController@page");
        $this->router->get("/category/{slug}", "MainController@category");
    }

    public function Run()
    {
        $this->router->run();
    }
}


?>
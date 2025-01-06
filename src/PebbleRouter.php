<?php 

namespace Jemer\PebbleCms;

use Bramus\Router\Router;

class PebbleRouter
{
    private $router;

    public function __construct()
    {
        $this->router = new Router();
        $this->LoadRoutes();
    }

    private function LoadRoutes()
    {
        $this->router->setNamespace("\Jemer\PebbleCms\Controllers");

        $this->router->get("/", "MainController@index");
        $this->router->get("/post/{slug}", "MainController@post");
        $this->router->get("/page/{slug}", "MainController@page");
        $this->router->get("/cagegory/{slug}", "MainController@category");

        //todo: add in admin routes
    }

    public function run()
    {
        $this->router->run();
    }
}

?>
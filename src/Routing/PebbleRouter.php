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


        //----------------admin routes-----------------//
        $this->router->get("/admin", "AdminController@index");
        $this->router->get("/admin/dashboard", "AdminController@dashboard");
        $this->router->get("/admin/users", "AdminController@users");
        $this->router->get("/admin/pages", "AdminController@pages");
        $this->router->get("/admin/posts", "AdminController@posts");
        $this->router->get("/admin/settings", "AdminController@settings");
        $this->router->get("/admin/posts/newpost", "AdminController@newpost");



    }

    public function Run()
    {
        $this->router->run();
    }
}


?>
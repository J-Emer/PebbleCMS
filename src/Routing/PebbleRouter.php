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
        $this->router->get("/admin/login", "AdminController@showlogin");
        $this->router->get("/admin/logout", "AdminController@logout");


        
        $this->router->get("/admin", "AdminController@index");
        $this->router->get("/admin/dashboard", "AdminController@dashboard");
        $this->router->get("/admin/users", "AdminController@users");
        $this->router->get("/admin/pages", "AdminController@pages");
        $this->router->get("/admin/posts", "AdminController@posts");
        $this->router->get("/admin/settings", "AdminController@settings");
        $this->router->get("/admin/posts/newpost", "AdminController@newpost");
        $this->router->get("/admin/pages/newpage", "AdminController@newpage");

        $this->router->post("/admin/handlelogin", "AdminController@handlelogin");
        $this->router->post("/admin/posts/addnewpost", "AdminController@addnewpost");
        $this->router->post("/admin/pages/addnewpage", "AdminController@addnewpage");


        $this->router->get("/admin/post/edit/{slug}", "AdminController@editpost");


        $this->router->post("/admin/post/update", "AdminController@updatepost");




    }

    public function Run()
    {
        $this->router->run();
    }
}


?>
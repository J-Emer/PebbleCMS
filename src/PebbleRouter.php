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
        $this->router->get("/category/{slug}", "MainController@category");
        $this->router->get("/categories", "MainController@categories");

        $this->router->set404(function() {
            echo "404 - Page Not Found";  // Simple 404 message
        });

        //todo: add in admin routes

        $this->router->get('/admin/dashboard', 'AdminController@dashboard');
        $this->router->get('/admin/posts', 'AdminController@posts');
        $this->router->get('/admin/pages', 'AdminController@pages');
        $this->router->get('/admin/settings', 'AdminController@settings');
        $this->router->get('/admin/users', 'AdminController@users');

    }

    public function run()
    {
        $this->router->run();
    }
}

?>
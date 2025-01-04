<?php

namespace Jemer\PebbleCms;

use Bramus\Router\Router;

class PebbleRouter
{
    private $router;

    public function __construct()
    {
        $this->router = new Router();

        $this->router->setNamespace("Jemer\PebbleCms\Controllers");

        //basic routes for app functionality
        $this->router->get('/', "MainController@index");
        $this->router->get('/page/{slug}', "MainController@page");
        $this->router->get('/post/{slug}', "MainController@post");
        $this->router->get('/category/{slug}', "MainController@category");


        //todo: add routes for admin functionality

        $this->router->get("/admin", "AdminController@index");

    }

    public function dispatch()
    {
        $this->router->run();
    }


}

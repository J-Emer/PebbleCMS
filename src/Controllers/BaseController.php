<?php 

namespace Jemer\PebbleCms\Controllers;

class BaseController
{
    protected function dd($args) : void
    {
        echo "<pre>";
        var_dump($args);
        echo "</pre>";
    } 
}

?>
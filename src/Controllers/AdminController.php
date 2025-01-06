<?php

namespace Jemer\PebbleCms\Controllers;

use Jemer\PebbleCms\App;
use Jemer\PebbleCms\Loaders\ContentLoader;
use Jemer\PebbleCms\Loaders\TemplateRenderer;

class AdminController extends BaseController
{
    private TemplateRenderer $renderer;

    public function __construct()
    {
        parent::__construct();
        $this->renderer = new TemplateRenderer(THEMES_DIR . "/default");
    }

    public function dashboard()
    {

    }

    public function posts()
    {

    }

    public function pages()
    {

    }

    public function settings()
    {

    }

    public function users()
    {

    }


}

?>

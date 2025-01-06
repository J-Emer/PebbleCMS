<?php 

namespace Jemer\PebbleCms\Controllers;

use Jemer\PebbleCms\App;
use Jemer\PebbleCms\Loaders\ContentLoader;
use Jemer\PebbleCms\Loaders\TemplateRenderer;
use Jemer\PebbleCms\Loggers\DebugLog;
use Jemer\PebbleCms\Loggers\ErrorLog;
use Jemer\PebbleCms\Loggers\ScreenLog;

class MainController extends BaseController
{
    private TemplateRenderer $renderer;

    public function __construct()
    {
        parent::__construct();
        $this->renderer = new TemplateRenderer(THEMES_DIR . "/default");
    }

    public function index()
    {
        $homeSlug = App::getInstance()->getConfig("site.homepage");
        $this->page($homeSlug);
    }
    public function page($slug)
    {       
        //$data = $this->pagesLoader->loadContentBySlug($slug);

        //$data === null ? $this->Handle404($slug) : $this->renderer->render($data['template'], array_merge($data, ["categories" => $this->GetCategories()]));
    }

}

?>
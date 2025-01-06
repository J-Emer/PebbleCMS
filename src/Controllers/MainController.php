<?php 

namespace Jemer\PebbleCms\Controllers;

use Jemer\PebbleCms\App;
use Jemer\PebbleCms\Loaders\ContentLoader;
use Jemer\PebbleCms\Loaders\TemplateRenderer;

class MainController extends BaseController
{
    public function index()
    {
        $homeSlug = App::getInstance()->getConfig("site.homepage");
        $this->page($homeSlug);

    //    $contentLoader = new ContentLoader(PAGES_DIR);
    //    $renderer = new TemplateRenderer(THEMES_DIR . "/default");
    //    $data = $contentLoader->loadContentBySlug("home");
    //    $renderer->render($data['template'], $data);
    }
    public function page($slug)
    {
        $contentLoader = new ContentLoader(PAGES_DIR);
        $renderer = new TemplateRenderer(THEMES_DIR . "/default");
        $data = $contentLoader->loadContentBySlug($slug);
        $renderer->render($data['template'], $data);
    }
    public function post($slug)
    {

    }
    public function category($slug)
    {

    }
}

?>
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
        $data = $this->pagesLoader->loadContentBySlug($slug);

        $data === null ? $this->Handle404($slug) : $this->renderer->render($data['template'], array_merge($data, ["categories" => $this->GetCategories()]));
    }
    public function post($slug)
    {
        $data = $this->postsLoader->loadContentBySlug($slug);

        $data === null ? $this->Handle404($slug) : $this->renderer->render($data['template'], array_merge($data, ["categories" => $this->GetCategories()]));

    }
    /**
     * Gets all of the posts by category
     */
    public function category($slug)
    {
        $data = $this->postsLoader->getPostsByCategory($slug);

        $data === null ? $this->Handle404($slug) : $this->renderer->render('category', ["posts" => $data, "category" => $slug, "categories" => $this->GetCategories()]);
    }

    /**
     * Gets all of the categories
     */
    public function categories()
    {
        $data = $this->postsLoader->getAllCategories();

        $data === null ? $this->Handle404("Categories") : $this->renderer->render('categories', ["posts" => $data, "categories" => $data]);

        // echo "Categories: <br/>";

        // foreach ($data as $cat) 
        // {
        //     echo $cat . "<br/>";
        // }
    }
    protected function Handle404($page)
    {
        $this->renderer->render('404', ["slug" => $page]);
    }

    private function GetCategories() : array
    {
        return $this->postsLoader->getAllCategories();
    }
}

?>
<?php 

namespace Jemer\PebbleCms\Controllers;

use Jemer\PebbleCms\App;
use Jemer\PebbleCms\Loaders\ContentLoader;
use Jemer\PebbleCms\Loaders\TemplateLoader;

class MainController extends BaseController
{
    public function index()
    {
        $this->page(
            App::getInstance()->GetConfig("site.homepage")
        );
    }
    public function post($slug)
    {
        $post = $this->contentLoader->loadContent($slug);

        $tempLoader = new TemplateLoader(
            THEME_DIR . DIRECTORY_SEPARATOR . App::getInstance()->GetConfig("theme.name")
        );
        $tempLoader->Render($post['metadata']['template'], array(
            "meta" => $post['metadata'],
            "content" => $post['content'],
            "categories" => $this->GetCategories()
        ));
    }
    public function page($slug)
    {
        $page = $this->contentLoader->loadContent($slug);

        $tempLoader = new TemplateLoader(
            THEME_DIR . DIRECTORY_SEPARATOR . App::getInstance()->GetConfig("theme.name")
        );
        $tempLoader->Render($page['metadata']['template'], array(
            "meta" => $page['metadata'],
            "content" => $page['content'],
            "categories" => $this->GetCategories()
        ));
    }  
    
    /**
     * Gets all posts from a specific category
     */
    public function category($slug)
    {
        $posts = $this->contentLoader->getPostsByCategory($slug);

        $tempLoader = new TemplateLoader(
            THEME_DIR . DIRECTORY_SEPARATOR . App::getInstance()->GetConfig("theme.name")
        );
        $tempLoader->Render('category', array(
            "posts" => $posts,
            "categories" => $this->GetCategories()
        ));
    }
}

?>
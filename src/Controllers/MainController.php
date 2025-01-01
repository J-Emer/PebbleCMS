<?php 

namespace Jemer\PebbleCms\Controllers;

use Jemer\PebbleCms\App;

class MainController extends BaseController
{
    public function index()
    {      
        $this->page(App::getInstance()->getConfigLoader()->get("site.homepage"));
    
    }
    public function page($slug)
    {
        $pageData = App::getInstance()->getContentLoader()->loadPage($slug);

        if ($pageData === null) {
            $this->error();
            return;
        }

        $this->render($pageData['template'] . '.twig.html', $pageData);
    }
    public function post($slug)
    {
        $postData = App::getInstance()->getContentLoader()->loadPost($slug);

        if ($postData === null) {
            $this->error();
            return;
        }

        $this->render($postData['template'] . '.twig.html', $postData);
    }
    public function category($categorySlug)
    {   
        // Load all posts and filter by category
        $posts = App::getInstance()->getContentLoader()->loadAllPosts();

        $categoryPosts = array_filter($posts, function ($post) use ($categorySlug) {
            return in_array($categorySlug, $post['categories']);
        });
    
        // Pass the filtered posts to the template
        $this->render('category.twig.html', [
            'category' => $categorySlug,
            'posts' => $categoryPosts,
            'title' => "{$categorySlug} Posts",
            'description' => "Posts under the {$categorySlug} category",
        ]);
    }
    public function error()
    {
        $this->render('404.twig.html', []);
    }
}

?>
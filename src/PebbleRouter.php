<?php

namespace Jemer\PebbleCms;

use Bramus\Router\Router;
use Jemer\PebbleCms\ContentLoader;

class PebbleRouter
{
    private $router;
    private $contentLoader;
    private $configLoader;

    public function __construct(ContentLoader $contentLoader, ConfigLoader $configLoader)
    {
        $this->contentLoader = $contentLoader;
        $this->configLoader = $configLoader;

        // Initialize the router
        $this->router = new Router();

        // Define routes
        $this->router->get('/', [$this, 'handleHome']);
        $this->router->get('/page/{slug}', [$this, 'handlePage']); // Dynamic page route
        $this->router->get('/post/{slug}', [$this, 'handlePost']); // Dynamic post route
        $this->router->get('/category/{slug}', [$this, 'handleCategory']); // Dynamic post route
    }

    public function dispatch()
    {
        // Dispatch the request
        $this->router->run();
    }

    public function handleHome()
    {
        // Load site configuration
        $siteName = $this->configLoader->get('site.name');
        $siteDescription = $this->configLoader->get('site.description');
        
        // Load the home page (for now)
        $pageData = $this->contentLoader->loadPage('home');
        $pageData['title'] = $siteName;
        $pageData['description'] = $siteDescription;
        
        $this->render($pageData['template'] . '.twig.html', $pageData);
    }

    public function handlePage($slug)
    {
        $pageData = $this->contentLoader->loadPage($slug);

        if ($pageData === null) {
            $this->handle404();
            return;
        }

        // Load site configuration
        $siteName = $this->configLoader->get('site.name');
        $siteDescription = $this->configLoader->get('site.description');

        $pageData['title'] = $siteName;
        $pageData['description'] = $siteDescription;

        $this->render($pageData['template'] . '.twig.html', $pageData);
    }

    public function handlePost($slug)
    {
        $postData = $this->contentLoader->loadPost($slug);

        if ($postData === null) {
            $this->handle404();
            return;
        }

        // Load site configuration
        $siteName = $this->configLoader->get('site.name');
        $siteDescription = $this->configLoader->get('site.description');

        $postData['title'] = $siteName;
        $postData['description'] = $siteDescription;

        $this->render($postData['template'] . '.twig.html', $postData);
    }

    public function handleCategory($categorySlug)
    {
        // Load site configuration
        $siteName = $this->configLoader->get('site.name');
        $siteDescription = $this->configLoader->get('site.description');
    
        // Load all posts and filter by category
        $posts = $this->contentLoader->loadAllPosts();
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
    

    private function handle404(){
        $this->render('404.twig.html', []);
    }

    private function render($template, $data)
    {
        $templateRenderer = new TemplateRenderer($this->configLoader);
        $templateRenderer->render($template, array_merge($data, ['siteCategories' => $this->GetCategories()]));
    }

    private function GetCategories()
    {
                // Load all posts
        $posts = $this->contentLoader->loadAllPosts();

        // Gather unique categories
        return array_unique(array_merge(...array_map(function ($post) {
            return $post['categories'];
        }, $posts)));
    }
}

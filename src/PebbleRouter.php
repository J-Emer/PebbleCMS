<?php

namespace Jemer\PebbleCms;

use Bramus\Router\Router;
use Jemer\PebbleCms\ContentLoader;

class PebbleRouter
{
    private $router;
    private $contentLoader;

    public function __construct(ContentLoader $contentLoader)
    {
        $this->contentLoader = $contentLoader;

        // Initialize the router
        $this->router = new Router();

        // Define routes
        $this->router->get('/', [$this, 'handleHome']);
        $this->router->get('/page/{slug}', [$this, 'handlePage']); // Dynamic page route
        $this->router->get('/post/{slug}', [$this, 'handlePost']); // Dynamic post route
    }

    public function dispatch()
    {
        // Dispatch the request
        $this->router->run();
    }

    public function handleHome()
    {
        // Load a static home page (for now)
        $pageData = $this->contentLoader->loadPage('home');
        $this->render('page.twig.html', $pageData);
    }

    public function handlePage($slug)
    {
        $pageData = $this->contentLoader->loadPage($slug);

        if ($pageData === null) {
            $this->handle404();
            return;
        }

        $this->render('page.twig.html', $pageData);
    }

    public function handlePost($slug)
    {
        $postData = $this->contentLoader->loadPost($slug);

        if ($postData === null) {
            $this->handle404();
            return;
        }

        $this->render('post.twig.html', $postData);
    }

    private function handle404(){
        $this->render('404.twig.html', []);
    }

    private function render($template, $data)
    {
        $templateRenderer = new TemplateRenderer();
        $templateRenderer->render($template, $data);
    }
}

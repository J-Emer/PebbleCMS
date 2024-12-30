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

    private function handle404(){
        $this->render('404.twig.html', []);
    }

    private function render($template, $data)
    {
        $templateRenderer = new TemplateRenderer($this->configLoader);
        $templateRenderer->render($template, $data);
    }
}

<?php

use Jemer\PebbleCms\ContentLoader;
use Jemer\PebbleCms\TemplateRenderer;

require_once __DIR__ . '/../vendor/autoload.php';



// Initialize ContentLoader
$contentLoader = new ContentLoader(__DIR__ . '/../content');

// Load a page (for example, "about")
$pageData = $contentLoader->loadPage('contact');

// If page is not found, handle the 404
if ($pageData === null) {
    header("HTTP/1.0 404 Not Found");
    echo "Page not found.";
    exit;
}

// Initialize TemplateRenderer to render the content with Twig
$templateRenderer = new TemplateRenderer();

// Render the page using Twig
echo $templateRenderer->render('page.twig.html', [
    'title' => $pageData['title'],
    'description' => $pageData['description'],
    'content' => $pageData['content'],
]);

<?php 

namespace Jemer\PebbleCms\Controllers;

use Jemer\PebbleCms\App;
use Jemer\PebbleCms\TemplateRenderer;

class BaseController
{
    private $renderer;
    protected $siteName;
    protected $siteDescription;

    public function __construct()
    {
        $this->renderer = new TemplateRenderer(App::getInstance()->getConfigLoader());
        $this->siteName = App::getInstance()->getConfigLoader()->get('site.name');
        $this->siteDescription = App::getInstance()->getConfigLoader()->get('site.description');
    }

    protected function render($template, $data)
    {
        $this->renderer->render($template, array_merge($data, ['siteCategories' => $this->GetCategories(), "siteName" => $this->siteName, "siteDescription" => $this->siteDescription]));
    }

    protected function GetCategories()
    {
                // Load all posts
        $posts = App::getInstance()->getContentLoader()->loadAllPosts();

        // Gather unique categories
        return array_unique(array_merge(...array_map(function ($post) {
            return $post['categories'];
        }, $posts)));
    }

    protected function dd($data)
    {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
    }
}


?>
<?php 

namespace Jemer\PebbleCms\Controllers;

use Jemer\PebbleCms\Loaders\ContentLoader;
use Jemer\PebbleCms\Loaders\TemplateRenderer;

class BaseController
{
    protected ContentLoader $pagesLoader;
    protected ContentLoader $postsLoader;


    public function __construct()
    {
        $this->pagesLoader = new ContentLoader(PAGES_DIR);
        $this->postsLoader = new ContentLoader(POSTS_DIR);
    }

    protected function dd($args) : void
    {
        echo "<pre>";
        var_dump($args);
        echo "</pre>";
    } 

}

?>
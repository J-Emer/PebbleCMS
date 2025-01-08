<?php 

namespace Jemer\PebbleCms\Controllers;

use Jemer\PebbleCms\Loaders\ContentLoader;

class BaseController
{
    protected ContentLoader $contentLoader;

    public function __construct()
    {
        $this->contentLoader = new ContentLoader();
    }

    protected function dd($data)
    {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
    }

    protected function GetCategories() : array
    {
        return $this->contentLoader->getCategories();
    }
}

?>
<?php 

namespace Jemer\PebbleCms\Loaders;

use Jemer\PebbleCms\App;
use Jemer\PebbleCms\TwigExtensions\AssetPathExtension;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TemplateLoader
{
    private Environment $twig;

    public function __construct(string $tempPath)
    {
        $loader = new FilesystemLoader($tempPath);

        $doCache = App::getInstance()->GetConfig("cache.enabled");

        $this->twig = new Environment(
                                           $loader,
                                           $doCache ? ['cache' => CACHE_DIR] : []
                                        );




        $this->twig->addExtension(new AssetPathExtension("http://localhost:8000/themes/default"));                                     
    }

    public function Render(string $template, array $arr)
    {
        echo $this->twig->render($template . ".twig.html", $arr);
    }
}


?>
<?php 

namespace Jemer\PebbleCms\Loaders;

use Jemer\PebbleCms\TwigExtensions\AssetPathExtension;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TemplateLoader
{
    private Environment $twig;

    public function __construct(string $tempPath)
    {
        $loader = new FilesystemLoader($tempPath);
        $this->twig = new Environment(
                                        $loader,
                                        [
                                            'cache' => CACHE_DIR
                                        ]
                                     );

        $this->twig->addExtension(new AssetPathExtension("http://localhost:8000/themes/default"));                                     
    }

    public function Render(string $template, array $arr)
    {
        echo $this->twig->render($template . ".twig.html", $arr);
    }
}


?>
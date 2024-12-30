<?php

namespace Jemer\PebbleCms;

use Jemer\PebbleCms\TwigExtensions\AssetTwigExtension;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TemplateRenderer
{
    private $twig;
    private $configLoader;

    public function __construct(ConfigLoader $configLoader)
    {
        // Set up the Twig loader and environment
        $this->configLoader = $configLoader;
        $theme = $this->configLoader->get('theme.path');
        $themePath = $theme . '/' . 'templates';
        //$loader = new FilesystemLoader(__DIR__ . '/../themes/default/templates');

        echo "theme path: " . $themePath . "<br/>";

        $loader = new FilesystemLoader($themePath);
        $this->twig = new Environment($loader);
        $this->twig->addExtension(new AssetTwigExtension(
                                                            $this->configLoader->get('site.url'),
                                                            $this->configLoader->get('theme.path')
                                                        ));

    }

    public function render(string $template, array $data = [])
    {
        // Render the template with the provided data
        echo $this->twig->render($template, $data);
    }
}

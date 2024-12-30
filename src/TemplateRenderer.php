<?php

namespace Jemer\PebbleCms;

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
        $themePath = "/../" . $theme . '/templates';
        //$loader = new FilesystemLoader(__DIR__ . '/../themes/default/templates');
        $loader = new FilesystemLoader(__DIR__ . $themePath);
        $this->twig = new Environment($loader);

        // echo "Theme: " . $this->configLoader->get('theme.path') . "<br/>";
        // echo "Theme Path: " . $themePath . "<br/>";
    }

    public function render(string $template, array $data = [])
    {
        // Render the template with the provided data
        echo $this->twig->render($template, $data);
    }
}

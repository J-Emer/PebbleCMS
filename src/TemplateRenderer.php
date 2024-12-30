<?php

namespace Jemer\PebbleCms;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TemplateRenderer
{
    private $twig;

    public function __construct()
    {
        // Set up the Twig loader and environment
        $loader = new FilesystemLoader(__DIR__ . '/../themes/default/templates');
        $this->twig = new Environment($loader);
    }

    public function render(string $template, array $data = [])
    {
        // Render the template with the provided data
        echo $this->twig->render($template, $data);
    }
}

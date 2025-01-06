<?php

namespace Jemer\PebbleCms\Loaders;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class TemplateRenderer
{
    /**
     * The Twig Environment instance.
     *
     * @var Environment
     */
    private $twig;

    /**
     * Constructor initializes the Twig environment with the template directory.
     *
     * @param string $templateDirectory Path to the templates directory.
     */
    public function __construct(string $templateDirectory)
    {
        
        $loader = new FilesystemLoader($templateDirectory);

        $this->twig = new Environment($loader, [
            'cache' => ROOT_DIR . '/cache', 
            'debug' => true,  
        ]);
    }

    /**
     * Renders the specified template with the provided arguments.
     *
    */
    public function render(string $templateName, array $args = []): void
    {
        echo $this->twig->render($templateName . '.twig.html', $args);
    }
}

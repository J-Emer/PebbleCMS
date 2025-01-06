<?php

namespace Jemer\PebbleCms\TwigExtensions;

use Jemer\PebbleCms\App;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AssetExtension extends AbstractExtension
{
    private string $baseUrl;
    private string $theme;

    public function __construct()
    {
        $this->baseUrl = App::getInstance()->getConfig('site.base_url');
        $this->theme = App::getInstance()->getConfig('site.theme');

    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('css', [$this, 'getCssUrl']),
            new TwigFunction('js', [$this, 'getJsUrl']),
        ];
    }

    public function getCssUrl(string $fileName): string
    {
        return "{$this->baseUrl}/themes/{$this->theme}/css/{$fileName}";
    }

    public function getJsUrl(string $fileName): string
    {
        return "{$this->baseUrl}/themes/{$this->theme}/js/{$fileName}";
    }
}

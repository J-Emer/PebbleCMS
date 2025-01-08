<?php

namespace Jemer\PebbleCms\TwigExtensions;

use Jemer\PebbleCms\App;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AssetPathExtension extends AbstractExtension
{
    private $basePath;

    public function __construct()
    {
        $this->basePath = App::getInstance()->GetConfig("site.base_url") . "/" . App::getInstance()->GetConfig("theme.path");
    }

    /**
     * Get the list of custom Twig functions.
     *
     * @return array
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('asset_path', [$this, 'getAssetPath']),
        ];
    }

    /**
     * Returns the full path to a CSS or JS file.
     *
     * @param string $filename The name of the file (without extension)
     * @param string $type The type of file ('css' or 'js')
     * @return string The full URL or path to the file
     */
    public function getAssetPath(string $filename, string $type): string
    {
        // Validate file type
        if (!in_array($type, ['css', 'js'])) {
            throw new \InvalidArgumentException('Invalid file type. Must be "css" or "js".');
        }

        // Determine the directory based on the type
        $directory = $type === 'css' ? 'css' : 'js';

        // Return the full path
        return $this->basePath . DIRECTORY_SEPARATOR . $directory . DIRECTORY_SEPARATOR . $filename . '.' . $type;
    }
}

<?php

namespace Jemer\PebbleCms\TwigExtensions;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AdminAssetsExtension extends AbstractExtension
{
    /**
     * Return the list of custom Twig functions.
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('admin_css', [$this, 'getAdminCssPath']),
            new TwigFunction('admin_js', [$this, 'getAdminJsPath']),
        ];
    }

    /**
     * Generate the URL for a CSS file located in the _admin directory.
     *
     * @param string $filename The CSS file name.
     * @return string
     */
    public function getAdminCssPath(string $filename): string
    {
        return '/_admin/css/' . $filename;
    }

    /**
     * Generate the URL for a JS file located in the _admin directory.
     *
     * @param string $filename The JS file name.
     * @return string
     */
    public function getAdminJsPath(string $filename): string
    {
        return '/_admin/js/' . $filename;
    }
}

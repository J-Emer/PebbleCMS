<?php 

namespace Jemer\PebbleCms\TwigExtensions;

use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;

class AssetTwigExtension extends AbstractExtension
{
    private $baseURL;
    private $themePath;

    public function __construct(string $baseurl, string $themePath)
    {
        $this->baseURL = $baseurl;
        $this->themePath = $themePath;
    }

    // Define the paths for images and JS assets
    private $assetPaths = [
        'images' => '/assets/images',
        'js' => '/assets/js',
        'css' => '/assets'  
    ];

    // Define the functions this extension provides
    public function getFunctions()
    {
        return [
            new TwigFunction('asset', [$this, 'getAssetPath']),
        ];
    }

    // Function that returns the full path to the asset
    public function getAssetPath($filename, $type = 'images')
    {
        // Validate the type (either 'images' or 'js')
        if (!isset($this->assetPaths[$type])) {
            throw new \InvalidArgumentException("Invalid asset type: $type");
        }

        // If the type is 'css', use the theme's CSS directory and filename
        if ($type === 'css') {
            // If a specific CSS file is provided, use that; otherwise, use the default
            $filename = $filename ?: "style.css";
            //$cssPath = "../themes/default/assets/" . $filename;
            
            $cssPath = $this->themePath . '/' . $this->assetPaths[$type] . '/' . $filename;
            
            return $cssPath;
        }

        // Return the full path to the asset
        return $this->assetPaths[$type] . '/' . $filename;
    }
}



?>
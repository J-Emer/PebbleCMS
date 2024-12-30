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
    public function getAssetPath($asset, $type = 'images')
    {
        // Get the base URL for the asset type
        switch ($type) {
            case 'js':
                $basePath = '/assets/js/';
                break;
            case 'css':
                $basePath = '/' . $this->themePath . '/' . 'assets/';
                break;
            case 'images':
            default:
                $basePath = '/assets/images/';
                break;
        }
    
        // Return the full URL path
        return $basePath . $asset;
    }
}



?>
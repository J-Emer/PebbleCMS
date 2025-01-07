<?php

use Jemer\PebbleCms\Loaders\ConfigLoader;
use Jemer\PebbleCms\Loaders\ContentLoader;
use Jemer\PebbleCms\Loaders\TemplateLoader;

require "vendor/autoload.php";
require "src/Bootstrap.php";

$configLoader = new ConfigLoader("config.yaml");

$contentLoader = new ContentLoader();
$post = $contentLoader->loadContent('platform-updates');

$tempRenderer = new TemplateLoader(
    THEME_DIR . DIRECTORY_SEPARATOR . $configLoader->get("theme.name")
);
$tempRenderer->Render($post['metadata']['template'], array(
    "meta" => $post['metadata'],
    "content" => $post['content']
));


?>
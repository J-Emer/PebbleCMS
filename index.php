<?php

use Jemer\PebbleCms\Loaders\ContentLoader;

require "vendor/autoload.php";
require "src/Bootstrap.php";

$contentLoader = new ContentLoader(__DIR__ . "/content");
$data = $contentLoader->loadContent('platform-updates');

echo 'Title: ' . $data['metadata']['title'] . "\n";
echo 'Template: ' . $data['metadata']['template'] . "\n";
echo 'Slug: ' . $data['metadata']['slug'] . "\n";
echo 'Category: ' . $data['metadata']['category'] . "\n";

echo 'Content: ' . $data['content'] . "\n";


echo "------------------------------------------------";

var_dump($contentLoader->getCategories());


?>
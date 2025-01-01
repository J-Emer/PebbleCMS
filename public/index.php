<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Jemer\PebbleCms\App;
use Jemer\PebbleCms\ConfigLoader;
use Jemer\PebbleCms\ContentLoader;
use Jemer\PebbleCms\PebbleRouter;

define("Version", "0.0.1");
define("CONTENT_DIR", dirname(__DIR__, 1) . "\content");



// // Initialize ContentLoader
// $contentLoader = new ContentLoader(__DIR__ . '/../content');

// // Initialize ConfigLoader
// $configLoader = new ConfigLoader(__DIR__ . '/../config.yaml');

// // Initialize the Router
// $router = new PebbleRouter($contentLoader, $configLoader);

// // Dispatch the request to the appropriate handler
// $router->dispatch();

$app = App::getInstance();
$app->run();

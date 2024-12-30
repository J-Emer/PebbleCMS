<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Jemer\PebbleCms\ConfigLoader;
use Jemer\PebbleCms\ContentLoader;
use Jemer\PebbleCms\PebbleRouter;

// Initialize ContentLoader
$contentLoader = new ContentLoader(__DIR__ . '/../content');

// Initialize ConfigLoader
$configLoader = new ConfigLoader(__DIR__ . '/../config.yaml');

// Initialize the Router
$router = new PebbleRouter($contentLoader, $configLoader);

// Dispatch the request to the appropriate handler
$router->dispatch();

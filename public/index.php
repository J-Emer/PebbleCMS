<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Jemer\PebbleCms\ContentLoader;
use Jemer\PebbleCms\PebbleRouter;

// Initialize ContentLoader
$contentLoader = new ContentLoader(__DIR__ . '/../content');

// Initialize the Router
$router = new PebbleRouter($contentLoader);

// Dispatch the request to the appropriate handler
$router->dispatch();

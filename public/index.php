<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Jemer\PebbleCms\App;

define("Version", "0.0.1");

$app = App::getInstance();
$app->run();

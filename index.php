<?php

use Jemer\PebbleCms\App;
use Jemer\PebbleCms\ConfigLoader;
use Jemer\PebbleCms\ContentLoader;
use Jemer\PebbleCms\PathHelper;
use Jemer\PebbleCms\TemplateRenderer;

require "vendor/autoload.php";
require "src/Bootstrap.php";


$app = App::getInstance();
$app->run();


?>
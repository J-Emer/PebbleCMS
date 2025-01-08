<?php

use Jemer\PebbleCms\App;
use Jemer\PebbleCms\Loaders\ConfigLoader;
use Jemer\PebbleCms\Loaders\ContentLoader;
use Jemer\PebbleCms\Loaders\TemplateLoader;

require "vendor/autoload.php";
require "src/Bootstrap.php";


App::getInstance()->Run();






?>
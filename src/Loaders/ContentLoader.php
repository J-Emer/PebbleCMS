<?php

namespace Jemer\PebbleCms\Loaders;

use Jemer\PebbleCms\Loggers\ScreenLog;
use Jemer\PebbleCms\Loggers\ScreenLogger;
use League\CommonMark\CommonMarkConverter;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Yaml\Yaml;

class ContentLoader
{
    private $contentDirectory;
    private $filesystem;
    private $markdownConverter;

    public function __construct(string $contentDirectory)
    {
        $this->contentDirectory = rtrim($contentDirectory, DIRECTORY_SEPARATOR);
        $this->filesystem = new Filesystem();
        $this->markdownConverter = new CommonMarkConverter();
    }


}

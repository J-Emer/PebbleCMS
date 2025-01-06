<?php

namespace Jemer\PebbleCms\Loaders;

use League\CommonMark\CommonMarkConverter;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Symfony\Component\Filesystem\Filesystem;


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


    /**
     * Loads a page's content by its slug and returns all front-matter and content in a single array.
     *
     * @param string $slug The slug of the page (e.g., 'home', 'about', etc.)
     * @return array The combined front-matter and content of the page.
     * @throws \Exception If the content file does not exist or cannot be read.
     */
    public function loadContentBySlug(string $slug)
    {
        $filePath = $this->getFilePathBySlug($slug);
        
        if (!$this->filesystem->exists($filePath)) {
            throw new \Exception("Content file for slug '{$slug}' does not exist. Looked in: {$this->contentDirectory}");
        }

        $frontMatter = YamlFrontMatter::parseFile($filePath);

        // Merge front-matter and content into one array
        $data = $frontMatter->matter();
        $data['content'] = $this->markdownConverter->convert($frontMatter->body());

        return $data;
    }

    /**
     * Retrieves the file path for a page given its slug.
     *
     * @param string $slug The slug of the page.
     * @return string The file path of the Markdown file.
     */
    private function getFilePathBySlug(string $slug) : string
    {
        $filePath = $this->contentDirectory . DIRECTORY_SEPARATOR . $slug . '.md';
        return $filePath;
    }

    /**
     * Retrieves all available slugs (page filenames without the extension) in the content directory.
     *
     * @return array List of slugs.
     */
    public function getAllSlugs() : array
    {
        $slugs = [];
        
        // Check if the content directory exists
        if ($this->filesystem->exists($this->contentDirectory)) {
            $files = scandir($this->contentDirectory);
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..' && pathinfo($file, PATHINFO_EXTENSION) === 'md') {
                    $slugs[] = pathinfo($file, PATHINFO_FILENAME);
                }
            }
        }

        return $slugs;
    }
}

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
            ScreenLog::log(__FILE__, "Content file for slug {$slug} could not be found. Looked in {$this->contentDirectory}");
            return null; // Returning null to indicate the file was not found
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
     * Retrieves all available posts slugs (filenames without the extension) in the posts directory.
     *
     * @return array List of posts slugs.
     */
    public function getAllPosts() : array
    {
        return $this->getAllContentFromDirectory($this->contentDirectory . DIRECTORY_SEPARATOR . 'posts');
    }

    /**
     * Retrieves all available pages slugs (filenames without the extension) in the pages directory.
     *
     * @return array List of pages slugs.
     */
    public function getAllPages() : array
    {
        return $this->getAllContentFromDirectory($this->contentDirectory . DIRECTORY_SEPARATOR . 'pages');
    }

    /**
     * Helper function to get all slugs (filenames without extension) in a directory.
     *
     * @param string $directory The directory to scan.
     * @return array List of content slugs.
     */
    private function getAllContentFromDirectory(string $directory) : array
    {
        $content = [];
        
        if ($this->filesystem->exists($directory)) {
            $files = scandir($directory);
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..' && pathinfo($file, PATHINFO_EXTENSION) === 'md') {
                    $content[] = pathinfo($file, PATHINFO_FILENAME);
                }
            }
        }

        return $content;
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

    public function getAllCategories()
    {
        $categories = [];
        $files = scandir($this->contentDirectory);

        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..' && pathinfo($file, PATHINFO_EXTENSION) === 'md') {
                $postData = Yaml::parseFile($this->contentDirectory . DIRECTORY_SEPARATOR . $file);
                if (isset($postData['category'])) {
                    $categories = array_merge($categories, $postData['category']);
                }
            }
        }

        // Remove duplicates and return the categories
        return array_values(array_unique($categories));
    }

    public function getPostsByCategory(string $slug)
    {
        $posts = [];
        $files = scandir($this->contentDirectory);

        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..' && pathinfo($file, PATHINFO_EXTENSION) === 'md') {
                $postData = Yaml::parseFile($this->contentDirectory . DIRECTORY_SEPARATOR . $file);
                if (in_array($slug, $postData['category'] ?? [])) {
                    $posts[] = $postData;
                }
            }
        }

        return !empty($posts) ? $posts : null; // Return posts belonging to the category
    }
}

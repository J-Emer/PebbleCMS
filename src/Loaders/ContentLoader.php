<?php

namespace Jemer\PebbleCms\Loaders;

use Jemer\PebbleCms\Loggers\ScreenLogger;
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



    public function loadContentBySlug(string $slug)
    {
        $filePath = $this->getFilePathBySlug($slug);
        
        if (!$this->filesystem->exists($filePath)) {
           return null;
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

    public function getPostsByCategory(string $category)
    {
        $posts = [];
    
        // Get all Markdown files (slugs)
        $slugs = $this->getAllSlugs();
    
        foreach ($slugs as $slug) {
            $data = $this->loadContentBySlug($slug);
            
            // Check if the category matches
            if (isset($data['category']) && $data['category'] === $category) {
                $posts[] = $data;  // Add matching post to the list
            }
        }
    
        return $posts;
    }

    public function getAllCategories()
    {
        $categories = [];
    
        // Get all slugs (Markdown files)
        $slugs = $this->getAllSlugs();
    
        foreach ($slugs as $slug) {
            $data = $this->loadContentBySlug($slug);
            
            // If a category is set in the front matter, add it to the list
            if (isset($data['category']) && !in_array($data['category'], $categories)) {
                $categories[] = $data['category'];
            }
        }
    
        return $categories;
    }


}

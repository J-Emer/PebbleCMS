<?php

namespace Jemer\PebbleCms\Loaders;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Yaml\Exception\ParseException;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use League\CommonMark\CommonMarkConverter;

class ContentLoader
{
    private $filesystem;
    private $baseDir;
    private $contentDirs = ['pages', 'posts'];

    public function __construct()
    {
        $this->filesystem = new Filesystem();
        $this->baseDir = rtrim(CONTENT_DIR, DIRECTORY_SEPARATOR);
    }

    /**
     * Load content based on the slug (e.g., "exciting-feature")
     *
     * @param string $slug
     * @return array|null
     * @throws \Exception
     */
    public function loadContent(string $slug): ?array
    {
        $filePath = $this->findFilePathBySlug($slug);

        if ($filePath === null || !$this->filesystem->exists($filePath)) {
            echo "***" . "file '{$slug}' not found***" . PHP_EOL;
        }

        return $this->parseFile($filePath);
    }

    /**
     * Find the file path for the given slug.
     *
     * @param string $slug
     * @return string|null
     */
    private function findFilePathBySlug(string $slug): ?string
    {
        $dirPath = $this->baseDir;

        if ($this->filesystem->exists($dirPath)) {
            // Search through the subdirectories of posts
            $filePath = $this->searchFileInDirectory($dirPath, $slug);
            if ($filePath !== null) {
                return $filePath;
            }
        }

        return null;
    }

    /**
     * Search for a file by slug inside a directory.
     *
     * @param string $dirPath
     * @param string $slug
     * @return string|null
     */
    private function searchFileInDirectory(string $dirPath, string $slug): ?string
    {
        // Look for .md files in this directory (and subdirectories for posts)
        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($dirPath));
        foreach ($iterator as $fileInfo) {
            if ($fileInfo->isFile() && $fileInfo->getExtension() === 'md') {
                $fileName = pathinfo($fileInfo->getFilename(), PATHINFO_FILENAME);
                if ($fileName === $slug) {
                    return $fileInfo->getRealPath();
                }
            }
        }

        return null;
    }

    /**
     * Parse the content of a Markdown file and return the parsed content and metadata.
     *
     * @param string $filePath
     * @return array
     */
    private function parseFile(string $filePath): array
    {
        try {
            // Parse front matter
            $file = YamlFrontMatter::parseFile($filePath);
            $metadata = $file->matter(); // YAML front matter
            $content = $file->body(); // Markdown content

            // Optionally convert Markdown to HTML using CommonMark
            $converter = new CommonMarkConverter();
            $contentHtml = $converter->convert($content);

            return [
                'metadata' => $metadata,
                'content' => $contentHtml,
            ];
        } catch (ParseException $e) {
            throw new \Exception("Failed to parse YAML front matter from file '{$filePath}'.");
        }
    }

    public function getCategories(): array
    {
        $categories = [];
        $postsDir = $this->baseDir . DIRECTORY_SEPARATOR . 'posts';

        if ($this->filesystem->exists($postsDir)) {
            // Scan the /posts directory for subdirectories (categories)
            $directories = new \DirectoryIterator($postsDir);
            foreach ($directories as $dir) {
                if ($dir->isDir() && !$dir->isDot()) {
                    // Add the directory name to categories
                    $categories[] = $dir->getBasename();
                }
            }
        }

        return $categories;
    }

    public function getPostsByCategory(string $category): array
    {
        $categoryDir = $this->baseDir . DIRECTORY_SEPARATOR . 'posts' . DIRECTORY_SEPARATOR . $category;

        if (!$this->filesystem->exists($categoryDir) || !is_dir($categoryDir)) {
            throw new \Exception("Category '{$category}' not found.");
        }

        $posts = [];
        $iterator = new \DirectoryIterator($categoryDir);
        foreach ($iterator as $fileInfo) {
            if ($fileInfo->isFile() && $fileInfo->getExtension() === 'md') {
                // Load and parse the post
                $filePath = $fileInfo->getRealPath();
                $postData = $this->parseFile($filePath);
                $posts[] = $postData;
            }
        }

        return $posts;
    }




    //------------------experimental----------------------//

        /**
     * Get all posts from the /content/posts directory, regardless of category.
     *
     * @return array
     */
    public function getAllPosts(): array
    {
        $posts = [];
        $postsDir = $this->baseDir . DIRECTORY_SEPARATOR . 'posts';

        if ($this->filesystem->exists($postsDir)) {
            // Recursively scan the /posts directory for .md files
            $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($postsDir));
            foreach ($iterator as $fileInfo) {
                if ($fileInfo->isFile() && $fileInfo->getExtension() === 'md') {
                    $filePath = $fileInfo->getRealPath();
                    $postData = $this->parseFile($filePath);
                    $posts[] = $postData;
                }
            }
        }

        return $posts;
    }

    /**
     * Get all pages from the /content/pages directory.
     *
     * @return array
     */
    public function getAllPages(): array
    {
        $pages = [];
        $pagesDir = $this->baseDir . DIRECTORY_SEPARATOR . 'pages';

        if ($this->filesystem->exists($pagesDir)) {
            // Scan the /pages directory for .md files
            $iterator = new \DirectoryIterator($pagesDir);
            foreach ($iterator as $fileInfo) {
                if ($fileInfo->isFile() && $fileInfo->getExtension() === 'md') {
                    $filePath = $fileInfo->getRealPath();
                    $pageData = $this->parseFile($filePath);
                    $pages[] = $pageData;
                }
            }
        }

        return $pages;
    }

        /**
     * Get the total count of all posts in the system.
     *
     * @return int
     */
    public function getAllPostsCount(): int
    {
        $count = 0;
        $postsDir = $this->baseDir . DIRECTORY_SEPARATOR . 'posts';

        if ($this->filesystem->exists($postsDir)) {
            // Recursively scan the /posts directory for .md files
            $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($postsDir));
            foreach ($iterator as $fileInfo) {
                if ($fileInfo->isFile() && $fileInfo->getExtension() === 'md') {
                    $count++;
                }
            }
        }

        return $count;
    }

       /**
     * Get the total count of all pages in the system.
     *
     * @return int
     */
    public function getAllPagesCount(): int
    {
        $count = 0;
        $pagesDir = $this->baseDir . DIRECTORY_SEPARATOR . 'pages';

        if ($this->filesystem->exists($pagesDir)) {
            // Scan the /pages directory for .md files
            $iterator = new \DirectoryIterator($pagesDir);
            foreach ($iterator as $fileInfo) {
                if ($fileInfo->isFile() && $fileInfo->getExtension() === 'md') {
                    $count++;
                }
            }
        }

        return $count;
    }
}

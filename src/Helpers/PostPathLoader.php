<?php

namespace Jemer\PebbleCms\Helpers;

use Symfony\Component\Filesystem\Filesystem;

class PostPathLoader
{
    private $contentDir;

    public function __construct($contentDir)
    {
        // Ensure content directory exists
        $this->contentDir = rtrim($contentDir, '/');
    }

    /**
     * Recursively retrieve all post markdown files, regardless of category.
     *
     * @return array An array of post file paths.
     */
    public function getAllPosts()
    {
        $postFiles = [];
        $postsDir = $this->contentDir . '/posts';

        if (is_dir($postsDir)) {
            // Recursively scan the posts directory
            $this->scanDirectory($postsDir, $postFiles);
        }

        return $postFiles;
    }

    /**
     * Recursively scan a directory and collect all markdown files.
     *
     * @param string $dir The directory to scan.
     * @param array &$postFiles The array to store the file paths.
     */
    private function scanDirectory($dir, &$postFiles)
    {
        $filesystem = new Filesystem();

        if ($filesystem->exists($dir) && is_dir($dir)) {
            $files = scandir($dir);

            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    $filePath = $dir . '/' . $file;

                    // If it's a directory, recurse into it
                    if (is_dir($filePath)) {
                        $this->scanDirectory($filePath, $postFiles);
                    }

                    // If it's a markdown file, add it to the list
                    elseif (pathinfo($filePath, PATHINFO_EXTENSION) === 'md') {
                        $postFiles[] = $filePath;
                    }
                }
            }
        }
    }
}

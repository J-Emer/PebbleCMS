<?php

namespace Jemer\PebbleCms\Savers;

use Symfony\Component\Filesystem\Filesystem;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class PageSaver
{
    private $contentDir;
    private $filesystem;

    public function __construct($contentDir)
    {
        // Ensure content directory exists
        $this->contentDir = rtrim($contentDir, '/');
        $this->filesystem = new Filesystem();

        if (!$this->filesystem->exists($this->contentDir)) {
            $this->filesystem->mkdir($this->contentDir); // Create directory if it doesn't exist
        }
    }

    /**
     * Save content to a markdown file with frontmatter.
     *
     * @param array $data Form data including title, content, author, etc.
     * @return bool Success or failure of saving the file.
     */
    public function saveContent($data) : bool
    {
        // Ensure necessary fields are provided
        if (empty($data['title']) || empty($data['content']) || empty($data['slug'])) {
            return false; // Missing essential data
        }

        // Generate frontmatter
        $frontmatter = $this->generateFrontmatter($data);

        // Prepare the markdown content (actual post content)
        $content = $frontmatter . "\n\n" . $data['content'];

        // Define the path where the markdown file will be saved
        $filePath = $this->contentDir . '/' . 'pages/' . $data['slug'] . '.md';

        // Use Symfony Filesystem to save content to file
        try {
            $this->filesystem->dumpFile($filePath, $content);
            return true; // Successfully saved the content
        } catch (\Exception $e) {
            return false; // Failed to save the content
        }
    }

    /**
     * Generate the frontmatter for the markdown file.
     *
     * @param array $data Data to be included in the frontmatter.
     * @return string The formatted frontmatter.
     */
    private function generateFrontmatter($data)
    {
        // Build frontmatter using YamlFrontMatter
        $frontmatter = "---\n";
        $frontmatter .= "title: \"" . addslashes($data['title']) . "\"\n";
        $frontmatter .= "template: " . (isset($data['template']) ? "\"" . addslashes($data['template']) . "\"" : 'page') . "\n";
        //$frontmatter .= "keywords: " . $this->generateKeywords($data['keywords']) . "\n";
        $frontmatter .= "slug: \"" . addslashes($data['slug']) . "\"\n";
        $frontmatter .= "---\n";

        return $frontmatter;
    }

    /**
     * Convert the keywords array into YAML format.
     *
     * @param array $keywords
     * @return string YAML formatted string for the keywords.
     */
    private function generateKeywords($keywords)
    {
        return "[" . implode(", ", array_map(function ($keyword) {
            return '"' . addslashes($keyword) . '"';
        }, $keywords)) . "]";
    }
}

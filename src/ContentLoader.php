<?php

namespace Jemer\PebbleCms;

use League\CommonMark\CommonMarkConverter;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class ContentLoader
{
    private $contentDir;

    public function __construct(string $contentDir)
    {
        $this->contentDir = $contentDir;
    }

    public function loadPage(string $slug)
    {
        $filePath = $this->contentDir . '/pages/' . $slug . '.md';

        if (!file_exists($filePath)) {
            return null; // Page not found
        }

        return $this->parseFile($filePath);
    }

    public function loadPost(string $slug)
    {
        $filePath = $this->contentDir . '/posts/' . $slug . '.md';

        if (!file_exists($filePath)) {
            return null; // Post not found
        }

        return $this->parseFile($filePath);
    }

    private function parseFile(string $filePath)
    {
        // Get the file contents
        $file = file_get_contents($filePath);

        // Parse front matter
        $document = YamlFrontMatter::parse($file);

        // Convert Markdown content to HTML
        $converter = new CommonMarkConverter();
        $htmlContent = $converter->convert($document->body());

        // Get the front matter data (metadata)
        $frontMatter = $document->matter();

        // Return parsed data (metadata + HTML content)
        return [
            'title' => $frontMatter['title'] ?? 'Untitled',
            'description' => $frontMatter['description'] ?? 'No description available.',
            'content' => $htmlContent,
        ];
    }
}

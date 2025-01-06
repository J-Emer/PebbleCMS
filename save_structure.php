<?php

/**
 * Recursively scans a directory and saves its structure to a text file, ignoring specified directories.
 *
 * @param string $directory The root directory to scan.
 * @param string $outputFile The file to save the structure to.
 * @param array $ignoredDirs List of directories to ignore (relative to the root).
 */
function saveDirectoryStructure(string $directory, string $outputFile, array $ignoredDirs = [])
{
    $structure = scanDirectory($directory, '', $ignoredDirs, $directory);
    file_put_contents($outputFile, $structure);
    echo "Directory structure saved to {$outputFile}\n";
}

/**
 * Recursively scans a directory and returns its structure as a string.
 *
 * @param string $directory The directory to scan.
 * @param string $prefix Used internally for indentation.
 * @param array $ignoredDirs List of directories to ignore (relative to the root).
 * @param string $rootDir The root directory (used to resolve relative ignored directories).
 * @return string The formatted directory structure.
 */
function scanDirectory(string $directory, string $prefix = '', array $ignoredDirs = [], string $rootDir = ''): string
{
    $structure = '';
    $files = scandir($directory);

    foreach ($files as $file) {
        if ($file === '.' || $file === '..') {
            continue;
        }

        $filePath = $directory . DIRECTORY_SEPARATOR . $file;

        // Convert ignored directories to absolute paths for comparison
        $relativePath = str_replace($rootDir . DIRECTORY_SEPARATOR, '', $filePath);
        if (in_array($relativePath, $ignoredDirs, true)) {
            continue;
        }

        // Append `/` to directory names and adjust indentation
        if (is_dir($filePath)) {
            $structure .= $prefix . "/{$file}/" . PHP_EOL;
            $structure .= scanDirectory($filePath, $prefix . '    ', $ignoredDirs, $rootDir);
        } else {
            $structure .= $prefix . "    {$file}" . PHP_EOL;
        }
    }

    return $structure;
}

// Define the directory to scan and the output file
$projectRoot = __DIR__; // Change to your project's root if necessary
$outputFile = $projectRoot . DIRECTORY_SEPARATOR . 'directory_structure.txt';

// Define directories to ignore (relative to the project root)
$ignoredDirs = [
    'vendor',
    'cache',
    '.git',
];

// Save the directory structure
saveDirectoryStructure($projectRoot, $outputFile, $ignoredDirs);

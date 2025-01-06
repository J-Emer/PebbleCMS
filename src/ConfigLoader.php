<?php

namespace Jemer\PebbleCms;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class ConfigLoader
{
    private $config;
    private $filePath;
    private $filesystem;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
        $this->filesystem = new Filesystem();
        $this->loadConfig();
    }

    /**
     * Loads the YAML configuration file.
     *
     * @throws \Exception If the file does not exist or is invalid.
     */
    private function loadConfig()
    {
        if (!$this->filesystem->exists($this->filePath)) {
            throw new \Exception("Config file does not exist: {$this->filePath}");
        }

        // Load the YAML file using Symfony YAML component
        try {
            $this->config = Yaml::parseFile($this->filePath);
        } catch (\Exception $e) {
            throw new \Exception("Error parsing YAML file: {$e->getMessage()}");
        }
    }

    /**
     * Retrieves a value from the configuration.
     *
     * @param string $key The key to retrieve from the config.
     * @param mixed $default The default value to return if the key doesn't exist.
     * @return mixed The value from the config or the default value.
     */
    public function get(string $key, $default = null)
    {
        return $this->getValue($this->config, $key, $default);
    }

    /**
     * Helper function to access nested values in the YAML structure.
     *
     * @param array $array The array to search within.
     * @param string $key The key to search for.
     * @param mixed $default The default value to return if the key is not found.
     * @return mixed The value or the default value.
     */
    private function getValue(array $array, string $key, $default)
    {
        $keys = explode('.', $key);
        $value = $array;

        foreach ($keys as $keyPart) {
            if (isset($value[$keyPart])) {
                $value = $value[$keyPart];
            } else {
                return $default;
            }
        }

        return $value;
    }

    /**
     * Retrieves front-matter data from a Markdown file.
     *
     * @param string $file The path to the Markdown file.
     * @return \Spatie\YamlFrontMatter\Document The front-matter data.
     */
    public function getFrontMatter(string $file)
    {
        try {
            return YamlFrontMatter::parseFile($file);
        } catch (\Exception $e) {
            throw new \Exception("Error reading front-matter: {$e->getMessage()}");
        }
    }

    /**
     * Saves configuration back to the YAML file.
     *
     * @throws \Exception If an error occurs while writing the file.
     */
    public function saveConfig()
    {
        try {
            $yamlContent = Yaml::dump($this->config, 2, 4);
            file_put_contents($this->filePath, $yamlContent);
        } catch (\Exception $e) {
            throw new \Exception("Error saving YAML file: {$e->getMessage()}");
        }
    }

    /**
     * Get the raw parsed config.
     *
     * @return array
     */
    public function getRawConfig(): array
    {
        return $this->config;
    }

    public function Dump()
    {
        var_dump($this->config);
    }
}

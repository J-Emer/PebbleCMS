<?php

namespace Jemer\PebbleCms\Loaders;

use Symfony\Component\Yaml\Yaml;

class ConfigLoader
{
    private $config;

    public function __construct(string $configFile)
    {
        // Load and parse the YAML file into a PHP array
        if (!file_exists($configFile)) {
            throw new \Exception("Config file not found: {$configFile}");
        }

        $this->config = Yaml::parseFile($configFile);
    }

    /**
     * Get a specific configuration value by its key.
     *
     * @param string $key The configuration key, e.g., 'app.name'
     * @return mixed|null The configuration value or null if not found.
     */
    public function get(string $key)
    {
        $keys = explode('.', $key);
        $value = $this->config;

        foreach ($keys as $k) {
            if (isset($value[$k])) {
                $value = $value[$k];
            } else {
                return null; // Return null if the key doesn't exist
            }
        }

        return $value;
    }

    /**
     * Get all configuration data.
     *
     * @return array The entire configuration array.
     */
    public function getAll(): array
    {
        return $this->config;
    }
}

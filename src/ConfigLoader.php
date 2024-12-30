<?php

namespace Jemer\PebbleCms;

use Symfony\Component\Yaml\Yaml;

class ConfigLoader
{
    private $config;

    public function __construct($configPath = __DIR__ . '/../config.yaml')
    {
        $this->config = Yaml::parseFile($configPath);
    }

    public function get($key)
    {
        $keys = explode('.', $key);
        $value = $this->config;

        foreach ($keys as $key) {
            if (isset($value[$key])) {
                $value = $value[$key];
            } else {
                return null;  // Return null if the key doesn't exist
            }
        }

        return $value;
    }
}

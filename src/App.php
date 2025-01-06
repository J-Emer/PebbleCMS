<?php

namespace Jemer\PebbleCms;


class App
{
    /**
     * The single instance of the App class.
     *
     * @var App
     */
    private static $instance;

    /**
     * Configuration array to store settings.
     *
     * @var array
     */
    private $configLoader;

    private $router;


    /**
     * Private constructor to prevent instantiation.
     */
    private function __construct()
    {
        // Initialize the configuration or other services.
        //$this->configLoader = new ConfigLoader()
        $configPath = dirname(__DIR__, 1) . "/config.yaml";
        $this->configLoader = new ConfigLoader($configPath);
        $this->router = new PebbleRouter();
    }

    /**
     * Returns the single instance of the App class.
     *
     * @return App
     */
    public static function getInstance(): App
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * Get the configuration value by key.
     *
     * @param string $key
     * @return mixed|null
     */
    public function getConfig(string $key)
    {
        return $this->configLoader->get($key);
    }

    public function run() : void
    {
        $this->router->run();
    }

    /**
     * Prevent cloning the singleton instance.
     */
    public function __clone()
    {
        // Cloning is not allowed
    }

    /**
     * Prevent unserializing the singleton instance.
     */
    public function __wakeup()
    {
        // Unserialization is not allowed
    }
}

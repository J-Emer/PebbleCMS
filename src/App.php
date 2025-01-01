<?php

namespace Jemer\PebbleCms;

use Jemer\PebbleCms\ConfigLoader;
use Jemer\PebbleCms\ContentLoader;
use Jemer\PebbleCms\PebbleRouter;

class App
{
    private static ?App $instance = null;
    private PebbleRouter $router;
    private ConfigLoader $configLoader;
    private ContentLoader $contentLoader;

    private function __construct()
    {
        // Load configuration
        $configPath = dirname(__DIR__) . '/config.yaml';
        $this->configLoader = new ConfigLoader($configPath);

        // Load content
        $contentDir = dirname(__DIR__) . '/content';
        $this->contentLoader = new ContentLoader($contentDir);

        // Initialize router
        $this->router = new PebbleRouter($this->contentLoader, $this->configLoader);
    }

    /**
     * Get the single instance of the App
     *
     * @return App
     */
    public static function getInstance(): App
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Run the application
     */
    public function run()
    {
        $this->router->dispatch();
    }

    /**
     * Get the ConfigLoader instance
     *
     * @return ConfigLoader
     */
    public function getConfigLoader(): ConfigLoader
    {
        return $this->configLoader;
    }

    /**
     * Get the ContentLoader instance
     *
     * @return ContentLoader
     */
    public function getContentLoader(): ContentLoader
    {
        return $this->contentLoader;
    }

    /**
     * Get the PebbleRouter instance
     *
     * @return PebbleRouter
     */
    public function getRouter(): PebbleRouter
    {
        return $this->router;
    }

    private function __clone() {}
    public function __wakeup() {}
}

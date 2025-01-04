<?php

namespace Jemer\PebbleCms;

use Jemer\PebbleCms\ConfigLoader;
use Jemer\PebbleCms\ContentLoader;
use Jemer\PebbleCms\PebbleRouter;
use Jemer\Session\SessionManager;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;

class App
{
    private static ?App $instance = null;
    private PebbleRouter $router;
    private ConfigLoader $configLoader;
    private ContentLoader $contentLoader;
    private Session $session;

    private function __construct()
    {
        // $this->session = new Session(new NativeSessionStorage());
        // $this->session->start();

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

    // public function getSession() : Session
    // {
    //     return $this->session;
    // }


    private function __clone() {}
    public function __wakeup() {}
}

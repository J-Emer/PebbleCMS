<?php

namespace Jemer\PebbleCms;

use Jemer\PebbleCms\Loaders\ConfigLoader;
use Jemer\PebbleCms\Routing\PebbleRouter;

class App
{

    private static $instance = null;
    private ConfigLoader $config;
    private PebbleRouter $router;

    
    private function __construct()
    {
        $this->config = new ConfigLoader(ROOT . "/config.yaml");
        $this->router = new PebbleRouter();
    }

    public function __clone()
    {
        // Prevent cloning
    }

    public function __wakeup()
    {
        // Prevent unserializing
    }

    /**
     * Get the instance of the singleton.
     * 
     * @return App The single instance of the App class
     */
    public static function getInstance(): App
    {
        // Check if the instance already exists
        if (self::$instance === null) {
            // If not, create the instance
            self::$instance = new self();
        }

        // Return the existing or newly created instance
        return self::$instance;
    }

    public function GetConfig(string $key)
    {
        return $this->config->get($key);
    }
    public function Run() : void
    {
        $this->router->Run();
    }

}

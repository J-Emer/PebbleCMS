<?php

namespace Jemer\PebbleCms\Loaders;

use Jemer\PebbleCms\Loggers\ScreenLog;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Filesystem\Filesystem;
use Jemer\PebbleCms\Loggers\ScreenLogger;

class UsersLoader
{
    private $usersDirectory;
    private $filesystem;

    public function __construct()
    {
        $this->usersDirectory = rtrim(USERS_DIR, DIRECTORY_SEPARATOR);
        $this->filesystem = new Filesystem();
    }

    /**
     * Loads a user by their username from the /users directory.
     *
     * @param string $username The username of the user.
     * @return array|null The user data or null if the user does not exist.
     */
    public function loadUserByUsername(string $username)
    {
        $userFilePath = $this->getUserFilePathByUsername($username);
        
        if (!$this->filesystem->exists($userFilePath)) {
            ScreenLog::log(__FILE__, "User file for username {$username} could not be found.");
            return null; // User file does not exist
        }

        $userData = Yaml::parseFile($userFilePath);
        
        return $userData;
    }

    /**
     * Retrieves the file path of the user by their username.
     *
     * @param string $username The username of the user.
     * @return string The path to the YAML file for the user.
     */
    private function getUserFilePathByUsername(string $username) : string
    {
        return $this->usersDirectory . DIRECTORY_SEPARATOR . $username . '.yaml';
    }

    /**
     * Retrieves all users from the /users directory.
     *
     * @return array List of all users.
     */
    public function getAllUsers() : array
    {
        $users = [];

        // Check if the /users directory exists
        if ($this->filesystem->exists($this->usersDirectory)) {
            $files = scandir($this->usersDirectory);
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..' && pathinfo($file, PATHINFO_EXTENSION) === 'yaml') {
                    $username = pathinfo($file, PATHINFO_FILENAME);
                    $userData = $this->loadUserByUsername($username);
                    if ($userData !== null) {
                        $users[$username] = $userData;
                    }
                }
            }
        }

        return $users;
    }
}

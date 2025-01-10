<?php 

namespace Jemer\PebbleCms\Loaders;

use Symfony\Component\Yaml\Yaml;

class UserLoader
{
    private $usersDir;

    public function __construct()
    {
        $this->usersDir = USERS_DIR;
    }

    // Load all users from the directory
    public function loadUsers() : array
    {
        $users = [];
        $files = scandir($this->usersDir);

        // Loop through all files in the directory
        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'yaml') {
                $filePath = $this->usersDir . DIRECTORY_SEPARATOR . $file;

                // Parse YAML file and load user data
                $userData = Yaml::parseFile($filePath);
                if ($userData) {
                    $users[] = $userData;
                }
            }
        }

        return $users;
    }

    // loads a user based on user slug
    public function getUserfromSlug($slug) : array
    {
        $path = $this->usersDir . '/' . $slug . '.yaml';

        if(file_exists($path))
        {
            return Yaml::parseFile($path);
        }

        return null;
    }
}


?>
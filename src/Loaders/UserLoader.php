<?php 

namespace Jemer\PebbleCms\Loaders;

use Symfony\Component\Yaml\Yaml;

class UserLoader
{
    public function LoadUserByUsername(string $userName) : array
    {
        $filePath = USERS_DIR . DIRECTORY_SEPARATOR . $userName . ".yaml";

        if(file_exists($filePath))
        {
            return Yaml::parseFile($filePath);
        }

        return null;
    }
}


?>
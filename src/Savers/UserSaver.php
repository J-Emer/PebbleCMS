<?php 

namespace Jemer\PebbleCms\Savers;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Yaml\Yaml;

class UserSaver
{
    public function SaveUser(array $array) : bool
    {
        $path = USERS_DIR . DIRECTORY_SEPARATOR . $array['username'] . '.yaml';

        $yaml = Yaml::dump($array);

        $filesystem = new Filesystem();

        if(!$filesystem->exists($path))
        {
            $filesystem->dumpFile($path, $yaml);
            return true;
        }

        return false;
    }
}

?>
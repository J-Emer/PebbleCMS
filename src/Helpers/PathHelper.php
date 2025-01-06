<?php 

namespace Jemer\PebbleCms;


class PathHelper
{

    public static function DirectoryName(string $path) : string 
    {
        return pathinfo($path)['dirname'];
    }
    public static function NamewithExtension(string $path) : string 
    {
        return pathinfo($path)['basename'];
    }
    public static function NamewithoutExtension(string $path) : string 
    {
        return pathinfo($path)['filename'];
    }
    public static function Extension(string $path) : string 
    {
        return pathinfo($path)['extension'];
    }    
    public static function BuildPath(array $arr) : string
    {
        $str = "";

        foreach ($arr as $key) 
        {
            $str .= $key . DIRECTORY_SEPARATOR;
        }

        return rtrim($str, DIRECTORY_SEPARATOR);
    }
    public static function GetDirectories(string $dir) : array
    {
        $cache = [];

        $temp = array_diff(scandir($dir), array(".", "..", ".git"));

        foreach ($temp as $dir) 
        {
            if(is_dir($dir))
            {
                array_push($cache, $dir);
            }
        }

        return $cache;
    }
}

?>
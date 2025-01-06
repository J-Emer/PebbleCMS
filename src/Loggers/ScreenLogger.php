<?php 

namespace Jemer\PebbleCms\Loggers;

class ScreenLogger
{
    public static function LogToScreen($file, $data)
    {
        echo "*** Called from: " . basename($file) . "*** <br/>";
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
    }
}


?>
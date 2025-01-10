<?php 

namespace Jemer\PebbleCms\Http;

class PostRequest
{
    public function Get(string $key) : string
    {
        if(isset($_POST[$key]))
        {
            return $_POST[$key];
        }

        return null;
    }

    public function dump()
    {
        if(isset($_POST))
        {
            var_dump($_POST);
        }
    }
}

?>
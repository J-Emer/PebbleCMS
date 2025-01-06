<?php 

$root = dirname(__DIR__, 1);

define("VERSION", "0.0.1");

//---should only be used by the filesystem to quickly locate needed directories---//
define("ROOT_DIR", $root);
define("THEMES_DIR", $root . "/themes");
define("PUBLIC_DIR", $root . "/public");
define("ADMIN_DIR", $root . "/_admin");
define("CACHE_DIR", $root . "/cache");
define("CONTENT_DIR", $root . "/content");
define("PAGES_DIR", $root . "/content/pages");
define("POSTS_DIR", $root . "/content/posts");
define("USERS_DIR", $root . "/users");


?>
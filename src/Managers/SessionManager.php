<?php

namespace Jemer\PebbleCms\Managers;

class SessionManager
{
    // Start the session
    public static function startSession()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Set session data
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    // Get session data
    public static function get($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    // Check if session data exists
    public static function exists($key)
    {
        return isset($_SESSION[$key]);
    }

    // Destroy session data
    public static function destroy($key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    } 

    // Destroy the entire session
    public static function destroySession()
    {
        session_unset();
        session_destroy();
    }

    public static function dump()
    {
        if(isset($_SESSION))
        {
            echo "<pre>";
            var_dump($_SESSION);
            echo "</pre>";
        }
    }
}

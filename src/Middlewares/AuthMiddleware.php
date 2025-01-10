<?php

namespace Jemer\PebbleCms\Middlewares;

use Jemer\PebbleCms\Loaders\UserLoader;
use Jemer\PebbleCms\Managers\SessionManager;

class AuthMiddleware
{
    private string $loginURL; //---url redirect for login

    /**
     * Constructor to initialize the login URL and start the session
     * 
     * @param string $loginURL - The URL to redirect to if the user is not logged in
     */
    public function __construct(string $loginURL)
    {
        $this->loginURL = $loginURL;

        SessionManager::startSession();
    }

    /**
     * Checks if the user is logged in by verifying the session variable 'user_id'.
     * If the user is not logged in, redirects to the login URL.
     * 
     * @return void
     */
    public function check() : void
    {
        if (!SessionManager::exists('username')) {
            header('Location:' . $this->loginURL);
            exit;
        }
    }

    /**
     * Logs the user out by destroying the session and redirecting to the login URL
     * 
     * @return void
     */
    public function logout() : void
    {
        SessionManager::destroySession();
        header('Location:' . $this->loginURL);
        exit;
    }

    /**
     * Authenticates the user by checking the username and password.
     * If successful, stores session data and redirects to the success URL.
     * If authentication fails, redirects to the login URL.
     * 
     * @param string $userName - The username provided by the user
     * @param string $password - The password provided by the user
     * @param string $success - The URL to redirect to if authentication is successful
     * 
     * @return void
     */
    public function authenticate(string $userName, string $password, string $success) 
    {
        $userManger = new UserLoader();
        $users = $userManger->loadUsers();

        // Loop through users and check for a match
        foreach ($users as $user) {
            
            if ($user['username'] === $userName && password_verify($password, $user['password'])) 
            {

                foreach ($user as $key => $value) 
                {
                    //echo "setting: " . $key . " | " . $value . "<br/>";
                    SessionManager::set($key, $value);
                }

                header('Location:' . $success);
                exit;
            }
            
        }

        header('Location:' . $this->loginURL);
        exit;
    }
}

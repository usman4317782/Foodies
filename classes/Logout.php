<?php

class Logout
{
    public function __construct()
    {
        $this->logout();
    }

    private function logout()
    {
        // Start the session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Unset all session variables
        $_SESSION = array();

        // Destroy the session
        session_destroy();

        // Redirect to the login page
        header("Location: login.php");
        exit();
    }
}


?>

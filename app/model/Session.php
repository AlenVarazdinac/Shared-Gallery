<?php

class Session
{
    private static $instance;

    private function __construct(){
        session_start();
    }

    // Logs user in
    public function login(){
        $_SESSION['is_logged_in'] = true;
    }

    // Logs user out
    public function logout(){
        $_SESSION['is_logged_in'] = false;
    }

    // Checks if user is logged in
    public function isLoggedIn(){
        // Check if 'is_logged_in' session variable is set
        $isLoggedIn = isset($_SESSION['is_logged_in']) ? true : false;
        return $isLoggedIn;
    }

    public static function getInstance(){
        if(is_null(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }
}
<?php

class Session
{
    private static $instance;

    private function __construct(){
        session_start();
    }

    // Logs user in
    public function login($data){
        $_SESSION['is_logged_in'] = true;
        $_SESSION['user'] = $data;
    }

    // Gets user's data
    public function getData(){
        $data = isset($_SESSION['user']) ? $data = $_SESSION['user'] : '';
        return $data;
    }

    // Logs user out
    public function logout(){
        unset($_SESSION['is_logged_in']);
        unset($_SESSION['user']);
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
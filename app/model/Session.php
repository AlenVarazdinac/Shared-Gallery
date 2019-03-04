<?php

class Session
{
    private static $instance;

    private function __construct(){
        session_start();
    }

    // Logs user in
    public function login($data){
        $_SESSION['username'] = $data['username'];
        $_SESSION['email'] = $data['email'];
        header('Location: ' . App::config('url') . 'account');
    }

    // Logs user out
    public function logout(){

    }

    // Checks if user is logged in
    public function isLoggedIn(){

    }

    public static function getInstance(){
        if(is_null(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }
}
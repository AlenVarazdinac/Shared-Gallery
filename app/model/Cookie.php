<?php

class Cookie
{
    private static $instance;

    // Logs user in
    public function rememberMe($data){
        $key = session_id();
        $time = time() + (10 * 365 * 24 * 60 * 60);

        $data['rememberMe'] = $key;
        setcookie("remember_me", json_encode($data), $time, '/');
    }

    // Gets user's data
    public function rememberMeData(){
        if($this->isRememberMeSet()){
            $data = json_decode($_COOKIE['remember_me'], true);
            unset($data['rememberMe']);
            Session::getInstance()->login($data);
        }else{
            $data = '';
        }
        return $data;
    }

    // Checks if user is logged in
    public function isRememberMeSet(){
        // Check if 'remember_me' session variable is set
        $rememberMe = isset($_COOKIE['remember_me']) ? true : false;
        return $rememberMe;
    }

    // Destroy cookies
    public function logout(){
        unset($_COOKIE['remember_me']);
        setcookie('remember_me', null, -1, '/');
    }

    // Get cookie instance
    public static function getInstance(){
        if(is_null(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }
}
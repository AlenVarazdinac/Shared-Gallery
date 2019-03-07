<?php

class Cookie
{
    private static $instance;

    // Logs user in
    public function rememberMe($data){
        // Create a random string for remember me key
        $string = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $rememberMeKey = substr(str_shuffle(($string)), 1, 10);
        // Store rememberMeKey in data array
        $data['rememberMe'] = $rememberMeKey;

        // Connect to database
        $connection = App::connect();
        // Update rememberMeKey for current user
        $sql = 'UPDATE users SET remember_me=:remember_me WHERE id=:id';
        $stmt = $connection->prepare($sql);
        $stmt->bindParam('remember_me', $data['rememberMe']);
        $stmt->bindParam('id', $data['id']);
        $stmt->execute();

        $time = time() + (10 * 365 * 24 * 60 * 60);
        setcookie("remember_me", json_encode($data), $time, '/');
    }

    // Gets user's data
    public function rememberMeData(){
        if($this->isRememberMeSet()){
            $data = json_decode($_COOKIE['remember_me'], true);
            // Connect to database
            $connection = App::connect();
            // Update rememberMeKey for current user
            $sql = 'SELECT * FROM users WHERE id=:id AND remember_me=:remember_me';
            $stmt = $connection->prepare($sql);
            $stmt->bindParam('id', $data['id']);
            $stmt->bindParam('remember_me', $data['rememberMe']);
            $stmt->execute();

            $userData = $stmt->fetch(PDO::FETCH_ASSOC);

            // If Cookie and DB Remember me keys match then login
            if($userData['remember_me'] === $data['rememberMe']){
                // Pass id, username, email
                unset($userData['password']);
                Session::getInstance()->login($userData);
            }

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
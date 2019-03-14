<?php

class UserController
{
    // Display login form
    public function login(){
        $view = new View();
        $view->render('user/login');
    }

    public function authorization(){
        $data = $this->_validateLogin($_POST);

        // Connect to database
        $connection = App::connect();

        $sql = 'SELECT * FROM users WHERE email=:email';
        $stmt = $connection->prepare($sql);
        $stmt->bindParam('email', $data['email']);
        $stmt->execute();

        // Store user from db
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify submitted and db passwords
        if(password_verify($data['password'], $user['password'])){
            $userData = [
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email']
            ];
            Session::getInstance()->login($userData);

            // Remember me cookie
            if($_POST['rememberMe'] == 'true'){
                // Set cookie
                Cookie::getInstance()->rememberMe($userData);
            }
            header('Location: ' . App::config('url') . 'gallery');
        }else{
            header('Location: ' . App::config('url') . 'user/login?tryagain');
        }
    }

    public function logout(){
        Session::getInstance()->logout();
        Cookie::getInstance()->logout();
        header('Location: ' . App::config('url'));
    }

    // Display register form
    public function register(){
        $view = new View();
        $view->render('user/register');
    }

    // Register user
    public function registration(){
        // Validate $_POST data
        $data = $this->_validateRegistration($_POST);

        // If validate data is wrong redirect back to register page
        if($data === false){
            header('Location: ' . App::config('url') . 'user/register?tryagain');
        }else{
            // Connect to database
            $connection = App::connect();

            $sql = 'INSERT INTO users (username, email, password)
            VALUES (:username, :email, :password)';

            $stmt = $connection->prepare($sql);
            $stmt->bindParam('username', $data['username']);
            $stmt->bindParam('email', $data['email']);
            $stmt->bindParam('password', password_hash($data['password'], PASSWORD_ARGON2I));
            $stmt->execute();

            // If successfully registered, redirect user to login page
            header('Location: ' . App::config('url'). 'user/login?succreg');
        }

    }

    /**
     * Validate login
     * @param $data
     * @return array|bool
     */
    public function _validateLogin($data){
        $required = ['email', 'password'];

        $data = array_diff_key($data, $required);

        // Validate required keys
        foreach($required as $key){
            if(!isset($data[$key])) {
                return false;
            }

            // Trim whitespaces then check if empty
            $data[$key] = trim((string)$data[$key]);
            if(empty($data[$key])){
                return false;
            }

            $data[$key] = htmlspecialchars($data[$key], ENT_QUOTES);
        }

        // Check if email is valid
        if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
            return false;
        }

        return $data;
    }


    /**
     * Validate registration
     * @param $data
     * @return array|bool
     */
    public function _validateRegistration($data){
        $required = ['username', 'email', 'password', 'confirmPassword'];

        $data = array_diff_key($data, $required);

        // Validate required keys
        foreach($required as $key){
            if(!isset($data[$key])) {
                return false;
            }

            // Trim whitespaces then check if empty
            $data[$key] = trim((string)$data[$key]);
            if(empty($data[$key])){
                return false;
            }

            $data[$key] = htmlspecialchars($data[$key], ENT_QUOTES);
        }

        // Check if email is valid
        if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
            return false;
        }

        // Check if passwords match
        if($data['password'] !== $data['confirmPassword']){
            return false;
        }

        return $data;
    }

}
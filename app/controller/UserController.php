<?php

class UserController
{
    // Display login form
    public function login(){
        $view = new View();
        $view->render('user/login');
    }

    // Display register form
    public function register(){
        $view = new View();
        $view->render('user/register');
    }

    // Register user
    public function registration(){
        $connection = App::connect();

        $sql = 'INSERT INTO users (username, email, password)
        VALUES (:username, :email, :password)';

        $stmt = $connection->prepare($sql);
        $stmt->bindParam('username', $_POST['username']);
        $stmt->bindParam('email', $_POST['email']);
        $stmt->bindParam('password', $_POST['password']);
        $stmt->execute();

        header('Location: ' . App::config('url'). 'user/login?succreg');
    }
}
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
        print_r($_POST);
    }
}
<?php

class UserController
{
    public function login(){
        $view = new View();
        $view->render('user/login');
    }

    public function register(){
        $view = new View();
        $view->render('user/register');
    }
}
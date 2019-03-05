<?php

class AccountController
{
    // Display login form
    public function index(){
        if(!Session::getInstance()->isLoggedIn()){
            header('Location: ' . App::config('url') . 'user/login?loginpls');
        }else{
            $view = new View();
            $view->render('user/login');
        }
    }

    // Display user's account edit options
    public function edit(){

    }


}
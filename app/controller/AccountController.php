<?php

class AccountController
{
    // Display login form
    public function index(){
        if(!Session::getInstance()->isLoggedIn()){
            echo "User is not logged in";
        }else{
            echo "User is logged in";
        }
        // $view = new View();
        // $view->render('user/login');
    }


}
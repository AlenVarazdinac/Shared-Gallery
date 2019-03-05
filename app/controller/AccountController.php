<?php

class AccountController
{
    // Display login form
    public function index(){
        if(!Session::getInstance()->isLoggedIn()){
            header('Location: ' . App::config('url') . 'user/login?loginpls');
        }else{
            $view = new View();
            $view->render('account/index');
        }
    }

    // Display user's account edit options
    public function edit(){

    }

    // Delete user's account
    public function delete(){
        if(!Session::getInstance()->isLoggedIn() && Session::getInstance()->getData() === ''){
            header('Location: ' . App::config('url') . 'user/login?loginpls');
        }else{
            // Get user's data from Session
            $user = Session::getInstance()->getData();

            // Connect to database
            $connection = App::connect();

            $sql = 'DELETE FROM users WHERE id=:id AND email=:email';
            $stmt = $connection->prepare($sql);
            $stmt->bindParam('id', $user['id']);
            $stmt->bindParam('email', $user['email']);
            $stmt->execute();

            // Unset session
            Session::getInstance()->logout();

            // Redirect to home page
            header('Location: ' . App::config('url') . '?accdeleted');
        }
    }


}
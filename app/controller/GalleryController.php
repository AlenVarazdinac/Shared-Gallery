<?php

class GalleryController
{
    public function index(){
        if(!Session::getInstance()->isLoggedIn()){
            header('Location: ' . App::config('url') . 'user/login?loginpls');
        }else{
            $view = new View();
            $view->render('gallery/index');
        }
    }
}
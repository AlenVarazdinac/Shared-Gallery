<?php

final class App
{
    private static $instances = [];

    // Resolves and dispatch controller/action
    public static function start(){
        $pathInfo = Request::pathInfo();

        $pathInfo = trim($pathInfo, '/');
        $pathParts = explode('/', $pathInfo);

        // Resolve controller
        if(!isset($pathParts[0]) || empty($pathParts[0])){
            $controller = 'Index';
        }else{
            $controller = ucfirst(strtolower($pathParts[0]));
        }

        $controller .= 'Controller';

        // Resolve action
        if(!isset($pathParts[1]) || empty($pathParts[1])){
            $action = 'index';
        }else{
            $action = strtolower($pathParts[1]);
        }

        // Dispatch
        if(class_exists($controller) && method_exists($controller, $action)){
            $controllerInstance = new $controller();
            $controllerInstance->$action();
        }else{
            header("HTTP/1.0 404 Not Found");
        }
    }

    /**
     * Loads app config
     * @return mixed
     */
    public static function config($key){
        $config = include BASEPATH . 'app/config.php';
        return $config[$key];
    }
}
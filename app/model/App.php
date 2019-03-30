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

        if(isset($pathParts[2]) || empty($pathParts[2])){
            unset($pathParts[0]);
            unset($pathParts[1]);
            $data = array_values($pathParts);
        }else{
            $data = '';
        }

        // Dispatch
        if(class_exists($controller) && method_exists($controller, $action)){
            $controllerInstance = new $controller();
            $controllerInstance->$action($data);
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

    /**
     * Database connection
     * @return PDO|bool
     */
    // public static function connect(){
    //     $dbName = App::config('db_name');
    //     $dbUser = App::config('db_user');
    //     $dbPassword = App::config('db_password');

    //     $dsn = "mysql:host=localhost;dbname=$dbName;charset=utf8";

    //     try{
    //         $conn = new PDO($dsn, $dbUser, $dbPassword);
    //     }catch(PDOException $e){
    //         return false;
    //     }

    //     return $conn;
    // }
}
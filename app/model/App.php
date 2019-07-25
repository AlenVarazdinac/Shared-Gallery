<?php

/**
 * Application main class
 */
final class App
{
    private static $_instances = [];

    /**
     * Resolves and dispatch controller/action
     *
     * @return void
     */
    public static function start()
    {
        $pathInfo = Request::pathInfo();

        $pathInfo = trim($pathInfo, '/');
        $pathParts = explode('/', $pathInfo);

        // Resolve controller
        if (!isset($pathParts[0]) || empty($pathParts[0])) {
            $controller = 'Index';
        } else {
            $controller = ucfirst(strtolower($pathParts[0]));
        }

        $controller .= 'Controller';

        // Resolve action
        if (!isset($pathParts[1]) || empty($pathParts[1])) {
            $action = 'index';
        } else {
            $action = strtolower($pathParts[1]);
        }

        if (isset($pathParts[2]) || empty($pathParts[2])) {
            unset($pathParts[0]);
            unset($pathParts[1]);
            $data = array_values($pathParts);
        } else {
            $data = '';
        }

        // Dispatch
        if (class_exists($controller) && method_exists($controller, $action)) {
            $controllerInstance = new $controller();
            $controllerInstance->$action($data);
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }

    /**
     * Loads app config
     *
     * @param string $key get value from config.php
     *
     * @return mixed
     */
    public static function config($key)
    {
        $config = include BASEPATH . 'app/config.php';
        return $config[$key];
    }

}
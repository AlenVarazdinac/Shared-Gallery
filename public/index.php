<?php

// Define application base path
define('BASEPATH', dirname(__DIR__) . '/');

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set include path, this is where included classes will be found
set_include_path(implode(PATH_SEPARATOR, array(
    BASEPATH . 'app/model',
    BASEPATH . 'app/controller'
)));

// Register autoloader to autoinclude classes when needed
spl_autoload_register(function($class){
    $classPath = strtr($class, '\\', DIRECTORY_SEPARATOR) . '.php';
    return include $classPath;
});

// Create config file from config.example file
if(!file_exists(BASEPATH . 'app/config.php')){
    copy(BASEPATH . 'app/config.example.php', BASEPATH . 'app/config.php');
}

// Login user automatically if 'Remember me' is set
Cookie::getInstance()->rememberMeData();

// Start app
App::start();

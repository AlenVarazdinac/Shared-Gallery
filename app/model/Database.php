<?php

class Database extends PDO
{
    static private $instance = array();
    public static $dbConfig = array();

    public static function setDbConfig(Config $config){
        self::$dbConfig = [
            'host' => $config->host,
            'db_name' => $config->dbName,
            'db_user' => $config->dbUser,
            'db_password' => $config->dbPw
        ];
    }

    public static function getInstance(){
        if(!is_null(self::$instance)){
            self::setDbConfig(new Config);
            $dsn = 'mysql:host='.self::$dbConfig['host'].';dbname='.self::$dbConfig['db_name'].';charset=utf8';
            self::$instance = new PDO($dsn, self::$dbConfig['db_user'], self::$dbConfig['db_password']);
        }
        return self::$instance;
    }

}
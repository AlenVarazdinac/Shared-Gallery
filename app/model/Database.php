<?php

class Database extends PDO
{
    static private $instance = array();
    public static $dbConfig = array();

    public static function setDbConfig(Config $config){
        self::$dbConfig = [
            'host' => $config->getHost(),
            'db_name' => $config->getDbName(),
            'db_user' => $config->getDbUser(),
            'db_password' => $config->getDbPw()
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
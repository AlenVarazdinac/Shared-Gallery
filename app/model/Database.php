<?php

class Database extends PDO
{
    static private $_instance = array();
    static private $dbConfig = array();

    /**
     * Database connection
     * @return PDO|bool
     */
    protected static function connect(){
        self::$dbConfig = [
            'host' => App::config('host'),
            'db_name' => App::config('db_name'),
            'db_user' => App::config('db_user'),
            'db_password' => App::config('db_password')
        ];

        $dsn = 'mysql:host='.self::$dbConfig['host'].';dbname='.self::$dbConfig['db_name'].';charset=utf8';

        try{
            $conn = new PDO($dsn, self::$dbConfig['db_user'], self::$dbConfig['db_password']);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return false;
        }

        return $conn;
    }

}
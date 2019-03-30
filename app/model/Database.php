<?php

class Database extends PDO
{
    static private $_instance = array();
    private $dbConfig = array();

    function __construct(){
        $config = new Config();

        $this->dbConfig = [
            'host' => $config->getHost(),
            'db_name' => $config->getDbName(),
            'db_user' => $config->getDbUser(),
            'db_password' => $config->getDbPw()
        ];

    }

    /**
     * Database connection
     * @return PDO|bool
     */
    protected function connect(){
        $dsn = 'mysql:host='.$this->dbConfig['host'].';dbname='.$this->dbConfig['db_name'].';charset=utf8';

        try{
            $conn = new PDO($dsn, $this->dbConfig['db_user'], $this->dbConfig['db_password']);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return false;
        }

        return $conn;
    }

}
<?php

class Database extends PDO
{
    static private $_instance = array();

    public function __construct($config){
        if(!isset($config['host'])){
            $config['host'] = 'localhost';
        }
        $dsn = 'mysql:host='.$config['host'].';dbname='.$config['name'].';charset=utf8';

        parent::__construct($dsn, $config['user'], $config['password']);
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    public static function connect($config, $name = 'db'){
        if(!isset(self::$_instance[$name])){
            self::$_instance[$name] = new self($config);
        }

        return self::$_instance[$name];
    }

    public function queryPrepared($sql, $bind){
        $stmt = $this->prepare($sql);
        $stmt->execute($bind);
        return $stmt;
    }
}
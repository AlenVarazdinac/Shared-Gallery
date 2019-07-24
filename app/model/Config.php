<?php

class Config {

    private $url;
    private $mode;
    private $host;
    private $dbName;
    private $dbUser;
    private $dbPw;
    private static $instance;

    function __construct(){
        $this->url = App::config('url');
        $this->mode = App::config('mode');
        $this->host = App::config('host');
        $this->dbName = App::config('db_name');
        $this->dbUser = App::config('db_user');
        $this->dbPw = App::config('db_password');
    }

    public function __get($propertyName){
        return $this->$propertyName;
    }

    public function __set($propertyName, $propertyValue){
        $this->$propertyName = $propertyValue;
    }

    public static function getInstance(){
        if(is_null(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }
}
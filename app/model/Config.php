<?php

class Config {

    private $url;
    private $mode;
    private $host;
    private $dbName;
    private $dbUser;
    private $dbPw;

    function __construct(){
        $this->setUrl();
        $this->setMode();
        $this->setHost();
        $this->setDbName();
        $this->setDbUser();
        $this->setDbPw();
    }

    public function getUrl(){
        return $this->url;
    }

    public function setUrl($url = ''){
        $this->url = empty($url) ? App::config('url') : $url;
    }

    public function getMode(){
        return $this->mode;
    }

    public function setMode($mode = ''){
        $this->mode = empty($mode) ? App::config('mode') : $mode;
    }

    public function getHost(){
        return $this->host;
    }

    public function setHost($host = ''){
        $this->host = empty($host) ? App::config('host') : $host;
    }

    public function getDbName(){
        return $this->dbName;
    }

    public function setDbName($dbName = ''){
        $this->dbName = empty($dbName) ? App::config('db_name') : $dbName;
    }

    public function getDbUser(){
        return $this->dbUser;
    }

    public function setDbUser($dbUser = ''){
        $this->dbUser = empty($dbUser) ? App::config('db_user') : $dbUser;
    }

    public function getDbPw(){
        return $this->dbPw;
    }

    public function setDbPw($dbPw = ''){
        $this->dbPw = empty($dbPw) ? App::config('db_password') : $dbPw;
    }
}
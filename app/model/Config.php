<?php

/**
 * Configuration class
 */
class Config
{

    private $_url;
    private $_mode;
    private $_host;
    private $_dbName;
    private $_dbUser;
    private $_dbPw;
    private static $_instance;

    /**
     * Config constructor, set default values
     */
    function __construct()
    {
        $this->_url = App::config('url');
        $this->_mode = App::config('mode');
        $this->_host = App::config('host');
        $this->_dbName = App::config('db_name');
        $this->_dbUser = App::config('db_user');
        $this->_dbPw = App::config('db_password');
    }


    /**
     * Config magic getter
     *
     * @param mixed $propertyName property to get
     *
     * @return mixed
     */
    public function __get($propertyName)
    {
        return $this->$propertyName;
    }

    /**
     * Config magic setter
     *
     * @param mixed $propertyName  property to change
     * @param mixed $propertyValue value to change property to
     *
     * @return $this->$propertyName
     */
    public function __set($propertyName, $propertyValue)
    {
        $this->$propertyName = $propertyValue;
    }

    /**
     * Config singleton
     *
     * @return Config
     */
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
}
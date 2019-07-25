<?php

/**
 * Database class
 */
class Database extends PDO
{
    static private $_instance = array();
    public static $dbConfig = array();

    /**
     * Set database configuration
     *
     * @param Config $config inject Config
     *
     * @return void
     */
    public static function setDbConfig(Config $config)
    {
        self::$dbConfig = [
            'host' => $config->_host,
            'db_name' => $config->_dbName,
            'db_user' => $config->_dbUser,
            'db_password' => $config->_dbPw
        ];
    }

    /**
     * Database singleton
     *
     * @return Database
     */
    public static function getInstance()
    {
        if (!is_null(self::$_instance)) {
            self::setDbConfig(new Config);

            $dsn = 'mysql:host='.self::$dbConfig['host'].';dbname='
            .self::$dbConfig['db_name'].';charset=utf8';

            self::$_instance = new PDO(
                $dsn, self::$dbConfig['db_user'], self::$dbConfig['db_password']
            );
        }
        return self::$_instance;
    }

}
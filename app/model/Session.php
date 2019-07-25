<?php

/**
 * Deals with session stuff
 */
class Session
{
    private static $_instance;

    /**
     * Start session
     */
    private function __construct()
    {
        session_start();
    }

    /**
     * Logs user in
     *
     * @param mixed $data Users data
     *
     * @return mixed
     */
    public function login($data)
    {
        $_SESSION['is_logged_in'] = true;
        $_SESSION['user'] = $data;
    }

    /**
     * Gets user's data
     *
     * @return mixed
     */
    public function getData()
    {
        $data = isset($_SESSION['user']) ? $data = $_SESSION['user'] : '';
        return $data;
    }

    /**
     * Logs user out
     *
     * @return void
     */
    public function logout()
    {
        unset($_SESSION['is_logged_in']);
        unset($_SESSION['user']);
    }

    /**
     * Checks if user is logged in
     *
     * @return boolean
     */
    public function isLoggedIn()
    {
        // Check if 'is_logged_in' session variable is set
        $isLoggedIn = isset($_SESSION['is_logged_in']) ? true : false;
        return $isLoggedIn;
    }

    /**
     * Session singleton
     *
     * @return Session
     */
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
}
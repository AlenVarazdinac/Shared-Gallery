<?php

/**
 * Handles everything request related
 */
class Request
{
    /**
     * Resolves path info from $_SERVER to use with mod rewrite
     *
     * @return string
     */
    public static function pathInfo()
    {
        if (isset($_SERVER['PATH_INFO'])) {
            return $_SERVER['PATH_INFO'];
        } elseif (isset($_SERVER['REDIRECT_PATH_INFO'])) {
            return $_SERVER['REDIRECT_PATH_INFO'];
        } else {
            return '';
        }
    }

    /**
     * Deals with GET requests
     *
     * @param string $key     Get key
     * @param mixed  $default default value
     *
     * @return mixed
     */
    public static function get($key, $default='')
    {
        return isset($_GET[$key]) ? $_GET[$key] : $default;
    }

    /**
     * Deals with POST requests
     *
     * @param string $key     POST key
     * @param mixed  $default default value
     *
     * @return mixed
     */
    public static function post($key, $default='')
    {
        return isset($_POST[$key]) ? $_POST[$key] : $default;
    }

    /**
     * Deals with FILES requests
     *
     * @param string $key     FILES key
     * @param mixed  $default default value
     *
     * @return mixed
     */
    public static function files($key, $default='')
    {
        return isset($_FILES[$key]) ? $_FILES[$key] : $default;
    }
}
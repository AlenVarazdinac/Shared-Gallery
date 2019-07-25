<?php

/**
 * Cookie class
 */
class Cookie
{
    private static $_instance;

    /**
     * Logs user in
     *
     * @param array $data User's data
     *
     * @return void
     */
    public function rememberMe($data)
    {
        $key = session_id();
        $time = time() + (10 * 365 * 24 * 60 * 60);

        $data['rememberMe'] = $key;
        setcookie("remember_me", json_encode($data), $time, '/');
    }

    /**
     * Gets user data
     *
     * @return array $data
     */
    public function rememberMeData()
    {
        if ($this->isRememberMeSet()) {
            $data = json_decode($_COOKIE['remember_me'], true);
            unset($data['rememberMe']);
            Session::getInstance()->login($data);
        } else {
            $data = '';
        }
        return $data;
    }

    /**
     * Checks if user is logged in
     *
     * @return $rememberMe
     */
    public function isRememberMeSet()
    {
        // Check if 'remember_me' session variable is set
        $rememberMe = isset($_COOKIE['remember_me']) ? true : false;
        return $rememberMe;
    }

    /**
     * Destroy cookies
     *
     * @return void
     */
    public function logout()
    {
        unset($_COOKIE['remember_me']);
        setcookie('remember_me', null, -1, '/');
    }

    /**
     * Cookie singleton
     *
     * @return Cookie
     */
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
}
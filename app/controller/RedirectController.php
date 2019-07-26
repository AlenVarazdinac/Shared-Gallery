<?php

/**
 * Redirect controller
 */
class RedirectController
{
    /**
     * Redirect to URL
     *
     * @param string $url url to redirect to
     *
     * @return void
     */
    public static function redirectTo($url = '')
    {
        $headerLink = Config::getInstance()->_url;

        if (!empty($url)) {
            $headerLink .= $url;
        }

        header('Location: ' . $headerLink);
    }
}
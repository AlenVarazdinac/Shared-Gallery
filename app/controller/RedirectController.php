<?php

class RedirectController
{
    public static function redirectTo($url = ''){
        $headerLink = Config::getInstance()->url;

        if(!empty($url)){
            $headerLink .= $url;
        }

        header('Location: ' . $headerLink);
    }
}
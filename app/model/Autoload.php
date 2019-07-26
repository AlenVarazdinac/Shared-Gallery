<?php

/**
 * Autoloader
 */
class Autoload
{
    /**
     * Autoloader constructor
     */
    public function __construct()
    {
        spl_autoload_register(array($this, 'loader'));
    }

    /**
     * Load necesarry classes
     *
     * @param string $className Class to load
     *
     * @return string
     */
    public static function loader($className)
    {
        $classPath = strtr($className, '\\', DIRECTORY_SEPARATOR) . '.php';
        include $classPath;
    }
}
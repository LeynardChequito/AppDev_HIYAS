<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitdc3eb7cff443e2ec7faec9e54b0bcf18
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInitdc3eb7cff443e2ec7faec9e54b0bcf18', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitdc3eb7cff443e2ec7faec9e54b0bcf18', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitdc3eb7cff443e2ec7faec9e54b0bcf18::getInitializer($loader));

        $loader->register(true);

        $includeFiles = \Composer\Autoload\ComposerStaticInitdc3eb7cff443e2ec7faec9e54b0bcf18::$files;
        foreach ($includeFiles as $fileIdentifier => $file) {
            composerRequiredc3eb7cff443e2ec7faec9e54b0bcf18($fileIdentifier, $file);
        }

        return $loader;
    }
}

/**
 * @param string $fileIdentifier
 * @param string $file
 * @return void
 */
function composerRequiredc3eb7cff443e2ec7faec9e54b0bcf18($fileIdentifier, $file)
{
    if (empty($GLOBALS['__composer_autoload_files'][$fileIdentifier])) {
        $GLOBALS['__composer_autoload_files'][$fileIdentifier] = true;

        require $file;
    }
}

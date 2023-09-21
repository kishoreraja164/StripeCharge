<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitb56477e472eb57449826b630fa9091ec
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

        spl_autoload_register(array('ComposerAutoloaderInitb56477e472eb57449826b630fa9091ec', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitb56477e472eb57449826b630fa9091ec', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitb56477e472eb57449826b630fa9091ec::getInitializer($loader));

        $loader->register(true);

        $filesToLoad = \Composer\Autoload\ComposerStaticInitb56477e472eb57449826b630fa9091ec::$files;
        $requireFile = \Closure::bind(static function ($fileIdentifier, $file) {
            if (empty($GLOBALS['__composer_autoload_files'][$fileIdentifier])) {
                $GLOBALS['__composer_autoload_files'][$fileIdentifier] = true;

                require $file;
            }
        }, null, null);
        foreach ($filesToLoad as $fileIdentifier => $file) {
            $requireFile($fileIdentifier, $file);
        }

        return $loader;
    }
}

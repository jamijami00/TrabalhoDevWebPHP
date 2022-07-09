<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit05d6cc4b6ee682b45776c63af17d2470
{
    public static $files = array (
        'da253f61703e9c22a5a34f228526f05a' => __DIR__ . '/..' . '/wixel/gump/gump.class.php',
        'aafd65e732fda5822d5db479193584b4' => __DIR__ . '/../..' . '/App/Core/Config.php',
    );

    public static $prefixLengthsPsr4 = array (
        'G' => 
        array (
            'GUMP\\' => 5,
        ),
        'C' => 
        array (
            'CoffeeCode\\Router\\' => 18,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'GUMP\\' => 
        array (
            0 => __DIR__ . '/..' . '/wixel/gump/src',
        ),
        'CoffeeCode\\Router\\' => 
        array (
            0 => __DIR__ . '/..' . '/coffeecode/router/src',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit05d6cc4b6ee682b45776c63af17d2470::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit05d6cc4b6ee682b45776c63af17d2470::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit05d6cc4b6ee682b45776c63af17d2470::$classMap;

        }, null, ClassLoader::class);
    }
}

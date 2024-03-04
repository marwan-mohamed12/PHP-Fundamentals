<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb52c0f0227402bd744084c0ce6f01beb
{
    public static $files = array (
        '19118e67f7e211df41cff29d3d4d8af4' => __DIR__ . '/../..' . '/config.php',
    );

    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb52c0f0227402bd744084c0ce6f01beb::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb52c0f0227402bd744084c0ce6f01beb::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb52c0f0227402bd744084c0ce6f01beb::$classMap;

        }, null, ClassLoader::class);
    }
}

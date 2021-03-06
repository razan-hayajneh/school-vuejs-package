<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbfcb53e1b258473d2c617b5adfdaca6f
{
    public static $prefixLengthsPsr4 = array (
        'V' => 
        array (
            'VueSystem\\School\\' => 17,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'VueSystem\\School\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitbfcb53e1b258473d2c617b5adfdaca6f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbfcb53e1b258473d2c617b5adfdaca6f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitbfcb53e1b258473d2c617b5adfdaca6f::$classMap;

        }, null, ClassLoader::class);
    }
}

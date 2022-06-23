<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit64e823c17b820b3b7039ebc2c6ae39eb
{
    public static $prefixLengthsPsr4 = array (
        'D' => 
        array (
            'Dsmr\\Authy\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Dsmr\\Authy\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit64e823c17b820b3b7039ebc2c6ae39eb::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit64e823c17b820b3b7039ebc2c6ae39eb::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit64e823c17b820b3b7039ebc2c6ae39eb::$classMap;

        }, null, ClassLoader::class);
    }
}

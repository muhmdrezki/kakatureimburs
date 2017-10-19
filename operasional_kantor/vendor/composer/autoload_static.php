<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5e0fda8cff0e83d37e7e63959fb6aa90
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'E' => 
        array (
            'ElephantIO\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'ElephantIO\\' => 
        array (
            0 => __DIR__ . '/..' . '/wisembly/elephant.io/src',
            1 => __DIR__ . '/..' . '/wisembly/elephant.io/test',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5e0fda8cff0e83d37e7e63959fb6aa90::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5e0fda8cff0e83d37e7e63959fb6aa90::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}

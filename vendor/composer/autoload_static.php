<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd294646d29c7f1e72e2edd0401201556
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Core\\' => 5,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Core',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd294646d29c7f1e72e2edd0401201556::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd294646d29c7f1e72e2edd0401201556::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}

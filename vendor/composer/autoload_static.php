<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit18fa18ef30414b7901857abb059265dd
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit18fa18ef30414b7901857abb059265dd::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit18fa18ef30414b7901857abb059265dd::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}

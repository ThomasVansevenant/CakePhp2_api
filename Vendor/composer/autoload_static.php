<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit89e162c0d3ccde21b82c7ce4a084fd9e
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Composer\\Installers\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Composer\\Installers\\' => 
        array (
            0 => __DIR__ . '/..' . '/composer/installers/src/Composer/Installers',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit89e162c0d3ccde21b82c7ce4a084fd9e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit89e162c0d3ccde21b82c7ce4a084fd9e::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}

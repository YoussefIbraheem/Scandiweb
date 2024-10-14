<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitad2f9e80c4e7dbddfd38bbaec2791e2e
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
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitad2f9e80c4e7dbddfd38bbaec2791e2e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitad2f9e80c4e7dbddfd38bbaec2791e2e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitad2f9e80c4e7dbddfd38bbaec2791e2e::$classMap;

        }, null, ClassLoader::class);
    }
}

<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb3052acbba104148c49e0a1963b4704f
{
    public static $prefixLengthsPsr4 = array (
        'n' => 
        array (
            'nimbus\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'nimbus\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'nimbus\\App' => __DIR__ . '/../..' . '/src/App.php',
        'nimbus\\Controller\\Index' => __DIR__ . '/../..' . '/src/Controller/Index.php',
        'nimbus\\Test' => __DIR__ . '/../..' . '/src/Test.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb3052acbba104148c49e0a1963b4704f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb3052acbba104148c49e0a1963b4704f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb3052acbba104148c49e0a1963b4704f::$classMap;

        }, null, ClassLoader::class);
    }
}

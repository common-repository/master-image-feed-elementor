<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd909482c0a0feab1935a938a9603a165
{
    public static $files = array (
        'd0c2a0b24a75268f09454279d248eaf4' => __DIR__ . '/../..' . '/Inc/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'J' => 
        array (
            'JLTELIMF\\Libs\\License\\' => 22,
            'JLTELIMF\\Libs\\' => 14,
            'JLTELIMF\\Inc\\Admin\\' => 19,
            'JLTELIMF\\Inc\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'JLTELIMF\\Libs\\License\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Libs/License',
        ),
        'JLTELIMF\\Libs\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Libs',
        ),
        'JLTELIMF\\Inc\\Admin\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Inc/Admin',
        ),
        'JLTELIMF\\Inc\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Inc',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd909482c0a0feab1935a938a9603a165::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd909482c0a0feab1935a938a9603a165::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd909482c0a0feab1935a938a9603a165::$classMap;

        }, null, ClassLoader::class);
    }
}
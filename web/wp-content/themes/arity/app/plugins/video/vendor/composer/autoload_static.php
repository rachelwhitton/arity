<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc6c729a8d9cb3a5413e02aff8c3ed896
{
    public static $prefixLengthsPsr4 = array (
        'V' => 
        array (
            'Video\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Video\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Video',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc6c729a8d9cb3a5413e02aff8c3ed896::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc6c729a8d9cb3a5413e02aff8c3ed896::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
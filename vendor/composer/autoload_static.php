<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit388761f653cf893411b23d0c3970a324
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit388761f653cf893411b23d0c3970a324::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit388761f653cf893411b23d0c3970a324::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit388761f653cf893411b23d0c3970a324::$classMap;

        }, null, ClassLoader::class);
    }
}

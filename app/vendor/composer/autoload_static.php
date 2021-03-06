<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2fbaf6d3f0c1e96aca5751bf310c753f
{
    public static $files = array (
        'decc78cc4436b1292c6c0d151b19445c' => __DIR__ . '/..' . '/phpseclib/phpseclib/phpseclib/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'p' => 
        array (
            'phpseclib\\' => 10,
        ),
        'A' => 
        array (
            'Amazon\\Pay\\API\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'phpseclib\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpseclib/phpseclib/phpseclib',
        ),
        'Amazon\\Pay\\API\\' => 
        array (
            0 => __DIR__ . '/..' . '/amzn/amazon-pay-api-sdk-php/Amazon/Pay/API',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2fbaf6d3f0c1e96aca5751bf310c753f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2fbaf6d3f0c1e96aca5751bf310c753f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit2fbaf6d3f0c1e96aca5751bf310c753f::$classMap;

        }, null, ClassLoader::class);
    }
}

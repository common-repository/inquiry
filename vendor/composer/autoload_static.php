<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9b7f5e09dc7113bee52d11eedef6b313
{
    public static $files = array (
        'f1b5996013e748b895412bec3f00926a' => __DIR__ . '/..' . '/amostajo/phpfastcache/src/lib/functions.php',
        '5007cfc3e6a7540fd4311e165110d4b3' => __DIR__ . '/..' . '/amostajo/wordpress-plugin-core/src/lib/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPFastCache\\' => 13,
        ),
        'K' => 
        array (
            'Katzgrau\\KLogger\\' => 17,
        ),
        'I' => 
        array (
            'Inquiry\\' => 8,
        ),
        'A' => 
        array (
            'Amostajo\\WPPluginCore\\' => 22,
            'Amostajo\\LightweightMVC\\' => 24,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPFastCache\\' => 
        array (
            0 => __DIR__ . '/..' . '/amostajo/phpfastcache/src/psr4',
        ),
        'Katzgrau\\KLogger\\' => 
        array (
            0 => __DIR__ . '/..' . '/katzgrau/klogger/src',
        ),
        'Inquiry\\' => 
        array (
            0 => __DIR__ . '/../..' . '/plugin',
        ),
        'Amostajo\\WPPluginCore\\' => 
        array (
            0 => __DIR__ . '/..' . '/amostajo/wordpress-plugin-core/src/psr4',
        ),
        'Amostajo\\LightweightMVC\\' => 
        array (
            0 => __DIR__ . '/..' . '/amostajo/lightweight-mvc/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'Psr\\Log\\' => 
            array (
                0 => __DIR__ . '/..' . '/psr/log',
            ),
        ),
    );

    public static $fallbackDirsPsr0 = array (
        0 => __DIR__ . '/../..' . '/widgets',
    );

    public static $classMap = array (
        'EasyPeasyICS' => __DIR__ . '/..' . '/phpmailer/phpmailer/extras/EasyPeasyICS.php',
        'Katzgrau\\KLogger\\Logger' => __DIR__ . '/..' . '/katzgrau/klogger/src/Logger.php',
        'PHPMailer' => __DIR__ . '/..' . '/phpmailer/phpmailer/class.phpmailer.php',
        'PHPMailerOAuth' => __DIR__ . '/..' . '/phpmailer/phpmailer/class.phpmaileroauth.php',
        'PHPMailerOAuthGoogle' => __DIR__ . '/..' . '/phpmailer/phpmailer/class.phpmaileroauthgoogle.php',
        'POP3' => __DIR__ . '/..' . '/phpmailer/phpmailer/class.pop3.php',
        'SMTP' => __DIR__ . '/..' . '/phpmailer/phpmailer/class.smtp.php',
        'ntlm_sasl_client_class' => __DIR__ . '/..' . '/phpmailer/phpmailer/extras/ntlm_sasl_client.php',
        'phpmailerException' => __DIR__ . '/..' . '/phpmailer/phpmailer/class.phpmailer.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9b7f5e09dc7113bee52d11eedef6b313::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9b7f5e09dc7113bee52d11eedef6b313::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit9b7f5e09dc7113bee52d11eedef6b313::$prefixesPsr0;
            $loader->fallbackDirsPsr0 = ComposerStaticInit9b7f5e09dc7113bee52d11eedef6b313::$fallbackDirsPsr0;
            $loader->classMap = ComposerStaticInit9b7f5e09dc7113bee52d11eedef6b313::$classMap;

        }, null, ClassLoader::class);
    }
}

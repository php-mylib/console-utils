<?php
/**
 * phpunit --bootstrap tests/boot.php tests
 */

error_reporting(E_ALL | E_STRICT);
date_default_timezone_set('Asia/Shanghai');

spl_autoload_register(function($class)
{
    $file = null;

    if (0 === strpos($class,'Inhere\Console\Components\Examples\\')) {
        $path = str_replace('\\', '/', substr($class, strlen('Inhere\Console\Components\Examples\\')));
        $file = dirname(__DIR__) . "/examples/{$path}.php";

    } elseif (0 === strpos($class,'Inhere\Console\Components\Tests\\')) {
        $path = str_replace('\\', '/', substr($class, strlen('Inhere\Console\Components\Tests\\')));
        $file = __DIR__ . "/{$path}.php";
    } elseif (0 === strpos($class,'Inhere\Console\Components\\')) {
        $path = str_replace('\\', '/', substr($class, strlen('Inhere\Console\Components\\')));
        $file = dirname(__DIR__) . "/src/{$path}.php";
    }

    if ($file && is_file($file)) {
        include $file;
    }
});

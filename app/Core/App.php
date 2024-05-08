<?php
namespace App\Core;

class App
{
    protected static $container;

    public static function set($container)
    {
        static::$container = $container;
    }

    public static function get()
    {
        return static::$container;
    }
}
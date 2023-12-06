<?php

class Config
{
    public static function DB_HOST()
    {
        return Config::getEnv("DB_HOST", "127.0.0.1");
    }

    public static function DB_USERNAME()
    {
        return Config::getEnv("DB_USERNAME", "root");
    }

    public static function DB_PASSWORD()
    {
        return Config::getEnv("DB_PASSWORD", "");
    }

    public static function DB_SCHEME()
    {
        return Config::getEnv("DB_SCHEME", "storage");
    }

    public static function DB_PORT()
    {
        return Config::getEnv("DB_PORT", "3307");
    }


    public static function getEnv($name, $default)
    {
        return isset($_ENV[$name]) && trim($_ENV[$name]) != '' ? $_ENV[$name] : $default;
    }
}
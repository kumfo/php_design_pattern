<?php

class Singleton
{
    private static $instance;

    private function __construct(){}

    /**
     * @return Singleton
     */
    public static function getInstance()
    {
        if (static::$instance == null)
        {
            static::$instance = new Singleton();
        }
        return static::$instance;
    }
}


//调用代码
$s1 = Singleton::getInstance();
$s2 = Singleton::getInstance();

if ($s1 === $s2)
{
    echo "singleton\n";
}
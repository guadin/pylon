<?php

class PylonMysql
{
    private static $instance = null;
    public static function getInstance()
    {
        if (!self::$instance)
        {
            self::$instance = new self();
        }
        return self::$instance;
    }
    private function __clone(){}
    // [/Singleton]

    public $cmd = null;

    private function __construct()
    {
        global $config;
        $this->cmd = new MysqliDb($config["db"]["host"], $config["db"]["username"], $config["db"]["password"], $config["db"]["database"]);

    }

    //
    // crud operations go here.
    //
}



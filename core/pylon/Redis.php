<?php
/**
 * Created by JetBrains PhpStorm.
 * User: bahadir
 * Date: 12/11/13
 * Time: 11:22 AM
 * To change this template use File | Settings | File Templates.
 */

class PylonRedis
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

    private $connection = null;

    private function __construct()
    {
        global $config;

        $this->cache = new Redis('redis://' .$config["cache"]["host"]);


    }

    public function set($key, $data){
        $this->cache->set($key, $data);
    }

    public function get($key){
        return $this->cache->get($key);
    }

    //
    // crud operations go here.
    //
}
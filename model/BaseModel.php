<?php
/**
 * Created by PhpStorm.
 * User: guadin
 * Date: 01.07.2014
 * Time: 01:09
 */

class BaseModel {

    protected $db;
    protected $cache;
    protected $config;

    public function __construct() {
        global $config;

        $this->db = Application::initDB();
        $this->cache = Application::initCache();
        $this->config = $config;
    }
}
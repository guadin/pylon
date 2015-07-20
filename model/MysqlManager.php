<?php
/**
 * Created by JetBrains PhpStorm.
 * User: bahadir
 * Date: 12/11/13
 * Time: 10:45 AM
 * To change this template use File | Settings | File Templates.
 */

class MysqlManager {

    private $db;
    private $cache;

    function __construct()
    {


        $host = Application::getConfig("databaseHost");
        $user = Application::getConfig("databaseUser");
        $pass = Application::getConfig("databasePass");
        $database = Application::getConfig("databaseDatabase");

        $this->db = new MysqliDb($host, $user, $pass, $database);
        $this->cache = new CacheManager();
    }

    public function simpleQuery($sql, $cacheKey=null){

       if(Application::getConfig("enableCache")!=false){

           if($cacheKey == null){
               $cacheKey = md5($sql);
           }

           $results = $this->cache->get($cacheKey);

           if($results != null){
            return $results;
           }
           else{
               $results = $this->db->query($sql);
               $this->cache->set($cacheKey, $results);
               return $results;
           }
       }
       else{
           $results = $this->db->query($sql);
           return $results;
       }
    }

    public function safeQuery($sql, $params, $cacheKey=null){

        if(Application::getConfig("enableCache") != false){

            if($cacheKey == null){
                $cacheKey = md5($sql.implode("-", $params ) );
            }

            $results = $this->cache->get($cacheKey);

            if($results != null){

                return $results;
            }
            else{

                $results = $this->db->rawQuery($sql, $params);
                $this->cache->set($cacheKey, $results);
                return $results;
            }
        }
        else{
            $results = $this->db->rawQuery($sql, $params);
            return $results;
        }

    }

    public function insert($table, $columns){
        return $this->db->insert($table, $columns);

    }

    public function update($table, $columns){
        return $this->db->update($table, $columns);
    }



}


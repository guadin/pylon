<?php
/**
 * Created by JetBrains PhpStorm.
 * User: bahadir
 * Date: 12/10/13
 * Time: 4:52 PM
 * To change this template use File | Settings | File Templates.
 */

class Application {

    public function route(){
            global $module;
            global $config;

            if($module == null){

                $urlData = isset($_GET["url"]) ? explode("/", $_GET["url"]) : null;
                $param = null;

                $cnt = count($urlData);


                $controller = "IndexController";
                $action = "Index";
                $param = null;

                if($cnt == 1){
                    $controller = isset($config["defaultController"]) ? $config["defaultController"] : "IndexController";
                    $action = $urlData[0];
                }
                elseif($cnt > 0){
                    $controller = ucfirst($urlData[0])."Controller";

                    if(isset($urlData[1])){
                        $action = $urlData[1];
                    }

                    if(isset($urlData[2])){
                        $param = trim($urlData[2]);
                    }
                }
            }
            else{

                $urlData = isset($_GET["url"]) ? explode("/", $_GET["url"]) : null;
                $param = null;

                $cnt = count($urlData);

                $controller = "IndexController";
                $action = "Index";
                $param = null;

                if($cnt > 1){
                    $controller = ucfirst($urlData[1])."Controller";

                    if(isset($urlData[2])){
                        $action = $urlData[2];
                    }

                    if(isset($urlData[3])){
                        $param = trim($urlData[3]);
                    }
                }
            }

            try{

                $app = new $controller;
                if ($app instanceof Controller){
                    if((method_exists($controller,$action))){
                        $app->$action($param);
                    }else{
                        // Not Found
                    }

                }
            }catch (Exception $e){
                $app = new IndexController();
                $app->NotFound();
            }


    }

    public static function renderView($view, $data = null, $return = false){
        global $module;
        global $config;

        if($return == false){
            require("../$module/view/$view.tpl.php");
        }else{

            ob_start();
            require("../$module/view/$view.tpl.php");
            $text = ob_get_contents();
            ob_end_clean();

            return $text;

        }
    }

    public static function getConfig($key){

        require "../config/app.php";

        if(isset($config[$key])){
            return $config[$key];
        } else {
            return null;
        }

        /*  Sonra cache acılacak ..
        $cache = new CacheManager();

        $config = $cache->get("config");

        if($config == null){

            require "../config/app.php";
            $cache->set("config", serialize($config));
        }else{
            $config = unserialize($config);
        }
        if(isset($config[$key])){
            return $config[$key];
        }else{
            return null;
        }
        */

    }

    public static function initDB(){

        global $config;

        if($config["db"]["status"] == true){
            include 'lib/MysqliDb.php';
            include 'Mysql.php';

           return PylonMysql::getInstance();
        }else{
            return null;
        }

    }

    public static function initCache(){
        global $config;
        if($config["cache"]["status"] == true){
            if($config["cache"]["driver"] == "redis"){
                include 'lib/Redis.php';
                include 'Redis.php';

                return PylonRedis::getInstance();
            }
        }else{
            return null;
        }
    }

    public static function initModule(){
        global $config;
        if($config["useModule"] == TRUE){
            $urlData = isset($_GET["url"]) ? explode("/", $_GET["url"]) : null;

            if($urlData !=null ){

                $module = trim($urlData[0]);
                if(!in_array($module, $config["moduleList"])){
                    $module = null;
                }else{
                    return "modules/$module";
                }
            }
        }else{
            return null;
        }
    }

    public static function renderLayout($layout, $view,  $data){
        global $config;

        $data["PYLON_VIEW"] = $view != NULL ? Application::renderView($view, $data, true) : null;

        return Application::renderView("template/$layout", $data);
    }

}
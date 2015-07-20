<?php
/**
 * Created by JetBrains PhpStorm.
 * User: bahadir
 * Date: 12/10/13
 * Time: 4:59 PM
 * To change this template use File | Settings | File Templates.
 */

class IndexController implements Controller {

    function __construct()
    {
        global $config;
        $this->config = $config;
    }

    public function Index($param=null){
        //Application::renderView("index", $param);


        Application::renderLayout("default", "index", null);
    }

    public function NotFound()
    {
        // TODO: Implement NotFound() method.
    }
}
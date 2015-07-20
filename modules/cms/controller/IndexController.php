<?php
/**
 * Created by JetBrains PhpStorm.
 * User: bahadir
 * Date: 12/10/13
 * Time: 4:59 PM
 * To change this template use File | Settings | File Templates.
 */

class IndexController implements Controller {

    public function Index($param=null){
        Application::renderView("index", null);
    }

    public function NotFound(){
    }

    public function Test(){
        echo "test";
    }

}
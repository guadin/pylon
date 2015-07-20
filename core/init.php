<?php
session_start();
include __DIR__ .'/../config/app.php';
include __DIR__. '/../config/define.php';
include __DIR__.'/pylon/Controller.php';
include  __DIR__.'/pylon/Application.php';

global $module;


$module = Application::initModule();


function autoLoadMVC($class_name) {
    global $module;


    if(file_exists( __DIR__."/../$module/model/".$class_name . '.php')){
        include  __DIR__."/../$module/model/".$class_name . '.php';
    }
    elseif(file_exists( __DIR__."/../$module/controller/".$class_name . '.php')){
        include  __DIR__."/../$module/controller/".$class_name . '.php';
    }
    else{
        throw new Exception("404", 1);
    }
}


spl_autoload_register("autoLoadMVC");
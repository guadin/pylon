<?php

$config = array(

    "domain" => "http://pylon.com",
    "environment" => "develop",
    "useModule" =>false,
    "moduleList" => array("cms"),
    "defaultController"=>"IndexController",
    "imagePath" => "http://pylon.com/images",
    "site_alias" => "pylon",
    "file_cache"=> true,
    "data_cacyhe" => true,
    "db"=> array(
        "status"=>true,
        "host" => "localhost",
        "username" => "root",
        "password" => "",
        "database" => "social_netwok"
    ),

    "cache" => array(
        "status" => true,
        "driver"=>"redis",
        "host" => "127.0.0.1",
        "time" => 1
    )
);
<?php
/**
 * Created by PhpStorm.
 * User: guadin
 * Date: 06.04.2014
 * Time: 23:00
 */

interface Controller {
    public function Index($param=null);
    public function NotFound();

}
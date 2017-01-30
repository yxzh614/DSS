<?php
/**
 * Created by PhpStorm.
 * User: ak-hyeon-chal
 * Date: 17/1/21
 * Time: 16:44
 */
if(!defined('IN_SYS')){
    define('IN_SYS',true);
}
require_once "setting.php";
require "leftbar.php";
include "navbar.php";

if(isset($_GET["class"])){
    switch ($_GET["class"]){
        case 'upfile':{
            include "upload.php";
        }break;
    }
}

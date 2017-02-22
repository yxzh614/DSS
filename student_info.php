<?php
/**
 * Created by PhpStorm.
 * User: ak-hyeon-chal
 * Date: 17/2/12
 * Time: 15:15
 */
if(!defined('IN_SYS')){
    define('IN_SYS',true);
}
require_once "setting.php";
if(isset($_GET["sn"])){
echo $_GET["sn"];
}
<?php
/**
 * Created by PhpStorm.
 * User: ak-hyeon-chal
 * Date: 17/1/18
 * Time: 15:31
 */
if(!defined('IN_SYS')){
    define('IN_SYS',true);
}
require_once ("setting.php");
setcookie("username",'');

setcookie("flag",'');
?>
<script>
    window.location="index.php";
</script>

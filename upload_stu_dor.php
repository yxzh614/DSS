<?php
/**
 * Created by PhpStorm.
 * User: ak-hyeon-chal
 * Date: 17/2/15
 * Time: 12:35
 */

if(!defined('IN_SYS')) {
    define('IN_SYS', true);
}
require_once ("setting.php");
include("upload_stu_dor_fun.php");

if($_POST['submit']&&$_POST["submit"]){

    $leadExcel=$_POST['leadExcel'];

    if($leadExcel == "true")
    {
        //echo "OK";die();
        //获取上传的文件名
        $filename = $_FILES['file_stu']['name'];
        //上传到服务器上的临时文件名
        $tmp_name = $_FILES['file_stu']['tmp_name'];

        $msg = uploadFile($db, $filename,$tmp_name);
        echo $msg;
        ?>
        <script>
            /*
             alert('导入成功');
             window.location="index.php";
             */
        </script>
        <?php
    }
}
?>
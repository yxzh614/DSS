<?php
/**
 * Created by PhpStorm.
 * User: ak-hyeon-chal
 * Time: 9:13
 * Date: 17/1/15
 */
if(!defined('IN_SYS')){
    define('IN_SYS',true);
}
require_once ("setting.php");
if(isset($_POST['submit'])&&$_POST["submit"]&&isset($_POST['userName'])&&isset($_POST['password'])) {
    $userName = $_POST["userName"];
    $password = md5($_POST["password"]);
    $res = mysqli_query($db, "SELECT UserName,Flag FROM tbl_user WHERE UserName='$userName'AND Password='$password'");
    if ($getuser = mysqli_fetch_array($res)) {
        setcookie("username", $getuser[0]);
        setcookie("flag", $getuser[1]);
        ?>
        <script>
            alert('成功登陆');
            window.location = "index.php";
        </script>
        <?php

        echo "ok";
    } else {
        ?>
<script>
    alert('登录失败！');
</script>
        <?php

    }
}
?>
<div id="login">
<div id="login-head">
    <h1 id="icon">寝室评分系统</h1>
    <h2 id="icontext">寝室评分系统</h2>
    <h1 style="width: 100%;background-color: white;float: left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;寝室评分管理系统</h1>
</div>
<div id="loginform">
    <div id="login-form">
<form role="form" action="login.php" method="post">
    <div class="form-group">
        <label for="inputusername">用户名</label>
        <input name="userName" type="text" class="form-control" id="InputUserName" placeholder="用户名">
    </div>
    <div class="form-group">
        <label for="InputPassword">密码</label>
        <input name="password" type="password" class="form-control" id="InputPassword" placeholder="Password">
    </div>
    <input name="submit" type="submit" class="btn btn-default" style="width: 100%" value="登录" >
</form>
        <button class="btn" style="width: 100%">下载APP</button>
    </div>
</div>
</div>
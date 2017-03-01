
<?php
/*setting.php
服务器连接字符串。
头文件。

*/
chdir(dirname(__FILE__));
//设置网站根目录
$mysql_server="localhost";
//主机名
$mysql_username="root";
//用户名
$mysql_userpass="abcdefg707";
//用户密码
$db_name="score";
//数据库名
$db=mysqli_connect($mysql_server,$mysql_username,$mysql_userpass);
mysqli_select_db($db,$db_name);
mysqli_query($db,"set names utf8");

if(!defined('IN_SYS')) {
    exit('禁止访问');
}//限制访问页面
?>
<link href="bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet">
<link href="css/main.css" type="text/css" rel="stylesheet">
<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<meta charset="utf-8">
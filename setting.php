
<?php
chdir(dirname(__FILE__));
$mysql_server="localhost";
$mysql_username="root";
$mysql_userpass="abcdefg707";
$db_name="score";
$db=mysqli_connect($mysql_server,$mysql_username,$mysql_userpass);
mysqli_select_db($db,$db_name);
mysqli_query($db,"set names utf8");


function utf8_substr($str,$len)
{
    $new_str[]='';
    for ($i = 0; $i < $len; $i++) {
        $temp_str = substr($str, 0, 1);
        if (ord($temp_str) > 127) {
            $i++;
            if ($i < $len) {
                $new_str[] = substr($str, 0, 3);
                $str = substr($str, 3);
            }
        } else {
            $new_str[] = substr($str, 0, 1);
            $str = substr($str, 1);
        }
    }
    return join($new_str);
}

?>
<link href="bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet">
<link href="css/main.css" type="text/css" rel="stylesheet">
<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<meta charset="utf-8">
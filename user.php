<?php
/**
 * Created by PhpStorm.
 * User: ak-hyeon-chal
 * Date: 17/3/25
 * Time: 19:21
 */
if(!defined('IN_SYS')){
    define('IN_SYS',true);
}
if(!isset($_COOKIE["flag"])) {//登录
    require_once("login.php");
}
else {
    require "leftbar.php";
    include "navbar.php";
    require_once "setting.php";

    ?>
    <div id="mainarea">
        <?php
    $sqlFindAllUser = "SELECT UserName,Name,Flag FROM tbl_user";
    if ($resFAU = mysqli_query($db, $sqlFindAllUser)) {
        ?>
        <table class="table table-bordered">
        <caption>
            用户列表：
        </caption>
        <thead>
        <tr>
            <th>帐号</th>
            <th>姓名</th>
            <th>权限</th>
        </tr>
        </thead>
        <tbody>
        <?php
        while ($rowsFAU = mysqli_fetch_assoc($resFAU)) {
            echo "<tr>";
            echo "<td>".$rowsFAU["UserName"]."</td>";
            echo "<td>".$rowsFAU["Name"]."</td>";
            echo "<td>".FlagToJob($rowsFAU["Flag"])."</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
        </table>
        <?php
    }
?>
    </div>
<?php
}
function FlagToJob($number){
    switch ($number){
        case 0:return "admin";break;
        case 1:return "指导员";break;
        case 2:return "宿管";break;
        case 3:return "学生干部";break;
    }
}
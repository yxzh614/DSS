<?php
/**
 * Created by PhpStorm.
 * User: ak-hyeon-chal
 * Date: 17/3/3
 * Time: 22:17
 */

if(!defined('IN_SYS')){
    define('IN_SYS',true);
}
require_once ('setting.php');
if(isset($_GET["col"])) {
    $col = $_GET["col"];
    $response="";
    $sqlColHaveGrade="SELECT DISTINCT Grade FROM tbl_col_dep_grade WHERE College =( SELECT tbl_college_name.HouseID FROM tbl_college_name WHERE tbl_college_name.HouseName = '".$col."' ) ORDER BY Grade";
    if($resCHG=mysqli_query($db,$sqlColHaveGrade)){
        while ($rowsCHG=mysqli_fetch_assoc($resCHG)){
                echo '<li><a onclick="inputName('."'InputTeacher'".',this)">'.$rowsCHG["Grade"].'</a></li>';
        }
    }
//output the response
    echo $response;
}
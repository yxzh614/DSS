<?php
//主页
require_once("setting.php");

if(!isset($_COOKIE["flag"])){//登录
    require_once ("login.php");
}
else {
    require ("navbar.php");//导航条
    require ("leftbar.php");//侧边条
    ?>
    <div id="mainarea">
    <?php

    if (isset($_GET["class"])) {
        switch ($_GET["class"]){
            case 'teacher':{
                if (isset($_GET["teacher"])) {
                    $sqlTeaToStu = "SELECT
  s.StuName AS ssn,
  ss.StuNum AS sssn,
  AVG(Score) AS aScore
FROM
  tbl_student AS s,
  tbl_studentscore AS ss,
  tbl_stu_tea AS st
WHERE
  ss.StuNum = s.StuNum AND ss.StuNum = st.StuNum AND st.UserName = " . $_GET["teacher"] . "
GROUP BY
  sssn";
                    if ($resTTS = mysqli_query($db, $sqlTeaToStu)) {
                        ?>
                        <table class="table table-striped table-condensed">
                            <caption>按导员分类</caption>
                            <thead>
                            <tr>
                                <th>学号</th>
                                <th>姓名</th>
                                <th>得分</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            while ($rowsTTS = mysqli_fetch_assoc($resTTS)) {
                                echo "<tr>";
                                echo "<td>" . $rowsTTS["sssn"] . "</td>";
                                echo "<td>" . $rowsTTS["ssn"] . "</td>";
                                echo "<td>" . $rowsTTS["aScore"] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                        <?php
                    } else {
                        echo "空数据！";
                    }
                }
            } break;
            case 'grade':{
                if(isset($_GET["grade"])){
                $sqlGraToStu='SELECT
  s.StuName AS ssn,
  ss.StuNum AS sssn,
  AVG(Score) AS aScore
FROM
  tbl_student AS s,
  tbl_studentscore AS ss,
  tbl_stu_tea AS st
WHERE
  ss.StuNum = s.StuNum AND ss.StuNum = st.StuNum AND ss.StuNum LIKE "'.$_GET["grade"].'______"
GROUP BY
  sssn';
                if($resGTS=mysqli_query($db,$sqlGraToStu)){
                    ?>
                    <table class="table table-striped table-condensed">
                    <caption>按学院分类</caption>
                    <thead>
                    <tr>
                        <th>学号</th>
                        <th>姓名</th>
                        <th>得分</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($rowsGTS=mysqli_fetch_assoc($resGTS)){
                        echo "<tr>";
                        echo "<td>" . $rowsGTS["sssn"] . "</td>";
                        echo "<td>" . $rowsGTS["ssn"] . "</td>";
                        echo "<td>" . $rowsGTS["aScore"] . "</td>";
                        echo "</tr>";
                    }
                }
            }} break;
            default:;
        }
    }
    ?>
    </div>
    <?php
}
?>
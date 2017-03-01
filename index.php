<?php
/**主页
 * 主要用来显示分类的得分纪录
 * 分类：老师、学院、宿舍楼。
 */

if(!defined('IN_SYS')){
    define('IN_SYS',true);
}
require_once("setting.php");

if(!isset($_COOKIE["flag"])) {//登录
    require_once("login.php");
}
else {
    require ("navbar.php");//导航条
    require ("leftbar.php");//侧边条
    ?>
    <div id="mainarea">
        <div id="loading"></div>
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
  ss.StuNum = s.StuNum AND ss.StuNum = st.StuNum AND st.UserName = '" . $_GET["teacher"] . "'
GROUP BY
  sssn";
                    $sqlUserNameToName="SELECT Name FROM tbl_user WHERE UserName='".$_GET["teacher"]."'";
                    if($resUNTN=mysqli_query($db,$sqlUserNameToName)) {
                        $rowsUNTN = mysqli_fetch_array($resUNTN) ;
                            if ($resTTS = mysqli_query($db, $sqlTeaToStu)) {
                                ?>
                                <table class="table table-bordered" id="TableScore">
                                    <caption>指导员：
                                        <?php
                                        echo $rowsUNTN["Name"];
                                        ?><p id="ascore"></p>
                                    </caption>
                                    <thead>
                                    <tr>
                                        <th onclick="$.sortTable.sort('TableScore',0)" style="cursor: pointer;">学号</th>
                                        <th onclick="$.sortTable.sort('TableScore',1)" style="cursor: pointer;">姓名</th>
                                        <th onclick="$.sortTable.sort('TableScore',2)" style="cursor: pointer;">得分</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    while ($rowsTTS = mysqli_fetch_assoc($resTTS)) {
                                        echo "<tr>";
                                        echo "<td>" . $rowsTTS["sssn"] . "</td>";
                                        echo "<td>" . $rowsTTS["ssn"] . "</td>";
                                        echo "<td id='score'>" . round( $rowsTTS["aScore"],2) . "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                    </tbody>
                                </table>
            <script type="text/javascript">
                if(document.getElementById('TableScore')) {
                    //merge('TableScore', '2');
                    window.onload=function() {
                        $("#loading").fadeOut();
                    }
                }
            </script>
                                <?php
                            } else {
                                echo "空数据！";
                                echo $sqlTeaToStu;
                            }

                    }else {
                        echo "空数据！";
                        echo $sqlTeaToStu;
                    }
                }
            } break;
            case 'grade': {
                if (isset($_GET["grade"])) {
                    $sqlGraToStu = 'SELECT
  s.StuName AS ssn,
  ss.StuNum AS sssn,
  AVG(Score) AS aScore,
  MAX(u.Name) AS un
FROM
  tbl_student AS s,
  tbl_studentscore AS ss,
  tbl_stu_tea AS st,
  tbl_user AS u
WHERE
  ss.StuNum = s.StuNum AND ss.StuNum = st.StuNum AND ss.StuNum LIKE "' . $_GET["grade"] . '______" AND st.UserName = u.UserName
GROUP BY
  sssn';
                    if ($resGTS = mysqli_query($db, $sqlGraToStu)) {
                        ?>
                        <table class="table table-bordered" id="TableScore">
                            <caption>按学院分类<p id="ascore"></p></caption>
                            <thead>
                            <tr>
                                <th onclick="$.sortTable.sort('TableScore',0)" style="cursor: pointer;">学号</th>
                                <th onclick="$.sortTable.sort('TableScore',1)" style="cursor: pointer;">姓名</th>
                                <th onclick="$.sortTable.sort('TableScore',2)" style="cursor: pointer;">指导员</th>
                                <th onclick="$.sortTable.sort('TableScore',3)" style="cursor: pointer;">得分</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            while ($rowsGTS = mysqli_fetch_assoc($resGTS)) {
                                echo "<tr>";
                                echo "<td>" . $rowsGTS["sssn"] . "</td>";
                                echo "<td>" . $rowsGTS["ssn"] . "</td>";
                                echo "<td>".$rowsGTS["un"]."</td>";
                                echo "<td id='score'>" . round( $rowsGTS["aScore"],2) . "</td>";
                                echo "</tr>";
                            }
                            ?>
                            </tbody>
                        </table>
            <script type="text/javascript">
                if(document.getElementById('TableScore')) {
                    //merge('TableScore', '2');
                    window.onload = function () {
                        $("#loading").fadeOut();
                    }
                }
            </script>
                        <?php
                    }
                }
            }
            break;
            case 'building':{
if(isset($_GET["building"])){
                        $sqlBuiToStu = 'SELECT
  s.StuName AS ssn,
  ss.StuNum AS sssn,
  AVG(ss.Score) AS aScore,
  MAX(u.Name) AS un,
  MAX(sd.RoomNum) AS sdrn,
  MAX(sd.BedNum) AS sdbn
FROM
  tbl_student AS s,
  tbl_studentscore AS ss,
  tbl_stu_dor AS sd,
  tbl_stu_tea AS st,
  tbl_user AS u
WHERE
  ss.StuNum = st.StuNum AND ss.StuNum = s.StuNum AND ss.StuNum = sd.StuNum AND sd.BuildNum = ' . $_GET["building"] . ' AND st.UserName = u.UserName
GROUP BY
  sssn
  ORDER BY
  sdrn,sdbn
  ';
                        if ($resBTS = mysqli_query($db, $sqlBuiToStu)){
                        ?>
            <table class="table table-bordered" id="TableScore">
                <caption>楼号：<?php echo $_GET["building"]; ?> <p id="ascore"></p></caption>
                <thead>
                <tr>
                    <th onclick="unmerge('TableScore','2');$.sortTable.sort('TableScore',0);" style="cursor: pointer;">
                        学号
                    </th>
                    <th onclick="unmerge('TableScore','2');$.sortTable.sort('TableScore',1);" style="cursor: pointer;">
                        姓名
                    </th>
                    <th onclick="unmerge('TableScore','2');$.sortTable.sort('TableScore',2);" style="cursor: pointer;">
                        寝室
                    </th>
                    <th onclick="unmerge('TableScore','2');$.sortTable.sort('TableScore',3);" style="cursor: pointer;">
                        床号
                    </th>
                    <th onclick="unmerge('TableScore','2');$.sortTable.sort('TableScore',4);" style="cursor: pointer;">
                        得分
                    </th>
                    <th onclick="unmerge('TableScore','2');$.sortTable.sort('TableScore',5);" style="cursor: pointer;">
                        导员
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php
                while ($rowsBTS = mysqli_fetch_assoc($resBTS)) {
                    echo "<tr>";
                    echo "<td>" . $rowsBTS["sssn"] . "</td>";
                    echo "<td>" . $rowsBTS["ssn"] . "</a></td>";
                    echo "<td align='center'>" . $rowsBTS["sdrn"] . "</a></td>";
                    echo "<td>" . $rowsBTS["sdbn"] . "</a></td>";
                    echo "<td id='score'>" . round($rowsBTS["aScore"], 2) . "</td>";
                    echo "<td>" . $rowsBTS["un"] . "</td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
            <script type="text/javascript">
                if (document.getElementById('TableScore')) {
                    merge('TableScore', '2');
                    window.onload = function () {
                        $("#loading").fadeOut();
                    }
                }
            </script>
            <?php
        }
        }
            } break;
            default:;
        }
    }
    ?>
    </div>
    <?php
}
?>


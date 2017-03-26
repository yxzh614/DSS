<?php
/**
 * Created by PhpStorm.
 * User: ak-hyeon-chal
 * Date: 17/2/6
 * Time: 19:11
 */if(!defined('IN_SYS')){
    define('IN_SYS',true);}
if(!isset($_COOKIE["flag"])) {//登录
    require_once("login.php");
}
else{
    require_once("setting.php");
    require("navbar.php");
    if (isset($_POST["submit"]) && $_POST["submit"]) {
        switch (strlen($_POST["target"])) {
            case 10: {
                $sqlNumToNameBed = "SELECT StuName,BuildNum,RoomNum,BedNum  FROM tbl_student,tbl_stu_dor WHERE tbl_student.StuNum=" . $_POST["target"] . " AND tbl_stu_dor.StuNum=" . $_POST["target"];

                $sqlAllTheStudent = "SELECT
  tbl_studentscore.Time AS sst,
  tbl_user.Name AS un,
  tbl_studentscore.Score AS sss
FROM
  tbl_studentscore,
  tbl_user
WHERE
  tbl_studentscore.StuNum = '" . $_POST["target"] . "' AND tbl_studentscore.UserName = tbl_user.UserName
ORDER BY
  TIME";
                if ($resNTN = mysqli_query($db, $sqlNumToNameBed)) {
                    if ($resATS = mysqli_query($db, $sqlAllTheStudent)) {

                        ?>
                        <table class="table table-striped table-condensed">
                            <caption><?php
                                echo "学号：" . $_POST["target"];

                                echo "<br>";
                                while ($rowsNTNB = mysqli_fetch_assoc($resNTN)) {
                                    echo "姓名：" . $rowsNTNB["StuName"];
                                    echo "<br>";
                                    echo "楼号：" . $rowsNTNB["BuildNum"];
                                    echo "<br>";
                                    echo "寝室号：" . $rowsNTNB["RoomNum"];
                                    echo "<br>";
                                    echo "床号：" . $rowsNTNB["BedNum"];
                                }
                                ?>
                            </caption>
                            <thead>
                            <tr>
                                <th>得分</th>
                                <th>打分人</th>
                                <th>打分时间</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            while ($rowsATS = mysqli_fetch_assoc($resATS)) {
                                echo "<tr>";
                                echo "<td>" . $rowsATS["sss"] . "</td>";
                                echo "<td>" . $rowsATS["un"] . "</td>";
                                echo "<td>" . $rowsATS["sst"] . "</td>";
                                if ($_POST["type"] == 1) {
                                    ?>
                                    <td>
                                        <form action="del_score.php" method="post" onsubmit="return checkDel()">
                                            <input type="hidden" name="num" value="<?php echo $_POST["target"] ?>">
                                            <input type="hidden" name="date" value="<?php echo $rowsATS["sst"] ?>">
                                            <input type="hidden" name="score" value="<?php echo $rowsATS["sss"] ?>">
                                            <input class="btn btn-default" type="submit" name="submit" value="del">
                                        </form>
                                    </td>
                                    <?php
                                }
                                echo "</tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                        <?php
                    } else {
                        echo "myjl";
                    }
                } else {
                    echo "cwcr";
                }
            }
                break;
            case 8: {
            }
                break;
        }

    } else {
        echo "error";
    }
}
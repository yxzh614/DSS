<?php
/**
 * Created by PhpStorm.
 * User: ak-hyeon-chal
 * Date: 17/2/6
 * Time: 19:11
 */if(!defined('IN_SYS')){
    define('IN_SYS',true);}

require_once ("setting.php");
require ("navbar.php");
if(isset($_POST["submit"])&&$_POST["submit"]) {
    if (strlen($_POST["target"]) == 10) {
        $sqlNumToName = "SELECT StuName FROM tbl_student WHERE StuNum=".$_POST["target"];
        $sqlAllTheStudent = "SELECT
  tbl_studentscore.Time AS sst,
  tbl_user.Name AS un,
  tbl_studentscore.Score AS sss
FROM
  tbl_studentscore,
  tbl_user
WHERE
  tbl_studentscore.StuNum = '".$_POST["target"]."' AND tbl_studentscore.UserName = tbl_user.UserName
ORDER BY
  TIME";
        if ($resNTN = mysqli_query($db, $sqlNumToName)) {
            if ($resATS = mysqli_query($db, $sqlAllTheStudent)) {

                ?>
                <table class="table table-striped table-condensed">
                    <caption><?php
                        echo "学号：".$_POST["target"];
                        while ($rowsNTN=mysqli_fetch_assoc($resNTN)){
                            echo "姓名：".$rowsNTN["StuName"];
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
                        echo "</tr>";
                    }
                    ?>
                    </tbody>
                </table>
                <?php
            }
            else{
                echo "myjl";
            }
        }
        else{
            echo "cwcr";
        }
    }
}
else{
    echo "error";
}
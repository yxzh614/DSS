<?php
/**
 * Created by PhpStorm.
 * User: ak-hyeon-chal
 * Date: 17/1/21
 * Time: 16:44
 */
if(!defined('IN_SYS')){
    define('IN_SYS',true);
}
require_once "setting.php";
require "leftbar.php";
include "navbar.php";

if(isset($_GET["class"])) {
    switch ($_GET["class"]) {
        case 'upfile': {
            if (isset($_GET["type"])) {
                switch ($_GET["type"]) {
                    case 'student': {
                    }
                        break;
                    case 'score': {
                        ?>
                        <form method="post" action="upload_score.php" enctype="multipart/form-data">
                            <h3>导入Excel表：</h3><input type="file" name="file_stu"/>
                            <input type="hidden" name="leadExcel" value="true">
                            <input type="submit" name="submit" value="导入"/>
                        </form>
                        <?php
                    }
                        break;
                }
            }

        }
            break;
        case 'count': {
            $sqlFindAllCollege = "select HouseName,HouseID from tbl_college_name ORDER BY HouseID";
            if ($resFAC = mysqli_query($db, $sqlFindAllCollege)) {
                while ($rowsFAC = mysqli_fetch_assoc($resFAC)) {
                    ?>
                    <table class="table table-striped table-condensed">
                        <caption>按学院分类</caption>
                        <thead>
                        <tr>
                            <th>学院</th>
                            <th>得分</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($rowsFAC = mysqli_fetch_assoc($resFAC)) {
                            echo "<tr>";
                            echo "<td>" . $rowsFAC["HouseName"] . "</td>";
                            $houseid = $rowsFAC["HouseID"] < 10 ? '0' . $rowsFAC["HouseID"] : $rowsFAC["HouseID"];
                            $sqlAScoreOfCollege = 'SELECT AVG(Score) AS ac FROM tbl_studentscore AS ss WHERE ss.StuNum LIKE "__' . $houseid . '______"';
                            if ($resAOC = mysqli_query($db, $sqlAScoreOfCollege)) {
                                while ($rowsAOC = mysqli_fetch_assoc($resAOC)) {
                                    echo "<td>" . $rowsAOC["ac"] . "</td>";
                                }
                            }

                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                    </table>

                    <?php
                }
            }
        }
            break;
    }
}

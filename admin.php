<?php
/**
 * 管理页面，包含上传、修改、统计功能。
 */
if(!defined('IN_SYS')){
    define('IN_SYS',true);
}

require_once "setting.php";
require "leftbar.php";
include "navbar.php";
?>
    <div id="mainarea">
<?php
if(isset($_GET["class"])) {
    switch ($_GET["class"]) {
        case 'upfile': {
            if (isset($_GET["type"])) {
                switch ($_GET["type"]) {
                    case 'student': {
                        ?>

                        <form method="post" action="upload_stu_dor.php" enctype="multipart/form-data">
                            <h3>导入学生-寝室Excel表：</h3><input type="file" name="file_stu"/>
                            <input type="hidden" name="leadExcel" value="true">
                            <input type="submit" name="submit" value="导入"/>
                        </form>
                        <form method="post" action="upload_stu_info.php" enctype="multipart/form-data">
                            <h3>导入学生Excel表：</h3><input type="file" name="file_stu"/>
                            <input type="hidden" name="leadExcel" value="true">
                            <input type="submit" name="submit" value="导入"/>
                        </form>
                        <?php
                    }
                        break;
                    case 'score': {
                        ?>
                        <form method="post" action="upload_score.php" enctype="multipart/form-data">
                            <h3>导入分数Excel表：</h3><input type="file" name="file_stu"/>
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
            if(isset($_GET["type"])){
                switch ($_GET["type"]){
                    case 'college':{
                        $sqlFindAllCollege = "select DISTINCT College,Grade,HouseName FROM tbl_col_dep_grade,tbl_college_name WHERE HouseID=College ORDER BY College,Grade";
                        if ($resFAC = mysqli_query($db, $sqlFindAllCollege)) {
                            while ($rowsFAC = mysqli_fetch_assoc($resFAC)) {
                                ?>
                                <table class="table table-bordered">
                                    <caption>按学院分类</caption>
                                    <thead>
                                    <tr>
                                        <th>学院</th>
                                        <th>年级</th>
                                        <th>得分</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    while ($rowsFAC = mysqli_fetch_assoc($resFAC)) {
                                        echo "<tr>";
                                        echo "<td>" . $rowsFAC["HouseName"] . "</td>";
                                        echo "<td>" .$rowsFAC["Grade"]. "</td>";
                                        $houseid = $rowsFAC["College"] < 10 ? '0' . $rowsFAC["College"] : $rowsFAC["College"];
                                        $grade=$rowsFAC["Grade"];
                                        $sqlAScoreOfCollege = 'SELECT AVG(Score) AS ac FROM tbl_studentscore AS ss WHERE ss.StuNum LIKE "' . $grade. $houseid .'______"';
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
                    }break;
                }
            }

        }
            break;
    }
}
?>
    </div>

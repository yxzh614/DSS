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
        <div id="loading"></div>
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
        <script>
            window.onload = function () {
                $("#loading").fadeOut();
            }
        </script>
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
        <script>
            window.onload = function () {
                $("#loading").fadeOut();
            }
        </script>
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
                                <table class="table table-bordered" id="TableScore">
                                    <caption>按学院分类</caption>
                                    <thead>
                                    <tr>
                                        <th onclick="unmerge('TableScore','0');unmerge('TableScore','1');$.sortTable.sort('TableScore',0);merge('TableScore','0')" style="cursor: pointer;">学院</th>
                                        <th onclick="unmerge('TableScore','0');unmerge('TableScore','1');$.sortTable.sort('TableScore',1);merge('TableScore','1')" style="cursor: pointer;">年级</th>
                                        <th onclick="unmerge('TableScore','0');unmerge('TableScore','1');$.sortTable.sort('TableScore',2);" style="cursor: pointer;">得分</th>
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
        <script type="text/javascript">
            if(document.getElementById('TableScore')) {
                merge('TableScore', '0');
            }
            window.onload = function () {
                $("#loading").fadeOut();
            }
        </script>
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
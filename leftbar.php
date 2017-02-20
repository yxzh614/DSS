<?php
/**
 * Created by PhpStorm.
 * User: ak-hyeon-chal
 * Date: 17/1/18
 * Time: 17:36
 */
require_once ("setting.php");
?>
<div id="leftbar" class="list-group hidden-print">
    <?php
    if (isset($_GET["class"])) {
        switch ($_GET["class"]){
            case 'teacher':{
                $sqlFindAllTeacher = "select Name,UserName from tbl_user WHERE Flag=1";
                $resFAT = mysqli_query($db, $sqlFindAllTeacher);
                ?>
                <div class="btn-group-vertical" style="width: 100%">
                <?php
                while ($rowsFAT = mysqli_fetch_assoc($resFAT)) {

                    echo "<a class='btn btn-default list-group-item' href='index.php?class=teacher&teacher=" . $rowsFAT["UserName"] . "'>" . $rowsFAT["Name"] . "</a>";

                }
                ?>
                </div>
                <?php
            }break;
            case 'grade':{
                $sqlFindAllCollege = "select HouseName,HouseID from tbl_college_name ORDER BY HouseID";
                $resFAC = mysqli_query($db, $sqlFindAllCollege);
                while ($rowsFAC = mysqli_fetch_assoc($resFAC)) {
                    ?>
                    <div class="btn-group-vertical" style="width: 100%">
                    <div class="btn-group">
                    <button class="btn btn-default dropdown-toggle list-group-item" style="width: 100%" type="button"
                            id="dropdownMenu1" data-toggle="dropdown">
                        <?php echo $rowsFAC["HouseName"]; ?>
                        <span id="tri" class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                    <?php
                    $sqlFindTheGrade = "select DISTINCT Grade from tbl_col_dep_grade WHERE College=" . $rowsFAC["HouseID"]." ORDER BY Grade" ;
                    $resFTG = mysqli_query($db, $sqlFindTheGrade);
                    while ($rowsFTG = mysqli_fetch_assoc($resFTG)) {
                        $houseid = $rowsFAC["HouseID"] < 10 ? '0' . $rowsFAC["HouseID"] : $rowsFAC["HouseID"];
                        echo '<li role = "presentation" ><a role = "menuitem" tabindex = "-1" href = "index.php?class=grade&grade='. $rowsFTG["Grade"].$houseid .' ">'.$rowsFTG["Grade"].'</a ></li >';
                        }
                        ?>


                        </ul>
                        </div>
                        </div>
                        <?php
                    }

            }break;
            case 'building':{
                $sqlFindAllBuilding = "select BuildNum from tbl_building";
                $resFAT = mysqli_query($db, $sqlFindAllBuilding);

                while ($rowsFAT = mysqli_fetch_assoc($resFAT)) {
                    echo "<a class='list-group-item' href='index.php?class=building&building=" . $rowsFAT["BuildNum"] . "'>" . $rowsFAT["BuildNum"] . "</a>";
                }
            }break;
            case 'upfile':{
                echo "<a href='admin.php?class=upfile&type=student' class='list-group-item'>学生信息</a>";
                echo "<a href='admin.php?class=upfile&type=score' class='list-group-item'>评分信息</a>";
            } break;
            case 'count':{

                echo "<a href='admin.php?class=count&type=college' class='list-group-item'>学院</a>";
            }break;
        }
    }
    ?>
</div>


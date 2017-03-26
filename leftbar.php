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
                ?>
                <form>
        <div class="input-group">
            <input type="text" class="form-control" aria-label="..." title="学院" id="InputCol" value="">
            <div class="input-group-btn">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">学院<span class="caret"></span></button>
                <ul class="dropdown-menu dropdown-menu-right">
                    <?php
                    $sqlFindAllCollege = "select HouseName,HouseID from tbl_college_name ORDER BY HouseID";
                    $resFAC = mysqli_query($db, $sqlFindAllCollege);
                    while ($rowsFAC=mysqli_fetch_assoc($resFAC)){
                        echo '<li><a onclick="inputName('."'InputCol'".',this)">'.$rowsFAC["HouseName"].'</a></li>';
                    }
                    ?>
                </ul>
            </div><!-- /btn-group -->
        </div><!-- /input-group -->
        <div class="input-group">
            <input type="text" class="form-control" aria-label="..." title="年级" id="InputGrade">
            <div class="input-group-btn">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  onclick=showHint(document.getElementById('InputCol').value)>年级<span class="caret"></span></button>
                <ul class="dropdown-menu dropdown-menu-right" id="TeacherList">
                </ul>
            </div><!-- /btn-group -->
        </div><!-- /input-group -->
                    <div class="input-group">
                        <input type="text" class="form-control" aria-label="..." title="年级" id="InputTeacher">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  onclick=showHint(document.getElementById('InputCol').value)>学年<span class="caret"></span></button>
                            <ul class="dropdown-menu dropdown-menu-right" id="TeacherList">
                            </ul>
                        </div><!-- /btn-group -->
                    </div><!-- /input-group -->

                    <a onclick="getaverage()" class="btn btn-default" name="submit">确定</a>
                </form>
                <?php
            }break;
        }
    }
    ?>
</div>
<script>
    var XMLHTTP=null;
    if(window.XMLHttpRequest){
        XMLHTTP=new XMLHttpRequest();
    }else if (window.ActiveXObject)
    {
        XMLHttp=new ActiveXObject("Microsoft.XMLHTTP")
    }
</script>

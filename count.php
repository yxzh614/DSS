<?php
/**
 * Created by PhpStorm.
 * User: ak-hyeon-chal
 * Date: 17/1/30
 * Time: 20:55
 */

require_once ("setting.php");

$sqlFindAllCollege = "select HouseName,HouseID from tbl_college_name ORDER BY HouseID";
if( $resFAC = mysqli_query($db, $sqlFindAllCollege)) {
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
                $sqlAScoreOfCollege='SELECT AVG(Score) AS ac FROM tbl_studentscore AS ss WHERE ss.StuNum LIKE "__'.$houseid.'______"';
                if($resAOC=mysqli_query($db,$sqlAScoreOfCollege)){
                    while ($rowsAOC=mysqli_fetch_assoc($resAOC)){
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
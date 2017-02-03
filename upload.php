<?php
/**
 * Created by PhpStorm.
 * User: ak-hyeon-chal
 * Date: 17/1/16
 * Time: 16:07
 */
require_once ("setting.php");
if(isset($_GET["type"])){
    switch ($_GET["type"]){
        case 'student':{}break;
        case 'score':{
?>
<form method="post" action="upload_score.php" enctype="multipart/form-data">
    <h3>导入Excel表：</h3><input  type="file" name="file_stu" />
    <input type="hidden" name="leadExcel" value="true">
    <input type="submit" name="submit"  value="导入" />
</form>
<?php
        }break;
    }
}


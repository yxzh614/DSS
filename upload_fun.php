<?php
/**
 * Created by PhpStorm.
 * User: ak-hyeon-chal
 * Date: 17/1/19
 * Time: 15:27
 */
//导入Excel文件

function uploadFile($db, $file,$filetempname)
{
    //自己设置的上传文件存放路径
    $filePath = 'upFile/';
    $str = "";
    //下面的路径按照你PHPExcel的路径来修改
    set_include_path('.'. PATH_SEPARATOR .__FILE__.'\PHPExcel' . PATH_SEPARATOR .get_include_path());

    require_once "setting.php";
    require_once 'PHPExcel.php';
    require_once 'PHPExcel\IOFactory.php';
    //require_once 'PHPExcel\Reader\Excel5.php';//excel 2003
    require_once 'PHPExcel\Reader\Excel2007.php';//excel 2007
    require_once 'PHPExcel\Shared\Date.php';

    $filename=explode(".",$file);//把上传的文件名以“.”好为准做一个数组。
    $time=date("y-m-d-H-i-s");//去当前上传的时间
    $filename[0]=$time;//取文件名t替换
    $name=implode(".",$filename); //上传后的文件名
    $uploadfile=$filePath.$name;//上传后的文件名地址


    //move_uploaded_file() 函数将上传的文件移动到新位置。若成功，则返回 true，否则返回 false。
    $result=move_uploaded_file($filetempname,$uploadfile);//假如上传到当前目录下
    if($result) //如果上传文件成功，就执行导入excel操作
    {
        //$objReader = PHPExcel_IOFactory::createReader('Excel5');//use excel2003
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');//use excel2003 和 2007 format
        //$objPHPExcel = $objReader->load($uploadfile); //这个容易造成httpd崩溃
        $objPHPExcel = PHPExcel_IOFactory::load($uploadfile);//改成这个写法就好了

        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow(); // 取得总行数
        $highestColumn = $sheet->getHighestColumn(); // 取得总列数

        //循环读取excel文件,读取一条,插入一条
        for($j=2;$j<=$highestRow;$j++) {
            for ($k = 'A'; $k <= $highestColumn; $k++) {
                //iconv('utf-8','gbk',$objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue()).'\\';//读取单元格
                if ($k == 'B') {
                    $str .= gmdate("Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue())) . '\\';
                } else {
                    $str .= $objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue() . '\\';
                }
            }

            //explode:函数把字符串分割为数组。
            $strs = explode("\\", $str);
            if($strs[0]!=''){
            //var_dump($strs);
            //die();
            $sql = "INSERT INTO `tbl_studentscore` (`ID`, `StuNum`, `Time`, `UserName`, `Score`, `Category`) VALUES (NULL, '" . $strs[0] . "', '" . $strs[1] . "', '" . $strs[2] . "', " . $strs[3] . ", NULL)";
            //echo $sql;
            mysqli_query($db, ' set names utf8');//这就是指定数据库字符集，一般放在连接数据库后面就系了
            if (!mysqli_query($db, $sql)) {
                echo $sql;
                echo "<br>";
                echo $strs[0];
                echo "<br>";
                echo $strs[1];
                echo "<br>";
                echo $strs[2];
                echo "<br>";
                echo $strs[3];
                echo "<br>";
                echo $str;
                echo "<br>";
                echo "err";
                return false;
            }
            $str = "";
        }
        }
        unlink($uploadfile); //删除上传的excel文件
        $msg = "导入成功！";
    }else{
        $msg = "导入失败！";
    }
    return $msg;
}
?>
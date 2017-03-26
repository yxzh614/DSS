<body>
<form  class="navbar-form navbar-left" action="search.php" method="post">
    <div class="form-group">
        <input type="hidden" class="form-control" name="target" value="<?php echo $_POST["num"]?>">
    </div>
    <input type="hidden" name="type" value="1">
    <input id="research" type="submit" name="submit" class="btn btn-default" value="搜索">
</form>
</body>
<?php
/**
 * Created by PhpStorm.
 * User: ak-hyeon-chal
 * Date: 17/3/24
 * Time: 19:47
 */if(!defined('IN_SYS')){
    define('IN_SYS',true);}

require_once ("setting.php");
if(isset($_POST["submit"])&&$_POST["submit"]) {
    ?>
    <script>
        alert("已删除。");
document.getElementById("research").click();
    </script>
    <?php
}else{

}
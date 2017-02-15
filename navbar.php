<?php
/**
 * Created by PhpStorm.
 * User: ak-hyeon-chal
 * Date: 17/1/18
 * Time: 17:33
 *
 */
require_once ("setting.php");
?>
<nav class="navbar navbar-default navbar navbar-fixed-top hidden-print" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">宿舍评分</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">管理 <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="admin.php?class=upfile">上传</a></li>
                        <li class="divider"></li>
                        <li><a href="admin.php?class=modify">修改</a></li>
                        <li class="divider"></li>
                        <li><a href="admin.php?class=count">统计</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">分类 <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="index.php?class=teacher">导员</a></li>
                        <li class="divider"></li>
                        <li><a href="index.php?class=grade">学院</a></li>
                        <li class="divider"></li>
                        <li><a href="index.php?class=building">宿舍楼</a></li>
                    </ul>
                </li>
            </ul>
            <form class="navbar-form navbar-left" role="search" action="search.php" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name="target" placeholder="支持学号、班级">
                </div>
                <input type="submit" name="submit" class="btn btn-default" value="搜索">
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php">退出</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_COOKIE['username']; ?>
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

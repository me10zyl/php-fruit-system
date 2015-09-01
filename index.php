<?php
/**
 * Created by PhpStorm.
 * User: ZyL
 * Date: 2015/8/24
 * Time: 15:21
 */
require_once 'class/bal/InformationBiz.class.php';
require_once 'class/bal/DepartmentBiz.class.php';
$currentPageSize = 8;
$departmentBiz = new DepartmentBiz();
$informationBiz = new InformationBiz();
$departments = $departmentBiz->getAll();
$informations = $informationBiz->getByPageViaPageSizeDesc(1,$currentPageSize);
?>
<htmL>
<head>
    <meta charset="utf-8" content="text/html">
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="bootstrap-3.3.5-dist/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row" style="position: relative">
        <div class="col-md-2">
            <img src="images/mc.jpg" height="150">
        </div>
        <div class="col-md-6" style="height: 150px;position: relative;left: -15px;">
            <form style="position: absolute;bottom: 0;">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for..." id="searchBox">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button" onclick="search()">搜索</button>
                </span>
                </div>
            </form>
        </div>
        <div class="col-md-4" style="height: 150px;position: relative;">
            <a href="console.php" style="position: absolute;bottom: 20px;right:15px;">后台管理</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-primary">
                <div class="panel-body" style="padding-top: 0px">
                    <div class="page-header" style="margin-top: 0px">
                        <h1 id="informationTitle">  <?php
                                echo $informations[0]->title;
                            ?>
                        </h1>
                    </div>
                    <div style="overflow: auto;height: 300px;">
                <pre id="informationContent">
                    <?php
                        echo $informations[0]->content;
                    ?>
                </pre>
                    </div>
                    <div style="float:right">类别：<span id="informationDepartment"><?php echo $informations[0]->department; ?></span></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-primary" style="height: 434px;overflow: auto">
                <div class="panel-heading">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" id="btnSelectDepartment">
                            所有团队 <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <?php
                            foreach($departments as $department)
                            {
                                echo '<li><a href="javascript:void(0)" onclick="selectDepartment(this)">'.$department->name.'</a></li>';
                            }
                            ?>
                            <li role="separator" class="divider"></li>
                            <li><a href="javascript:void(0)" onclick="selectDepartmentAll()">所有团队</a></li>
                        </ul>
                    </div>

                </div>
                <ul class="list-group" id="titleList">
                    <?php
                        foreach($informations as $information)
                        {
                            echo '<li class="list-group-item"><a href="javascript:void(0)"  data-department="'.$information->department.'" onclick="seeInformationDetail('.$information->id.')">'.$information->title.'</a></li>';
                        }
                    ?>
                    <li  id="more"><a href="javascirpt:void(0)" style="float: right;margin-top: 20px;" onclick="listMore()">更多...</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="js/jquery-1.11.3.min.js"></script>
    <script src="js/index.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
</body>
</htmL>
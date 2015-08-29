<?php
/**
 * Created by PhpStorm.
 * User: ZyL
 * Date: 2015/8/24
 * Time: 15:16
 */
?>
<htmL>
<head>
    <meta charset="utf-8" content="text/html">
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="bootstrap-3.3.5-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/console.css">
    <title>后台管理</title>
</head>
<body>
<div class="container zylcontainer">
    <div class="row">
        <div class="col-md-10"><h1>后台管理</h1></div>
        <div class="col-md-2">
            <button type="button" class="btn btn-default btn-lg" id="publishBtn">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> <span id="publishText">发布新的信息</span>
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title" id="panelTitle1">团队信息管理</h3>
                </div>
                <ul class="list-group">
                    <li class="list-group-item"><a href="javascript:void(0)">团队信息管理</a></li>
                    <li class="list-group-item"><a href="javascript:void(0)" onclick="seeDepartment()">团队类别管理</a></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading" id="panelTitle2">团队信息管理</div>

                <!-- Table -->
                <table class="table table-hover " id="consoleTable">
                    <tr>
                        <th>#</th>
                        <th>信息标题</th>
                        <th>所属团队</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>你好，你好</td>
                        <td>软件工程团队<span class="edit"><a href="javascript:void(0)">编辑</a>&nbsp;<a
                                    href="javascript:void(0)">删除</a></span></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Hello world</td>
                        <td>网络工程团队<span class="edit"><a href="javascript:void(0)">编辑</a>&nbsp;<a
                                    href="javascript:void(0)">删除</a></span></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>こんにちは</td>
                        <td>对日外包团队<span class="edit"><a href="javascript:void(0)">编辑</a>&nbsp;<a
                                    href="javascript:void(0)">删除</a></span></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>こんにちは</td>
                        <td>对日外包团队<span class="edit"><a href="javascript:void(0)">编辑</a>&nbsp;<a
                                    href="javascript:void(0)">删除</a></span></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>こんにちは</td>
                        <td>对日外包团队<span class="edit"><a href="javascript:void(0)">编辑</a>&nbsp;<a
                                    href="javascript:void(0)">删除</a></span></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>こんにちは</td>
                        <td>对日外包团队<span class="edit"><a href="javascript:void(0)">编辑</a>&nbsp;<a
                                    href="javascript:void(0)">删除</a></span></td>
                    </tr>
                </table>
                <nav style="position: relative" id="page">
                    <ul class="pagination" style="position: absolute;left:0;right: 0;">
                        <li>
                            <a href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li>
                            <a href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div style="position:relative;margin:80px 0 0;" id="publishContainer">
                <div class="panel panel-primary"
                     style="width: 800px;margin: 0 auto;position: absolute;left:0;bottom: 10px;z-index: 1111;"
                     id="publishBox">
                    <div class="panel-heading">添加新信息</div>
                    <div class="panel-body" style="margin: 0;padding-bottom: 10px;">
                        <form class="form-inline form" style="margin: 0 auto;">
                            <div class="form-group">
                                <input type="text" class="form-control" id="exampleInputName2" placeholder="信息标题">
                                <select class="form-control" style="float:right">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                                <br><br>
                                <textarea rows="3" cols="100" class="form-control"
                                          placeholder="信息内容"></textarea><br><br>
                                <button type="submit" class="btn btn-primary">提交</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
<script src="js/jquery-1.11.3.min.js"></script>
<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
<script src="js/console.js"></script>
</body>
</htmL>
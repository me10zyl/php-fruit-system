<?php
/**
 * Created by PhpStorm.
 * User: ZyL
 * Date: 2015/8/24
 * Time: 15:22
 */
require_once('class/bll/InformationBiz.class.php');
require_once('class/bll/DepartmentBiz.class.php');
$id = $_GET['id'];
$informationBiz = new InformationBiz();
$information = $informationBiz->get($id);
$departmentBiz = new DepartmentBiz();
$departments = $departmentBiz->getAll();
?>
<htmL>
<head>
    <meta charset="utf-8" content="text/html">
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="bootstrap-3.3.5-dist/css/bootstrap.min.css">

    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="js/jquery-1.11.3.min.js"></script>

    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-2"><a href="#" class="thumbnail">
                <img src="images/mc.jpg" alt="...">
            </a></div>
    </div>
    <div class="panel panel-default">
        <div>
            <ol class="breadcrumb">
                <li><a href="index.php">首页</a></li>
                <li><a href="console.php">后台</a></li>
                <li class="active">详细信息</li>
            </ol>
        </div>
        <div class="panel-body" style="padding-top: 0px">
            <div class="page-header" style="margin-top: 0px">
                <h1><span id="informationTitle"><?php echo $information->title ?></span>
                    <small><a href="javascript:void(0)" onclick="editInformationTitle()"> 编辑</a></small>
                </h1>
            </div>
            <div style="overflow: auto;height: 300px;">
                <pre id="informationContent">
<?php echo $information->content ?>
                </pre>
                <div style="float: right"><a href="javascript:void(0)" onclick="editInformationContent()"> 编辑</a></div>
            </div>

            <div style="float:right">类别： <input id="informationDepartmentId" type="hidden"
                                                value="<?php echo $information->id ?>"><span
                    id="informationDepartment"><?php echo $information->department ?></span><a href="javascript:void(0)"
                                                                                               onclick="editInformationDepartment()">
                    编辑</a></div>
        </div>
    </div>
    <script>
        var isEditing = false;
        var oldHtml;
        var $query;
        function editInformationTitle() {
            if (isEditing) {
                return;
            }
            isEditing = true;
            $query = $("#informationTitle");
            oldHtml = $query.html();
            $query.html("<input type='text'><button type='button' class='btn btn-primary btn-sm' style='margin-left: 10px;' onclick='confirmInformationTitle(<?php echo $information->id?>)'>确定</button><button type='button' class='btn btn-default btn-sm' style='margin-left: 10px;' onclick='cancelEdit()'>取消</button>");
            $query.next().remove();
        }

        function editInformationContent() {
            if (isEditing) {
                return;
            }
            isEditing = true;
            $query = $("#informationContent");
            oldHtml = $query.html();
            $query.html("<textarea type='text'resize='none' style='width:" + ($query.width()) + "px;height:" + $query.height() + "px'></textarea><br><button type='button' class='btn btn-primary btn-sm' style='margin-top: 10px;' onclick='confirmInformationContent(<?php echo $information->id?>)'>确定</button><button type='button' class='btn btn-default btn-sm' style='margin-top: 10px;margin-left:10px;' onclick='cancelEdit()'>取消</button>");
            $query.next().remove();
        }
        function confirmInformationContent(id) {
            var content = $query.children("textarea").val();
            if (!content) {
                cancelEdit();
                return;
            }
            $.ajax({
                url: "restful/information.php/edit",
                type: "POST",
                data: "id=" + id + "&title=&content=" + content + "&time=&department=",
                success: function (data) {
                    var json = JSON.parse(data);
                    if (json.result) {
                        seeInformationDetail(id);
                    } else {
                        alert(json.msg);
                    }
                }
            })
        }

        function confirmInformationTitle(id) {
            var title = $query.children("input").val();
            if (!title) {
                cancelEdit();
                return;
            }
            $.ajax({
                url: "restful/information.php/edit",
                type: "POST",
                data: "id=" + id + "&title=" + title + "&content=&time=&department=",
                success: function (data) {
                    var json = JSON.parse(data);
                    if (json.result) {
                        seeInformationDetail(id);
                    } else {
                        alert(json.msg);
                    }
                }
            })
        }
        function cancelEdit() {
            $query.html(oldHtml);
            appendEditAnchor();
        }
        function appendEditAnchor() {
            isEditing = false;
            if ($query.selector == "#informationTitle") {
                $query.parent().append("<small><a href='javascript:void(0)' onclick='editInformationTitle()'> 编辑</a></small>");
            } else if ($query.selector == "#informationContent") {
                $query.parent().append("<div style='float: right'><a href='javascript:void(0)' onclick='editInformationContent()'> 编辑</a></div>");
            } else if ($query.selector == "#informationDepartment") {
                $query.parent().append("<a href=javascript:void(0) onclick=editInformationDepartment()> 编辑</a>");
            }
        }


        function editInformationDepartment() {
            if (isEditing) {
                return;
            }
            isEditing = true;
            $query = $("#informationDepartment");
            oldHtml = $query.html();
            var code = "";
            code += '<select>';
            <?php
                foreach($departments as $department)
                {
                    $id = $department->id;
                    $name = $department->name;
                    echo "\t\t\tcode += '<option value=\"$id\">$name</option>';\n";
                }
            ?>
            code += '</select>';
            $query.html(code + "<button type='button' class='btn btn-primary btn-sm' style='margin-left: 10px;' onclick='confirmInformationDepartment(<?php echo $information->id?>)'>确定</button><button type='button' class='btn btn-default btn-sm' style='margin-left: 10px;' onclick='cancelEdit()'>取消</button>");
            $query.next().remove();
        }
        function confirmInformationDepartment(id)
        {
            var department = $query.children("select").val();
            if (!department) {
                cancelEdit();
                return;
            }
            $.ajax({
                url: "restful/information.php/edit",
                type: "POST",
                data: "id=" + id + "&title=&content=&time=&department="+department,
                success: function (data) {
                    var json = JSON.parse(data);
                    if (json.result) {
                        seeInformationDetail(id);
                    } else {
                        alert(json.msg);
                    }
                }
            })
        }
        function seeInformationDetail(id) {
            $.ajax({
                url: "restful/information.php/get",
                type: "POST",
                data: "id=" + id,
                success: function (data) {
                    var information = JSON.parse(data);
                    if ($query.selector == "#informationTitle") {
                        $("#informationTitle").html(information.title);
                    } else if ($query.selector == "#informationContent") {
                        $("#informationContent").text(information.content);
                    } else if ($query.selector == "#informationDepartment") {
                        $("#informationDepartment").text(information.department);
                    }
                    appendEditAnchor();
                }
            })
        }
    </script>
</div>
</body>
</htmL>


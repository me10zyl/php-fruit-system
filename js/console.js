/**
 * Created by ZyL on 2015/8/26.
 */
$(function () {
    var consoleTable = $("#consoleTable");
    var appear = false;
    $("#publishBtn").click(function () {
        if (appear) {
            $("#publishBox").slideToggle("normal", function () {
                $("#publishContainer").css({"height": "0px"});
            });
        } else {
            $("#publishContainer").css({"height": $("#publishBox").height()});
            $("#publishBox").slideToggle("normal");
        }
        appear = !appear;
    })
})
var globalPage;
function seeDepartment(refeshPart, page) {
    $.ajax({
        url: "restful/department.php/list",
        type: "POST",
        data: page ? "page=" + page : "page=1",
        success: function (data) {
            globalPage = page ? page : page = 1;
            var json = JSON.parse(data);
            var consoleTable = $("#consoleTable");
            consoleTable.html("<tr> <th>#</th> <th>部门名称</th> </tr>")
            $('#panelTitle1').text("团队类别管理");
            $('#panelTitle2').text("团队类别管理");
            for (var i = 0; i < json.list.length; i++) {
                consoleTable.append("<tr><td>" + ((page - 1) * json.pageSize + i + 1) + "</td><td><span class='departmentName'>" + json.list[i].name + "</span><span class='edit'><a href='javascript:void(0)' onclick='editDepartment(" + i + "," + json.list[i].id + ",\"" + json.list[i].name + "\")'>编辑</a>&nbsp;<a href='javascript:void(0)' onclick='deleteDepartment(" + i + "," + json.list[i].id +")'>删除</a></span></td></tr>");
            }
            refreshPage(json.page, json.totalPage);
            if (!refeshPart) {
                $("#publishText").text("添加新团队");
                $("#publishContainer").load("snippets/addNewDepartment.html");
            }
            //consoleTable.parent().parent().append('<span>haha</span>')
        }
    })
}


function refreshPage(page, totalPage) {
    $("#page").load("snippets/page.php", {"page": page, "totalPage": totalPage})
}

function editDepartment(index, id, departmentName) //第几个 数据库id 部门名称
{
    $(".departmentName").eq(index).html("<input type='text'placeholder='" + departmentName + "'><button type='button' class='btn btn-primary btn-sm' style='margin-left: 10px;' onclick='confirmEditDepartment(" + index + "," + id + ")'>确定</button><button type='button' class='btn btn-default btn-sm' style='margin-left: 10px;' onclick='cancelEditDepartment(" + index + ",\"" + departmentName + "\")'>取消</button>");
}
function deleteDepartment(index,id)
{
    $.ajax({
        url: "restful/department.php/delete",
        type: "POST",
        data: "id=" + id,
        success: function (data) {
            var json = JSON.parse(data);
            if (json.result) {
                seeDepartment(1,globalPage);
            }else{
                alert(json.msg);
            }
        }
    })
}
function confirmEditDepartment(index, id) {
    var newDepartmentName = $(".departmentName").eq(index).children("input").val();
    if (!newDepartmentName) {
        cancelEditDepartment(index, $(".departmentName").eq(index).children("input").attr("placeholder"))
        return;
    }
    $.ajax({
        url: "restful/department.php/edit",
        type: "POST",
        data: "id=" + id + "&departmentName=" + newDepartmentName,
        success: function (data) {
            var json = JSON.parse(data);
            if (json.result) {
                seeDepartment(1,globalPage);
            }else{
                alert(json.msg);
            }
        }
    })
}

function cancelEditDepartment(index, departmentName) {
    $(".departmentName").eq(index).html(departmentName);
}
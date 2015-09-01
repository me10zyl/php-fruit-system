$(function () {
})
var page = 1;
var pageSize = 8;
var totalPage;
function listTitles() {

}

function listDepartments() {

}

function selectDepartment(a){
    $("#titleList li").each(function(){
        $("#btnSelectDepartment").html(a.innerHTML+'<span class="caret"></span>');
        if($(this).children("a").data("department") != a.innerHTML && $(this).attr("id") != "more")
        {
            $(this).hide();
        }else{
            $(this).show();
        }
    });
}

function selectDepartmentAll(){
    $("#btnSelectDepartment").html('所有团队<span class="caret"></span>');
    $("#titleList li").each(function(){
        $("#titleList li").show();
    })
}

function listMore() {
    page = page + 1;
    $.ajax({
        url: "restful/information.php/list",
        type: "POST",
        data: "page=" + page + "&pageSize=" + pageSize+"&reverse=true",
        success: function (data) {
            var json = JSON.parse(data);
            var more = $('#more');
            totalPage = json.totalPage;
            for (var i = 0; i < json.list.length; i++) {
                more.before('<li class="list-group-item"><a href="javascript:void(0)"  onclick="seeInformationDetail('+json.list[i].id+')">'+json.list[i].title+'</a></li>');
            }
            if(page + 1 > totalPage)
            {
                $('#more').remove();
            }
        }
    })
}

function search(){
    if($("#searchBox").val() == "")
    {
        $.ajax({
            url: "restful/information.php/list",
            type: "POST",
            data: "page=1&pageSize=" + pageSize+"&reverse=true",
            success: function (data) {
                var json = JSON.parse(data);
                var titleList = $('#titleList');
                totalPage = json.totalPage;
                titleList.html("");
                for (var i = 0; i < json.list.length; i++) {
                    titleList.append('<li class="list-group-item"><a href="javascript:void(0)"  onclick="seeInformationDetail('+json.list[i].id+')">'+json.list[i].title+'</a></li>');
                }
                titleList.append('<li  id="more"><a href="javascirpt:void(0)" style="float: right;margin-top: 20px;" onclick="listMore()">更多...</a></li>');
                page = 1;
            }
        })
        return;
    }
    $.ajax({
        url: "restful/information.php/search",
        type: "POST",
        data: "key="+$("#searchBox").val(),
        success: function (data) {
            var json = JSON.parse(data);
            if(json.list.length > 0 )
            {
                $("#titleList").html("");
            }
            for (var i = 0; i < json.list.length; i++) {
                $("#titleList").append('<li class="list-group-item"><a href="javascript:void(0)"  onclick="seeInformationDetail('+json.list[i].id+')">'+json.list[i].title+'</a></li>');
            }
        }
    })
    //$("#titleList").html();
}

function seeInformationDetail(id) {
    $.ajax({
        url: "restful/information.php/get",
        type: "POST",
        data: "id=" + id,
        success: function (data) {
            var information = JSON.parse(data);
            $("#informationTitle").text(information.title);
            $("#informationContent").text(information.content);
            $("#informationDepartment").text(information.department);
        }
    })
}
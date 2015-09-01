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
<ul class="pagination" style="position: absolute;left:0;right: 0;">
    <?php
    /**
     * Created by PhpStorm.
     * User: ZyL
     * Date: 2015/8/28
     * Time: 10:05
     */
    $totalPage = $_POST['totalPage'];
    $page = $_POST['page'];
    if($page != 1)
    {
        echo "<li><a href=\"javascript:void(0)\" onclick=\"seeDepartment(1,".($page - 1).")\" aria-label=\"Previous\"><span aria-hidden=\"true\">&laquo;</span></a></li>";
    }
    for($i = 1;$i <= $totalPage;$i++)
    {
        echo "<li ";
        echo  $page == $i ? "class=\"active\"": "";
        echo"><a href=\"javascript:void(0)\" onclick=\"seeDepartment(1,$i)\">$i</a></li>";
    }
    if($page != $totalPage)
    {
        echo  "<li><a href=\"javascript:void(0)\" onclick=\"seeDepartment(1,".($page + 1).")\" aria-label=\"Next\"><span aria-hidden=\"true\">&raquo;</span></a></li>";
    }
    ?>
   
</ul>

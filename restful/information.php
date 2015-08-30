<?php
/**
 * Created by PhpStorm.
 * User: ZyL
 * Date: 2015/8/26
 * Time: 17:04
 */
require_once(dirname(__FILE__) . '/../class/bal/InformationBiz.class.php');
require_once('Message.class.php');
require_once('restfulUtil.php');
require_once(dirname(__FILE__) . '/../class/dal/entity/Department.class.php');
$currentFileName = basename(__FILE__);
$pathInfo = getPathInfo($currentFileName);
$informationBiz = new InformationBiz();
switch ($pathInfo) {
    case 'list':
        $page = $_POST['page'];
        if (isset($page) && !empty($page)) {
            $totalPage = $informationBiz->totalPage();
            $pageSize = $informationBiz->pageSize();
            print "{\"page\":$page,\"totalPage\":$totalPage,\"pageSize\":$pageSize,\"list\":";
            print json_encode($informationBiz->getByPage($page));
            print "}";
        } else {
            print json_encode($informationBiz->getAll());
        }
        break;
    case 'addition':
        $title = $_POST['title'];
        $content = $_POST['content'];
        $department_id = $_POST['department_id'];
        $msg = new Message();
        if(empty($title))
        {
            print "{\"result\":false,\"msg\":\"标题不能为空\"}";
            return;
        }
        if(empty($content))
        {
            $msg->result = false;
            $msg->msg ="内容不能为空";
            print json_encode($msg);
            return;
        }
        if(empty($department_id))
        {
            $msg->result = false;
            $msg->msg ="团队不能为空";
            print json_encode($msg);
            return;
        }
        $information = new Information();
        $information->title = $title;
        $information->content = $content;
        $information->department = new Department("no use",$department_id);
        $res = $informationBiz->add($information);
        if ($res) {
            print "{\"result\":true,\"msg\":\"添加成功\"}";
        } else {
            print "{\"result\":false,\"msg\":\"添加失败\"}";
        }
        break;
    case 'edit':
        $id = $_POST['id'];
        $departmentName = $_POST['departmentName'];
        $msg = new Message();
        if (isset($id) && !empty($id) && isset($departmentName) && !empty($departmentName)) {
            $newDepartment = new Department($departmentName, $id);
            $res = $informationBiz->edit($newDepartment);
            if ($res) {
                $msg->result = true;
                $msg->msg = '编辑成功';
                print json_encode($msg);
            } else {
                $msg->result = false;
                $msg->msg = '编辑失败';
                print json_encode($msg);
            }
        } else {
            $msg->result = false;
            $msg->msg = '编辑失败';
            print json_encode($msg);
        }
        break;
    case 'delete':
        $id = $_POST['id'];
        $msg = new Message();
        if (isset($id) && !empty($id)) {
            $res = $informationBiz->delete($id);
            if ($res) {
                $msg->result = true;
                $msg->msg = '删除成功';
                print json_encode($msg);
            } else {
                $msg->result = false;
                $msg->msg = '删除失败';
                print json_encode($msg);
            }
        } else {
            $msg->result = false;
            $msg->msg = '删除失败';
            print json_encode($msg);
        }
        break;
    default:
        break;
}
?>
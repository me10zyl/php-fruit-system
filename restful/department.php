<?php
/**
 * Created by PhpStorm.
 * User: ZyL
 * Date: 2015/8/26
 * Time: 17:04
 */
require_once(dirname(__FILE__) . '/../class/bll/DepartmentBiz.class.php');
require_once('Message.class.php');
require_once('restfulUtil.php');
$currentFileName = basename(__FILE__);
$pathInfo = getPathInfo($currentFileName);
$departmentBiz = new DepartmentBiz();
switch ($pathInfo) {
    case 'list':
        $page = $_POST['page'];
        if (isset($page) && !empty($page)) {
            $totalPage = $departmentBiz->totalPage();
            $pageSize = $departmentBiz->pageSize();
            print "{\"page\":$page,\"totalPage\":$totalPage,\"pageSize\":$pageSize,\"list\":";
            print json_encode($departmentBiz->getByPage($page));
            print "}";
        } else {
            print "{\"list\":";
            print json_encode($departmentBiz->getAll());
            print "}";
        }
        break;
    case 'addition':
        $departmentName = $_POST['departmentName'];
        if (!empty($departmentName)) {
            $department = new Department($departmentName);
            $res = $departmentBiz->add($department);
            if ($res) {
                print "{\"result\":true,\"msg\":\"添加成功\"}";
            } else {
                print "{\"result\":false,\"msg\":\"添加失败\"}";
            }
        } else {
            print "{\"result\":false,\"msg\":\"团队名称不能为空\"}";
        }
        break;
    case 'edit':
        $id = $_POST['id'];
        $departmentName = $_POST['departmentName'];
        $msg = new Message();
        if (isset($id) && !empty($id) && isset($departmentName) && !empty($departmentName)) {
            $newDepartment = new Department($departmentName, $id);
            $res = $departmentBiz->edit($newDepartment);
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
            $res = $departmentBiz->delete($id);
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
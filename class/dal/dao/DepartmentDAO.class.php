<?php
/**
 * Created by PhpStorm.
 * User: ZyL
 * Date: 2015/8/26
 * Time: 14:03
 */
require_once('SqlHelper.class.php');
require_once('DAO.class.php');
require_once(__DIR__.'/../entity/Department.class.php');
class DepartmentDAO extends DAO{
    var $pageSize = 6;
    function add($department){
        $row = SqlHelper::executeRows("INSERT INTO department VALUES (null,'$department->name');");
        return $row;
    }
    function del($department){
        $row = SqlHelper::executeRows("DELETE FROM department WHERE id = $department->id;");
        return $row;
    }
    function get($id){
        $departments = SqlHelper::executeObject("select * from department where id = $id");
        if(count($departments) > 0)
        {
            return $departments[0];
        }
        return null;
    }

    function getByPage($page)
    {
        $offset = ($page - 1) * $this->pageSize;
        $departments = SqlHelper::executeObject("select * from department limit $offset, $this->pageSize");
        return $departments;
    }

    function count()
    {
        $count = SqlHelper::executeObject("select count(*) total from department");
        return $count[0]->total;
    }

    function countPage()
    {
        return ceil($this->count() / $this->pageSize);
    }
    function getAll(){
        $departments = SqlHelper::executeObject("select * from department");
        return $departments;
    }
    function update($newDepartment){
        $id = $newDepartment->id;
        $name = $newDepartment->name;
        $row = SqlHelper::executeRows("UPDATE department SET name = '$name' WHERE id = $id;");
        return $row;
    }
}
//$department = new Department(null,8);
//$departmentDAO = new DepartmentDAO();
//var_dump($departmentDAO->get(8));
//$departments = $departmentDAO->getAll();
//foreach($departments as $department)
//{
//    echo $department->name;
//}
//$departmentDAO->add($department);
<?php
/**
 * Created by PhpStorm.
 * User: ZyL
 * Date: 2015/8/26
 * Time: 14:03
 */
require('../entity/Department.class.php');
require('../SqlHelper.class.php');
class DepartmentDAO {
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
    function getAll(){
        $departments = SqlHelper::executeObject("select * from department");
        return $departments;
    }
    function save($department){

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
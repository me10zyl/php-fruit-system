<?php
/**
 * Created by PhpStorm.
 * User: ZyL
 * Date: 2015/8/25
 * Time: 11:22
 */

class InformationDAO {
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
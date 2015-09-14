<?php
/**
 * Created by PhpStorm.
 * User: ZyL
 * Date: 2015/8/26
 * Time: 16:59
 */
require_once(dirname(__FILE__).'/../dal/dao/DepartmentDAO.class.php');
require_once('Biz.class.php');
class DepartmentBiz extends Biz{
    var $depatmentDAO;
    function __construct(){
        $this->depatmentDAO = new DepartmentDAO();
    }
    function getAll(){
        $departments = $this->depatmentDAO->getAll();
        return $departments;
    }
    function add($department){
        return $this->depatmentDAO->add($department);
    }
    function getByPage($page){
        $departments = $this->depatmentDAO->getByPage($page);
        return $departments;
    }
    function edit($newUser)
    {
        return $this->depatmentDAO->update($newUser);
    }
    function count(){
        return $this->depatmentDAO->count();
    }
    function totalPage(){
        return $this->depatmentDAO->countPage();
    }
    function pageSize(){
        return $this->depatmentDAO->pageSize;
    }
    function delete($id)
    {
        return $this->depatmentDAO->del(new Department('no use',$id));
    }
}
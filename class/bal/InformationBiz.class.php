<?php
/**
 * Created by PhpStorm.
 * User: ZyL
 * Date: 2015/8/26
 * Time: 16:59
 */
require_once(dirname(__FILE__).'/../dal/dao/InformationDAO.class.php');
class InformationBiz {
    var $informationDAO;
    function __construct(){
        $this->informationDAO = new InformationDAO();
    }
    function getAll(){
        $departments = $this->informationDAO->getAll();
        return $departments;
    }
    function add($department){
        return $this->informationDAO->add($department);
    }
    function getByPage($page){
        $departments = $this->informationDAO->getByPage($page);
        return $departments;
    }
    function edit($newInformation)
    {
        return $this->informationDAO->update($newInformation);
    }
    function count(){
        return $this->informationDAO->count();
    }
    function totalPage(){
        return $this->informationDAO->countPage();
    }
    function pageSize(){
        return $this->informationDAO->pageSize;
    }
    function delete($id)
    {
        $information = new Information();
        $information->id = $id;
        return $this->informationDAO->del($information);
    }
}
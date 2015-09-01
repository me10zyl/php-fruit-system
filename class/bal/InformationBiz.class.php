<?php
/**
 * Created by PhpStorm.
 * User: ZyL
 * Date: 2015/8/26
 * Time: 16:59
 */
require_once(dirname(__FILE__) . '/../dal/dao/InformationDAO.class.php');

class InformationBiz
{
    var $informationDAO;

    function __construct()
    {
        $this->informationDAO = new InformationDAO();
    }

    function getAll()
    {
        $departments = $this->informationDAO->getAll();
        return $departments;
    }

    function add($department)
    {
        return $this->informationDAO->add($department);
    }

    function getByPage($page)
    {
        $departments = $this->informationDAO->getByPage($page);
        return $departments;
    }

    function getByPageViaPageSize($page, $pageSize)
    {
        $departments = $this->informationDAO->getByPageViaPageSize($page, $pageSize);
        return $departments;
    }

    function getByPageViaPageSizeDesc($page, $pageSize)
    {
        $departments = $this->informationDAO->getByPageViaPageSizeDesc($page, $pageSize);
        return $departments;
    }

    function searchByPageViaPageSize($key,$page,$pageSize)
    {
        return $this->informationDAO->searchByPageViaPageSize($key,$page,$pageSize);
    }

    function search($key){
        return $this->informationDAO->search($key);
    }

    function edit($newInformation)
    {
        return $this->informationDAO->update($newInformation);
    }

    function count()
    {
        return $this->informationDAO->count();
    }

    function totalPage()
    {
        return $this->informationDAO->countPage();
    }

    function pageSize()
    {
        return $this->informationDAO->pageSize;
    }

    function get($id)
    {
        return $this->informationDAO->get($id);
    }

    function delete($id)
    {
        $information = new Information();
        $information->id = $id;
        return $this->informationDAO->del($information);
    }
}
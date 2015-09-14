<?php
/**
 * Created by PhpStorm.
 * User: ZyL
 * Date: 2015/9/14
 * Time: 19:44
 */
require_once(dirname(__FILE__) . '/../dal/dao/UserDAO.class.php');
require_once('Biz.class.php');
class UserBiz extends Biz{
    var $userDAO;
    function __construct(){
        $this->userDAO = new UserDAO();
    }
    function getAll(){
        $users = $this->userDAO->getAll();
        return $users;
    }
    function add($user){
        return $this->userDAO->add($user);
    }
    function getByPage($page){
        $users = $this->userDAO->getByPage($page);
        return $users;
    }
    function edit($newUser)
    {
        return $this->userDAO->update($newUser);
    }
    function count(){
        return $this->userDAO->count();
    }
    function totalPage(){
        return $this->userDAO->countPage();
    }
    function pageSize(){
        return $this->userDAO->pageSize;
    }
    function delete($id)
    {
        return $this->userDAO->del($id);
    }
} 
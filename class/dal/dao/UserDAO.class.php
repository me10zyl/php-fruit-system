<?php
/**
 * Created by PhpStorm.
 * User: ZyL
 * Date: 2015/9/14
 * Time: 19:35
 */

class UserDAO extends DAO{
    var $pageSize = 6;
    function add($user){
        $row = SqlHelper::executeRows("INSERT INTO user VALUES (null,'$user->name','$user->password');");
        return $row;
    }
    function del($id){
        $row = SqlHelper::executeRows("DELETE FROM user WHERE id = $id;");
        return $row;
    }
    function get($id){
        $users = SqlHelper::executeObject("select * from user where id = $id");
        if(count($users) > 0)
        {
            return $users[0];
        }
        return null;
    }

    function getByPage($page)
    {
        $offset = ($page - 1) * $this->pageSize;
        $users = SqlHelper::executeObject("select * from user limit $offset, $this->pageSize");
        return $users;
    }

    function count()
    {
        $count = SqlHelper::executeObject("select count(*) total from user");
        return $count[0]->total;
    }

    function countPage()
    {
        return ceil($this->count() / $this->pageSize);
    }
    function getAll(){
        $users = SqlHelper::executeObject("select * from user");
        return $users;
    }
    function update($newuser){
        $id = $newuser->id;
        $name = $newuser->name;
        $password = $newuser->password;
        $row = SqlHelper::executeRows("UPDATE user SET name = '$name',password = '$password' WHERE id = $id;");
        return $row;
    }
}
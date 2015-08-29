<?php
/**
 * Created by PhpStorm.
 * User: ZyL
 * Date: 2015/8/25
 * Time: 11:22
 */

require_once('DAO.class.php');
require_once('SqlHelper.class.php');
require_once(__DIR__.'/../entity/Information.class.php');
class InformationDAO extends DAO
{
    var  $pageSize = 6;
    function add($information)
    {
        $title = $information->title;
        $content = $information->content;
        $time = $information->time;
        $department_id= $information->department->id;
        $row = SqlHelper::executeRows("INSERT INTO information(id,title,content,time,department_id)VALUES(null,,$title,$content,$time,$department_id);");
        return $row;
    }

    function del($information){
        $row = SqlHelper::executeRows("DELETE FROM $information WHERE id = $information->id;");
        return $row;
    }
    function get($id){
        $informations = SqlHelper::executeObject("select * from information where id = $id");
        if(count($informations) > 0)
        {
            return $informations[0];
        }
        return null;
    }

    function getByPage($page)
    {
        $offset = ($page - 1) * $this->pageSize;
        $informations = SqlHelper::executeObject("select * from information limit $offset, $this->pageSize");
        return $informations;
    }

    function count()
    {
        $count = SqlHelper::executeObject("select count(*) total from information");
        return $count[0]->total;
    }

    function countPage()
    {
        return ceil($this->count() / $this->pageSize);
    }
    function getAll(){
        $informations = SqlHelper::executeObject("select * from information");
        return $informations;
    }
    function update($newInformation){
        $id = $newInformation->id;
        $title = $newInformation->title;
        $content = $newInformation->content;
        $time = $newInformation->$time;
        $department = $newInformation->department;
        $sql = 'UPDATE information SET';
        if(isset($title))
        {
            $sql = $sql."title = '$title'";
        }
        if(isset($content))
        {
            $sql = $sql.",content = '$content''";
        }
        if(isset($time))
        {
            $sql = $sql.",time = '$time'";
        }
        if(isset($department))
        {
            if(isset($department->department_id))
            {
                $sql = $sql.',department_id = '.$department->department_id;
            }
        }
        $sql = $sql." WHERE id = $id";
        $row = SqlHelper::executeRows($sql);
        return $row;
    }
}
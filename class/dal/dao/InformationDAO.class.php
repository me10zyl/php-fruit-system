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
        $department_id= $information->department->id;
        $row = SqlHelper::executeRows("INSERT INTO information(id,title,content,time,department_id)VALUES(null,'$title','$content',now(),$department_id);");
        return $row;
    }

    function del($information){
        $row = SqlHelper::executeRows("DELETE FROM information WHERE id = $information->id;");
        return $row;
    }
    function get($id){
        $informations = SqlHelper::executeObject("select i.id,i.title,i.content,i.time,d.name department from information i join department d on i.department_id = d.id where i.id = $id");
        if(count($informations) > 0)
        {
            return $informations[0];
        }
        return null;
    }

    function getByPageViaPageSize($page,$pageSize)
    {
        $offset = ($page - 1) * $pageSize;
        $informations = SqlHelper::executeObject("select i.id,i.title,i.content,i.time,d.name department from information i join department d on i.department_id = d.id order by time limit $offset, $pageSize");
        return $informations;
    }

    function searchByPageViaPageSize($key,$page,$pageSize)
    {
        $offset = ($page - 1) * $pageSize;
        $informations = SqlHelper::executeObject("select i.id,i.title,i.content,i.time,d.name department from information i join department d on i.department_id = d.id  where i.title like '%$key%' order by time desc limit $offset, $pageSize;");
        return $informations;
    }

    function search($key)
    {
        return SqlHelper::executeObject("select i.id,i.title,i.content,i.time,d.name department from information i join department d on i.department_id = d.id where i.title like '%$key%' order by time desc ;");
    }

    function getByPageViaPageSizeDesc($page,$pageSize)
    {
        $offset = ($page - 1) * $pageSize;
        $informations = SqlHelper::executeObject("select i.id,i.title,i.content,i.time,d.name department from information i join department d on i.department_id = d.id order by time desc limit $offset, $pageSize");
        return $informations;
    }

    function getByPage($page)
    {
        return $this->getByPageViaPageSize($page,$this->pageSize);
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
        $informations = SqlHelper::executeObject("select i.id,i.title,i.content,i.time,d.name department from information i join department d on i.department_id = d.id order by time;");
        return $informations;
    }
    function update($newInformation){
        $id = $newInformation->id;
        $title = $newInformation->title;
        $content = $newInformation->content;
        $time = $newInformation->time;
        $department = $newInformation->department;
        $sql = 'UPDATE information SET ';
        $isFirstSnippet = true;
        if(!empty($title))
        {
            $sql = $sql."title = '$title'";
            $isFirstSnippet = false;
        }
        if(!empty($content))
        {
            if(!$isFirstSnippet)
            {
                $sql = $sql.',';
            }
            $sql = $sql."content = '$content'";
            $isFirstSnippet = false;
        }
        if(!empty($time))
        {
            if(!$isFirstSnippet)
            {
                $sql = $sql.',';
            }
            $sql = $sql."time = '$time'";
            $isFirstSnippet = false;
        }
        if(!empty($department))
        {
            if(!empty($department->id))
            {
                if(!$isFirstSnippet)
                {
                    $sql = $sql.',';
                }
                $sql = $sql.'department_id = '.$department->id;
                $isFirstSnippet = false;
            }
        }
        $sql = $sql." WHERE id = $id";
        $row = SqlHelper::executeRows($sql);
        return $row;
    }
}
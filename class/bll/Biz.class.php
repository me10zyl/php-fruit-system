<?php
/**
 * Created by PhpStorm.
 * User: ZyL
 * Date: 2015/9/14
 * Time: 19:45
 */

abstract class Biz {
    abstract  function getAll();
    abstract function add($entity);
    abstract function getByPage($page);
    abstract function edit($newEntity);
    abstract function count();
    abstract function totalPage();
    abstract function pageSize();
    abstract function delete($id);
} 
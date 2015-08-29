<?php
/**
 * Created by PhpStorm.
 * User: ZyL
 * Date: 2015/8/26
 * Time: 17:19
 */

abstract class DAO{
    abstract protected function add($entity);
    abstract protected function del($id);
    abstract  protected function get($id);
    abstract  protected  function getAll();
    abstract  protected  function getByPage($page);
    abstract  protected  function count();
    abstract  protected  function countPage();
    abstract  protected  function update($newEntity);
}
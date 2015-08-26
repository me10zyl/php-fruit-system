<?php
/**
 * Created by PhpStorm.
 * User: ZyL
 * Date: 2015/8/26
 * Time: 14:02
 */

class Department {
    var $id;
    var $name;
    public function Department($name,$id=null){
        $this->id = $id;
        $this->name = $name;
    }
}
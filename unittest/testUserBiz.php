<?php
/**
 * Created by PhpStorm.
 * User: ZyL
 * Date: 2015/9/14
 * Time: 19:54
 */
require_once(__DIR__.'/../class/classAutoLoader.php');
$userBiz = new UserBiz();
$user = new User();
$user->name = 'hah';
$user->password = '12323232221';
$id = 2;
//echo $userBiz->add($user);
$user->id = $id;
//echo $userBiz->edit($user);
echo $userBiz->delete($id);
?>
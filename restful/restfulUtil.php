<?php
/**
 * Created by PhpStorm.
 * User: ZyL
 * Date: 2015/8/27
 * Time: 9:50
 */
function getPathInfo($currentFileName)
{
    $matchSuccess = preg_match_all("/$currentFileName\\/(.+)/", $_SERVER['PHP_SELF'], $matches);
    if ($matchSuccess) {
//        print '<pre>';
//        print_r($matches);
        return $matches[1][0];
    }
}
?>
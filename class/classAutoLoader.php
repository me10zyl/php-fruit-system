<?php
/**
 * Created by PhpStorm.
 * User: ZyL
 * Date: 2015/9/14
 * Time: 20:00
 */
   // set_include_path(__DIR__.DIRECTORY_SEPARATOR.'bll'.PATH_SEPARATOR .get_include_path());
    function my_autoloader($className)
    {
        $array = array();
        $array[] = __DIR__.DIRECTORY_SEPARATOR.'bll'.DIRECTORY_SEPARATOR;
        $array[] = __DIR__.DIRECTORY_SEPARATOR.'dal'.DIRECTORY_SEPARATOR.'dao'.DIRECTORY_SEPARATOR;
        $array[] = __DIR__.DIRECTORY_SEPARATOR.'dal'.DIRECTORY_SEPARATOR.'entity'.DIRECTORY_SEPARATOR;
        foreach($array as $path)
        {
            if (file_exists($path .$className. '.class.php')) {
               require_once($path .$className. '.class.php');
            }else{
               // exit('nofile');
            }
        }
    }
    spl_autoload_register('my_autoloader');
?>
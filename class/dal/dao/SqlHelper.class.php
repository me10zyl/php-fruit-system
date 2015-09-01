<?php
// 数据库配置
define('DB_HOST','localhost');
define('DB_USER_NAME','root');
define('DB_USER_PWD','');
define('DB_NAME','fruit_db');
/**
 * 这是一个工具类，作用是完成对数据库的操作
 */
class SqlHelper
{
    public static $conn = null;

    /**
     * 打开数据库
     */ 
    public static function openDB()
    {
        self::$conn = mysql_connect(DB_HOST, DB_USER_NAME, DB_USER_PWD);
        
        if (!self::$conn) {
            die("链接失败!" . mysql_error());
        }
        
        //设置数据库的编码
        mysql_query("set names utf8", self::$conn) or die(mysql_errno());
        //选择数据库
        mysql_select_db(DB_NAME, self::$conn);
    }

    /**
     * 执行SQL查询语句，返回结果集资源
     * select
     */ 
    public static function executeResource($sql)
    {
        if(empty(self::$conn)) self::openDB();
        $res = mysql_query($sql, self::$conn) or die('{"result":false,"msg":"'.mysql_error().'"}');
        return $res;
    }

    /**
     * 执行SQL查询语句 返回结果数组
     * select
     */ 
    public static function executeArray($sql)
    {
        $arr = array();
        $res = self::executeResource($sql);

        //把$res=>$arr(结果集内容转移到数组中)
        while ($row = mysql_fetch_assoc($res)) {
            $arr[] = $row;
        }
        //这里就可以马上把$res关闭
        mysql_free_result($res);
        
        self::closeDB();
        
        return $arr;
    }
    
    /**
     * 执行SQL查询语句，返回对象数组
     * select
     */ 
    public static function executeObject($sql){
        $arr = array();
        $res = self::executeResource($sql);
        
        while($obj = mysql_fetch_object($res)){
            $arr[] = $obj;
        }
        
        mysql_free_result($res);
        self::closeDB();
        
        return $arr;
    }

    /**
     * 执行SQL查询语句，返回影响的行数
     * delete\update\insert
     */ 
    public static function executeRows($sql)
    {
        $b = self::executeResource($sql);
        
        if (!$b) {
            return 0;
        }
        
        $row = mysql_affected_rows(self::$conn);        
        $row = $row > 0 ? $row : 0;
        
        self::closeDB();
        
        return $row;
    }

    /**
     * 关闭数据库
     */ 
    public static function closeDB()
    {
        if (!empty(self::$conn)) {
            mysql_close(self::$conn);
        }
        
        self::$conn = null;
    }
}
//SqlHelper::openDB();
//var_dump(SqlHelper::$conn);
//$result = SqlHelper::executeObject('select * from department');
//print('<pre>');
//print_r($result);
//$obj = $result[0];
//echo $obj->id;
//echo $obj->name;

//SqlHelper::closeDB();
//var_dump(SqlHelper::$conn);
?>
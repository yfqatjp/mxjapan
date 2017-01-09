<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/common/config.php';
//error_reporting(0);
header("Content-type: text/html; charset=utf-8"); 
date_default_timezone_set('Asia/Shanghai');

if(PHP_VERSION<5.4){
	exit('PHP最低版本要求5.4');
}

$arr = array("short_open_tag");
for($i=0;$i<count($arr);$i++){
if (!get_cfg_var($arr[$i])) {
//exit('不支持'.$arr[$i]);
}
}

$arr = array("curl_init","mb_substr","imagecreate");
for($i=0;$i<count($arr);$i++){
if (!function_exists($arr[$i])) {
exit('不支持'.$arr[$i]);
}
}

$arr = array("sockets","openssl");
for($i=0;$i<count($arr);$i++){
if (!extension_loaded($arr[$i])) {
//exit('不支持'.$arr[$i]);
}
}

try{
	require_once "db.php";
}catch(PDOException $e){
	if($e->getMessage()=="could not find driver"){exit("不支持PDO");}
	exit("数据库连接失败");
}

session_start();

$pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
  
$pdo -> exec("SET NAMES 'utf8';"); 

// 水果php项目

require_once "sql.php";
require_once "function.php";
$safe = new sqlsafe();

?>
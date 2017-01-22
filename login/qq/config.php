<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hm/coon.php';

$qqid = "";
$qqkey = "";
//配置文件

$qq_k=$qqid; //QQ应用APP ID
$qq_s=$qqkey; //QQ应用APP KEY
$callback_url='http:// /login/qq/callback.php'; //授权回调网址
$scope='get_user_info,add_share'; //权限列表，具体权限请查看官方的api文档
?>
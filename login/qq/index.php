<?php
require_once('config.php');
require_once('qq.php');

$qq_t=isset($_SESSION['userid'])?$_SESSION['userid']:'';

//检查是否已登录
if($qq_t!=''){	
	/**
	$qq=new qqPHP($qq_k, $qq_s, $qq_t);
	$qq_oid=$qq->get_openid();
	$openid=$qq_oid['openid']; //获取登录用户open id

	//获取登录用户信息
	$result=$qq->get_user_info($openid);
	var_dump($result);
	echo $result['nickname'];
	
	发布分享
	$title='开源中国'; //分享页面标题
	$url='http://www.oschina.net/'; //分享页面网址
	$site=''; //QQ应用名称
	$fromurl='';  //QQ应用网址
	$result=$qq->add_share($openid, $title, $url, $site, $fromurl);
	var_dump($result);
	**/
	alert(2,"登录成功","/user/");
}else{
	//生成登录链接
	$qq=new qqPHP($qq_k, $qq_s);
	$login_url=$qq->login_url($callback_url, $scope);
	header("Location: ".$login_url);
}
?>
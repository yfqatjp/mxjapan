<?php session_start();
//授权回调页面，即配置文件中的$callback_url
require_once('config.php');
require_once('qq.php');

if(isset($_GET['code']) && trim($_GET['code'])!=''){
	$qq=new qqPHP($qq_k, $qq_s);
	$result=$qq->access_token($callback_url, $_GET['code']);
}

if(isset($result['access_token']) && trim($result['access_token'])!=''){
	
	$qq_t=$result['access_token'];
	
	$qq=new qqPHP($qq_k, $qq_s, $qq_t);
	$qq_oid=$qq->get_openid();	
	if(count($qq_oid)>0){

	$openid=$qq_oid['openid'];
	
	$result=$qq->get_user_info($openid);
	
	//print_r($result);

	if(isset($result['nickname']) && trim($result['nickname'])!=''){$user = $result['nickname'];}else{$user = "未设置昵称";}
	//echo $result->nickname;
	//保存登录信息，此示例中使用session保存
	$rs = $pdo -> query("select * from pm_user where pass like '".$qq_t."'");
	if($rs ->rowCount() > 0){
	$row = $rs -> fetch();
	$id = $row['id'];
	if($user != "未设置昵称"){
	$rs0 = $pdo->exec("UPDATE pm_user set `xname` = '".$user."' where pass like '".$qq_t."'");
	$user = $row['user'];}
	}else{
	$rs0 = $pdo->exec("INSERT INTO pm_user (`xname`,pass) VALUES ('".$user."','".$qq_t."')");
	$id = $pdo -> lastinsertid();
	}
	
	$_SESSION['userid']=$id;
	$_SESSION['username']=$user ;
	
	echo "<script language='javascript'>window.alert('登录成功');window.location.href='/user';</script>";
	
	exit();
	}else{
	echo '授权超时';
}
}else{
	echo '授权失败';
}
echo '<br/><a href="./">重试</a>';
?>
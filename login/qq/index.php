<?php
require_once('config.php');
require_once('qq.php');

$qq_t=isset($_SESSION['userid'])?$_SESSION['userid']:'';

//����Ƿ��ѵ�¼
if($qq_t!=''){	
	/**
	$qq=new qqPHP($qq_k, $qq_s, $qq_t);
	$qq_oid=$qq->get_openid();
	$openid=$qq_oid['openid']; //��ȡ��¼�û�open id

	//��ȡ��¼�û���Ϣ
	$result=$qq->get_user_info($openid);
	var_dump($result);
	echo $result['nickname'];
	
	��������
	$title='��Դ�й�'; //����ҳ�����
	$url='http://www.oschina.net/'; //����ҳ����ַ
	$site=''; //QQӦ������
	$fromurl='';  //QQӦ����ַ
	$result=$qq->add_share($openid, $title, $url, $site, $fromurl);
	var_dump($result);
	**/
	alert(2,"��¼�ɹ�","/user/");
}else{
	//���ɵ�¼����
	$qq=new qqPHP($qq_k, $qq_s);
	$login_url=$qq->login_url($callback_url, $scope);
	header("Location: ".$login_url);
}
?>
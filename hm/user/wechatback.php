<?php 

require_once '../coon.php';
//$_SESSION['formcode'] = rfc_encode(mt_rand(0, 1000000));
if (@$_SESSION['formcode'] == "") {
	header("Location: /signin.html");
	exit;
}

$code = "";
if (isset($_GET["code"])) {
	$code = @$_GET["code"];
}

$state = "";
if (isset($_GET["state"])) {
	$state = @$_GET["state"];
}

if (empty($code) || $state != $_SESSION['formcode']) {
	header("Location: /signin.html");
	exit;
}

// 通过code获取access_token
$arrData = getSnsapiAccessKey(WEIXIN_APPID, WEIXIN_APPSECRET, $code);

// 网页授权接口调用凭证
if (isset($arrData["access_token"]) && isset($arrData["openid"])) {
	// 取得OPENID
	$openId = $arrData["openid"];
	
	// 根据openid确认此用户是否存在
	$sql = "SELECT * FROM pm_user WHERE wx_openid = '" . $openId . "'";
	$rs = $pdo->query($sql);
	
	if ($rs->rowCount() > 0) {
		$row = $rs->fetch();
		$_SESSION['userid'] = $row['id'];
		if ($row['xname'] == "") {
			$_SESSION['username'] = $row['name'];
		} else {
			$_SESSION['username'] = $row['xname'];
		}
		header("Location: /user/");
		exit;
	}
	$_SESSION['wx_openid'] = $openId;
	// 用户注册
	exit(alert(2, "您还没有绑定到微信账号", "/signin.html"));
}
/**
 * 拉取用户信息
 *
 * @param unknown_type $code
 */
function getSnsapiUserInfo($openId, $accessToken) {
	//
	$url = "https://api.weixin.qq.com/sns/userinfo?";
	// 网页授权接口调用凭证
	$url .= "access_token=".$accessToken;
	// 用户的唯一标识
	$url .= "&openid=".$openId;
	// lang
	$url .= "&lang=zh_CN";
	// 返回数据
	$data = httpGet($url);
	$arr = json_decode($data, true);
	return $arr;
}

/**
 * 通过code换取网页授权access_token
 *
 * @param unknown_type $code
 */
function getSnsapiAccessKey($appId, $secret, $code) {
	//
	$url = "https://api.weixin.qq.com/sns/oauth2/access_token?";
	// appid
	$url .= "appid=".$appId;
	// secret
	$url .= "&secret=".$secret;
	// code
	$url .= "&code=".$code;
	// grant_type
	$url .= "&grant_type=authorization_code ";
	// 返回数据
	$data = httpGet($url);
	$arr = json_decode($data, true);
	return $arr;
}

/**
 *
 * @param unknown_type $url
 * @return mixed
 */
function httpGet($url) {
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_TIMEOUT, 500);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($curl, CURLOPT_URL, $url);

	$res = curl_exec($curl);
	curl_close($curl);

	return $res;
}

/**
 * 以post方式提交json到对应的接口url
 *
 * @param string $postData  需要post的数据
 * @param string $url  url
 * @param bool $useCert 是否需要证书，默认不需要
 * @param int $second   url执行超时时间，默认30s
 * @throws WxPayException
 */
function postDataCurl($postData, $url, $useCert = false, $second = 30)
{
	$ch = curl_init();
	//设置超时
	curl_setopt($ch, CURLOPT_TIMEOUT, $second);
	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
	//设置header
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	//要求结果为字符串且输出到屏幕上
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

	//post提交方式
	curl_setopt($ch, CURLOPT_POST, TRUE);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
	//运行curl
	$data = curl_exec($ch);
	//返回结果
	if($data){
		curl_close($ch);
		return $data;
	} else {
		$error = curl_errno($ch);
		curl_close($ch);
	}
}

?>

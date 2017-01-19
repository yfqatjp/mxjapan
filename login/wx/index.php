<?php
$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid= b&secret= &code=" . $_GET['code'] . "&grant_type=authorization_code";
if (function_exists('file_get_contents')) {
    $file_contents = file_get_contents($url);
} else {
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $file_contents = curl_exec($ch);
    curl_close($ch);
}

$de_json = json_decode($file_contents);

$url = "https://api.weixin.qq.com/sns/userinfo?access_token=" . $de_json->access_token . "&openid=" . $de_json->openid . "&lang=zh_CN";
if (function_exists('file_get_contents')) {
    $file_contents = file_get_contents($url);
} else {
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $file_contents = curl_exec($ch);
    curl_close($ch);
}

$de_json = json_decode($file_contents);


if (isset($de_json->nickname) && trim($de_json->nickname) != '') {
    $user = $de_json->nickname;
} else {
    $user = "未设置昵称";
}
//echo $result->nickname;
//保存登录信息，此示例中使用session保存
$rs = $pdo->query("SELECT * FROM pm_user WHERE pass LIKE '" . $de_json->openid . "'");
if ($rs->rowCount() > 0) {
    $row = $rs->fetch();
    $id = $row['id'];
    if ($user != "未设置昵称") {
        $rs0 = $pdo->exec("UPDATE pm_user SET `xname` = '" . iconv("UTF-8", "GBK//ignore", $user) . "' WHERE pass LIKE '" . $de_json->openid . "'");
        $user = $row['user'];
    }
} else {
    $rs0 = $pdo->exec("INSERT INTO pm_user (`xname`,pass) VALUES ('" . iconv("UTF-8", "GBK//ignore", $user) . "','" . $de_json->openid . "')");
    $id = $pdo->lastinsertid();
}

$_SESSION['userid'] = $id;
$_SESSION['username'] = $user;

echo "<script language='javascript'>window.alert('登录成功');window.location.href='/user';</script>";

exit();
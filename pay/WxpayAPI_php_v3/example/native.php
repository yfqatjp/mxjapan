<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hm/coon.php';
ini_set('date.timezone', 'Asia/Shanghai');
//error_reporting(E_ERROR);

require_once "../lib/WxPay.Api.php";
require_once "WxPay.NativePay.php";
require_once 'log.php';

$notify = new NativePay();

//模式二
/**
 * 流程：
 * 1、调用统一下单，取得code_url，生成二维码
 * 2、用户扫描二维码，进行支付
 * 3、支付完成之后，微信服务器会通知支付成功
 * 4、在支付成功通知中需要查单确认是否真正支付成功（见：notify.php）
 */
$o = date('Ymdhis', time()) . rand(1000, 9999);
$rs = $pdo->exec("UPDATE pm_gwc SET wxnum = '" . $o . "' WHERE tai = 0 AND id = " . $_SESSION['wxid']);
$input = new WxPayUnifiedOrder();
$input->SetBody(constant("SITE_TITLE") . "-" . $o);
$input->SetAttach(WxPayConfig::MCHID);
$input->SetOut_trade_no($o);
$input->SetTotal_fee($_SESSION['wxjia'] * 100);
$input->SetTime_start(date("YmdHis"));
$input->SetTime_expire(date("YmdHis", time() + 600));
$input->SetGoods_tag($o);
$input->SetNotify_url("http://" . $_SERVER['HTTP_HOST'] . "/pay/WxpayAPI_php_v3/example/notify.php");
$input->SetTrade_type("NATIVE");
$input->SetProduct_id($_SESSION['wxid']);
$result = $notify->GetPayUrl($input);

if ($result['return_code'] == "FAIL") {
    exit("微信配置错误");
}

if (@$result["code_url"] == "") {
    exit($result["err_code_des"]);
}
$url2 = $result["code_url"];
?>

<html>
<head>
    <meta http-equiv="content-type" content="text/php;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>微信支付</title>
    <script src="/js/jquery.min.js"></script>
    <script>

        $(document).ready(function () {
            setInterval("ajaxstatus()", 1000);
        });

        function ajaxstatus() {
            $.ajax({
                url: "/pay/WxpayAPI_php_v3/example/example.php?o=<?php echo $o?>",
                type: "POST",
                dataType: "text",
                success: function (data) {
                    if (data == 10) { //订单状态为1表示支付成功
                        parent.window.location.href = "/user/jddd.html"; //页面跳转
                    }
                },
                error: function () {
                    alert("请求订单状态出错");
                }
            });

        }
    </script>
</head>
<body>

<img alt="模式二扫码支付" src="http://paysdk.weixin.qq.com/example/qrcode.php?data=<?php echo urlencode($url2); ?>"
     style="width:150px;height:150px;"/>

</body>
</html>
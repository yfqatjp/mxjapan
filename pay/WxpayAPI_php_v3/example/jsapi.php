<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/coon.php';
ini_set('date.timezone','Asia/Shanghai');
//error_reporting(E_ERROR);
require_once "../lib/WxPay.Api.php";
require_once "WxPay.JsApiPay.php";
require_once 'log.php';

if(@$_SESSION['wxonum']==""){
exit(alert(2,"数据异常","gwc.php"));
}

//初始化日志
$logHandler= new CLogFileHandler("../logs/".date('Y-m-d').'.log');
$log = Log::Init($logHandler, 15);

//打印输出数组信息
function printf_info($data)
{
    foreach($data as $key=>$value){
        echo "<font color='#00ff55;'>$key</font> : $value <br/>";
    }
}

//①、获取用户openid
$tools = new JsApiPay();
$openId = $tools->GetOpenid();


//②、统一下单
$input = new WxPayUnifiedOrder();
$input->SetBody($webtitle."-".$_SESSION['wxonum']);
$input->SetAttach(WxPayConfig::MCHID);
$input->SetOut_trade_no($_SESSION['wxonum']);
$input->SetTotal_fee($_SESSION['wxjia']*100);
$input->SetTime_start(date("YmdHis"));
$input->SetTime_expire(date("YmdHis", time() + 600));
$input->SetGoods_tag($_SESSION['wxonum']);
$input->SetNotify_url("http://wx.stageandlife.com/WxpayAPI_php_v3/example/notify.php");
$input->SetTrade_type("JSAPI");
$input->SetOpenid($openId);
$order = WxPayApi::unifiedOrder($input);

//printf_info($order);
if($order['return_code']=="FAIL"){
$_SESSION['wxonum'] = "";
exit("微信配置错误");
}

$jsApiParameters = $tools->GetJsApiParameters($order);

//获取共享收货地址js函数参数
//$editAddress = $tools->GetEditAddressParameters();

//③、在支持成功回调通知中处理成功之后的事宜，见 notify.php
/**
 * 注意：
 * 1、当你的回调地址不可访问的时候，回调通知会失败，可以通过查询订单来确认支付是否成功
 * 2、jsapi支付时需要填入用户openid，WxPay.JsApiPay.php中有获取openid流程 （文档可以参考微信公众平台“网页授权接口”，
 * 参考http://mp.weixin.qq.com/wiki/17/c0f37d5704f0b64713d5d2c37b468d75.php）
 */
?>

<html>
<head>
    <meta http-equiv="content-type" content="text/php;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/> 
    <title>微信支付</title>
    <script type="text/javascript">
	//调用微信JS api 支付
	function jsApiCall()
	{
		WeixinJSBridge.invoke(
			'getBrandWCPayRequest',
			<?php echo $jsApiParameters; ?>,
			function(res){
				WeixinJSBridge.log(res.err_msg);
				//alert(res.err_code+res.err_desc+res.err_msg);
				if (res.err_msg == "get_brand_wcpay_request:ok") {
                    alert("支付成功");window.location.href='/';
                }else if (res.err_msg == "get_brand_wcpay_request:cancel")  {
                     alert("支付过程中用户取消");
                 }else{
                    //支付失败
                    alert("支付失败");window.location.href='/';
                 }
			}
		);
	}

	function callpay()
	{
		if (typeof WeixinJSBridge == "undefined"){
		    if( document.addEventListener ){
		        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
		    }else if (document.attachEvent){
		        document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
		        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
		    }
		}else{
		    jsApiCall();
		}
	}
	</script>
    <link rel="stylesheet" type="text/css" href="/css/zf.css"/>
</head>
<body>
<div class="sd-1">
 订单号：<?=$o?><br/>
   订单支付金额： <b><font color="#f00;"><?=$_SESSION['wxjia']?></font></b>元
</div>

<div class="ghd-1">支付方式</div>
<div class="preview">
  <div class="scrolldoorFrame">
    <ul class="scrollUl">
    <li class="st01"  >
        <img src="/images/15_03.png" />
          <div class="left">
            <div> <span style="color:#333; float:left;">微信支付</span>
              <div class="ghd-62">推荐</div>
              <div class="clear"></div>
            </div>
            <span style="color:#a7a7a7;">亿万用户的选择，更快更安全</span></div>
      <div class="clear"></div></li>

    </ul>
    
  </div>
</div>

<div class="kong-80"></div>

	<div align="center">
		<a style="  background-color:#FE6714;" class="input-5s" type="button" onclick="callpay()" >立即支付</a>
	</div>
    
</body>
</html>
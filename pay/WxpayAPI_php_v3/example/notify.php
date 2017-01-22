<?php require_once $_SERVER['DOCUMENT_ROOT'].'/hm/coon.php';
ini_set('date.timezone', 'Asia/Shanghai');
error_reporting(E_ERROR);

require_once "../lib/WxPay.Api.php";
require_once '../lib/WxPay.Notify.php';
require_once 'log.php';

//初始化日志
$logHandler = new CLogFileHandler("../logs/" . date('Y-m-d') . '.log');
$log = Log::Init($logHandler, 15);

class PayNotifyCallBack extends WxPayNotify
{
    //查询订单
    public function Queryorder($transaction_id)
    {
        $input = new WxPayOrderQuery();
        $input->SetTransaction_id($transaction_id);
        $result = WxPayApi::orderQuery($input);
        Log::DEBUG("query:" . json_encode($result));
        if (array_key_exists("return_code", $result)
            && array_key_exists("result_code", $result)
            && $result["return_code"] == "SUCCESS"
            && $result["result_code"] == "SUCCESS"
        ) {
            return true;
        }
        return false;
    }

    //重写回调处理函数
    public function NotifyProcess($data, &$msg)
    {
        Log::DEBUG("call back:" . json_encode($data));
        $notfiyOutput = array();

        if (!array_key_exists("transaction_id", $data)) {
            $msg = "输入参数不正确";
            return false;
        }
        //查询订单，判断订单真实性
        if (!$this->Queryorder($data["transaction_id"])) {
            $msg = "订单查询失败";
            return false;
        }

        return true;
    }
}

Log::DEBUG("begin notify");
$notify = new PayNotifyCallBack();
$notify->Handle(false);

$de_xml = simplexml_load_string($GLOBALS['HTTP_RAW_POST_DATA'], 'SimpleXMLElement', LIBXML_NOCDATA);

if ($de_xml->appid == WxPayConfig::APPID && $de_xml->mch_id == WxPayConfig::MCHID && $de_xml->result_code == "SUCCESS" && $de_xml->return_code == "SUCCESS") {
    $rs = $pdo->query("SELECT * FROM pm_gwc WHERE tai = 0 AND wxnum LIKE '" . $de_xml->out_trade_no . "'");
    if ($rs->rowCount() > 0) {
        $row = $rs->fetch();

        $rs0 = $pdo->exec("UPDATE pm_gwc SET pay=2,tai = 3,paytime=now(),onum=wxnum,paynum='" . $de_xml->transaction_id . "' WHERE id = " . $row['id'] . " ");

    }
    echo "<xml>
  <return_code><![CDATA[SUCCESS]]></return_code>
  <return_msg><![CDATA[OK]]></return_msg>
</xml>";
} else {
    echo "<xml>
  <return_code><![CDATA[FAIL]]></return_code>
  <return_msg><![CDATA[USER_ACCOUNT_ABNORMAL]]></return_msg>
</xml>";
}
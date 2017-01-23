<?php
/* * 
 * 功能：支付宝页面跳转同步通知页面
 * 版本：3.3
 * 日期：2012-07-23
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。

 *************************页面功能说明*************************
 * 该页面可在本机电脑测试
 * 可放入HTML等美化页面的代码、商户业务逻辑程序代码
 * 该页面可以使用PHP开发工具调试，也可以使用写文本函数logResult，该函数已被默认关闭，见alipay_notify_class.php中的函数verifyReturn
 */

require_once("alipay.config.php");
require_once("lib/alipay_notify.class.php");
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <?php
    //计算得出通知验证结果
    $alipayNotify = new AlipayNotify($alipay_config);
    $verify_result = $alipayNotify->verifyReturn();
    if ($verify_result) {//验证成功
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //请在这里加上商户的业务逻辑程序代码

        //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
        //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

        //商户订单号

        $out_trade_no = $_GET['out_trade_no'];

        //支付宝交易号

        $trade_no = $_GET['trade_no'];

        //交易状态
        $trade_status = $_GET['trade_status'];


        if ($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
            //判断该笔订单是否在商户网站中已经做过处理
            //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
            //如果有做过处理，不执行商户的业务程序
            $rs = $pdo->query("SELECT * FROM pm_gwc WHERE tai = 0 AND onum LIKE '" . $out_trade_no . "'");
            if ($rs->rowCount() > 0) {
                $row = $rs->fetch();

                $rs1 = $pdo->query("SELECT * FROM pm_hotel WHERE lang = 2 AND id = " . $row['hotels']);
                $row1 = $rs1->fetch();

                $rs4 = $pdo->query("SELECT * FROM pm_rate WHERE id_room = " . $row['room'] . " ORDER BY id DESC");
                $row4 = $rs4->fetch();

                $day = date('Ymd', strtotime($row['offt'])) - date('Ymd', strtotime($row['ont']));
                if ($day <= 0) {
                    $day = 1;
                }

                $rs5 = $pdo->query("SELECT * FROM pm_user WHERE id = " . $row['uid']);
                $row5 = $rs5->fetch();

                $rs = $pdo->exec("INSERT INTO pm_booking (`id_room`,`room`,`comments`,`firstname`,`from_date`,`to_date`,`Nights`,`adults`,`children`,add_date,Total,phone,payment_method,`status`,country,trans) SELECT `room`,'" . $row1['title'] . "',`text`,'" . $row5['name'] . "',UNIX_TIMESTAMP(ont),UNIX_TIMESTAMP(offt),'" . $day . "',`adults`,`children`,UNIX_TIMESTAMP(dtime),'" . $row4['price'] * $day . "','" . $row5['phone'] . "','支付宝支付',4,'中国','" . $out_trade_no . "' FROM pm_gwc WHERE onum LIKE '" . $o . "'");

                $rs0 = $pdo->exec("UPDATE pm_gwc SET pay=1,tai = 3,paytime=now(),paynum='" . $trade_no . "' WHERE id = " . $row['id'] . " ");

            }
        } else {
            echo "trade_status=" . $_GET['trade_status'];
        }

        echo "验证成功<br />";

        //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——

        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    } else {
        //验证失败
        //如要调试，请看alipay_notify.php页面的verifyReturn函数
        echo "验证失败";
    }
    ?>
    <title>支付宝即时到账交易接口</title>
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script type="text/javascript">
        function countDown(secs, surl) {
            //alert(surl);
            var jumpTo = document.getElementById('jumpTo');
            jumpTo.innerHTML = secs;
            if (--secs > 0) {
                setTimeout("countDown(" + secs + ",'" + surl + "')", 1000);
            }
            else {
                location.href = surl;
            }
        }

    </script>
</head>
<body><span id="jumpTo" style="display: none"></span>
<script type="text/javascript">countDown(1, '/dida-zfcg.php?o=<?=@$out_trade_no?>');</script>
</body>
</html>
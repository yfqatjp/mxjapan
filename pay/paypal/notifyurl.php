<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hm/coon.php';

//    if (function_exists('get_magic_quotes_gpc')) $get_magic_quotes_exists = true;
//    foreach ($_POST as $key => $value) {
//        if ($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
//            $value = urlencode(stripslashes($value));
//        } else {
//            $value = urlencode($value);
//        }
//        $req .= "&$key=$value";
//    }
//    $ch = curl_init('https://www.paypal.com/cgi-bin/webscr');
//    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
//    curl_setopt($ch, CURLOPT_POST, 1);
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//    curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
//    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
//    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
//    curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
//    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
//    $res = curl_exec($ch);
//    if (strcmp($res, "VERIFIED") == 0) {
//        return true;
//    } else if (strcmp($res, "INVALID") == 0) {
//
//    }


$req = 'cmd=_notify-validate';

foreach ($_POST as $key => $value) {
    $value = urlencode(stripslashes($value));
    $req .= "&$key=$value";
}

$header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

$fp = fsockopen('ssl://www.paypal.com', 443, $errno, $errstr, 30);


$item_name = @$_POST['item_name'];
$item_number = @$_POST['item_number'];
$payment_status = @$_POST['payment_status'];
$payment_amount = @$_POST['mc_gross'];
$payment_currency = @$_POST['mc_currency'];
$txn_id = @$_POST['txn_id'];
$receiver_email = @$_POST['receiver_email'];
$payer_email = @$_POST['payer_email'];
$mc_gross = @$_POST['mc_gross'];
$custom = @$_POST['custom'];


$message = $item_name .'\n';
$message = $message . $item_number .'\n';
$message = $message . $payment_status .'\n';
$message = $message . $payment_amount .'\n';
$message = $message . $payment_currency .'\n';
$message = $message . $txn_id .'\n';
$message = $message . $receiver_email .'\n';
$message = $message . $mc_gross .'\n';
$message = $message . $custom .'\n';

$file = fopen("logo.txt","w+");
fwrite($file,"paypal back" . $message);

fclose($file);



if (!$fp) {

} else {
    fputs($fp, $header . $req);
    while (!feof($fp)) {
        $res = fgets($fp, 1024);
        if (strcmp($res, "VERIFIED") == 0) {

            $rs = $pdo->query("SELECT * FROM pm_gwc WHERE tai = 0 AND onum LIKE '" . $item_number . "'");
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

                $rs = $pdo->exec("INSERT INTO pm_booking (`id_room`,`room`,`comments`,`firstname`,`from_date`,`to_date`,`Nights`,`adults`,`children`,add_date,Total,phone,payment_method,`status`,country,trans) SELECT `room`,'" . $row1['title'] . "',`text`,'" . $row5['name'] . "',UNIX_TIMESTAMP(ont),UNIX_TIMESTAMP(offt),'" . $day . "',`adults`,`children`,UNIX_TIMESTAMP(dtime),'" . $row4['price'] * $day . "','" . $row5['phone'] . "','支付宝支付',4,'中国','" . $item_number . "' FROM pm_gwc WHERE onum LIKE '" . $o . "'");

                $rs0 = $pdo->exec("UPDATE pm_gwc SET pay=1,tai = 3,paytime=now(),paynum='" . $txn_id . "' WHERE id = " . $row['id'] . " ");

            }
            echo "success";

        } else if (strcmp($res, "INVALID") == 0) {
            echo "fail";
        }
    }
    fclose($fp);
}
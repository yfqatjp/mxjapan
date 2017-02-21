<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hm/coon.php';

$file = fopen("logo.txt","w+");

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


$message = $item_name ."\n";
$message = $message . $item_number ."\n";
$message = $message . $payment_status ."\n";
$message = $message . $payment_amount ."\n";
$message = $message . $payment_currency ."\n";
$message = $message . $txn_id ."\n";
$message = $message . $receiver_email ."\n";
$message = $message . $mc_gross ."\n";
$message = $message . $custom ."\n";


fwrite($file,$message);





if($fp !== false){
	
    fputs($fp, $header.$req);
    while (!feof($fp)) {
        $res = fgets($fp, 1024);
        if (strcmp($res, "VERIFIED") !== false) {

        	$sql = "SELECT * FROM pm_gwc WHERE pay = 0 AND onum LIKE '" . $item_number . "'";
            $rs = $pdo->query($sql);

            $message =   $sql ."\n";
            
            if ($rs->rowCount() > 0) {
                $row = $rs->fetch();

                if (isset($row['type']) && $row['type'] == 1) {
                	$sql = "SELECT * FROM pm_charter WHERE lang = 2 AND id = " . $row['charter_id'];
                } else {
                	$sql = "SELECT * FROM pm_hotel WHERE lang = 2 AND id = " . $row['hotels'];
                }
                $rs1 = $pdo->query($sql);
                
                $row1 = $rs1->fetch();

                $message = $message .  $sql ."\n";
                
                /*
                $sql = "SELECT * FROM pm_rate WHERE id_room = " . $row['room'] . " ORDER BY id DESC";
                $rs4 = $pdo->query($sql);
                $row4 = $rs4->fetch();
                */


                $message = $message . $sql ."\n";                
                
                if (isset($row['type']) && $row['type'] == 1) {
                	$rs5 = $pdo->query("SELECT * FROM pm_user WHERE id = " . $row['uid']);
                	 
                	$row5 = $rs5->fetch();
                	
                	//
                	require_once $_SERVER['DOCUMENT_ROOT'] . '/common/HmWeb.php';
                	
                	$otherData = array();
                	$otherData["payment_date"] = strtotime("now");
                	$otherData["payment_total"] = $payment_amount;
                	$arrBookingData = $hmWeb->getBookingData($row["id"], $row, $row5, $row1, 3, 4, $otherData);
                	
                	//
                	$charterBookingSql = "select * from pm_charter_booking where trans = ? ";
                	$arrExistsBooking = $hmWeb->findOne($charterBookingSql, array($row["onum"]));
                	if ($arrExistsBooking != null && count($arrExistsBooking) > 0) {
                		//
                		$hmWeb->update("pm_charter_booking", $arrBookingData, " id = ?", array($arrExistsBooking["id"]));
                		
                		$message = $message . "update pm_charter_booking [" .serialize($arrBookingData)."]\n";
                	} else {
                		
	                	//
	                	$hmWeb->insert("pm_charter_booking", $arrBookingData);
	                	
	                	$message = $message . "insert pm_charter_booking [" .serialize($arrBookingData)."]\n";
                	}
                } else {
	                $day = date('Ymd', strtotime($row['offt'])) - date('Ymd', strtotime($row['ont']));
	                if ($day <= 0) {
	                    $day = 1;
	                }
	
	                $rs5 = $pdo->query("SELECT * FROM pm_user WHERE id = " . $row['uid']);
	                
	                $row5 = $rs5->fetch();
	
	                $sql = "INSERT INTO pm_booking (`id_room`,`room`,`comments`,`firstname`,`from_date`,`to_date`,`Nights`,`adults`,`children`,add_date,Total,phone,payment_method,`status`,country,trans) SELECT `room`,'" . $row1['title'] . "',`text`,'" . $row5['name'] . "',UNIX_TIMESTAMP(ont),UNIX_TIMESTAMP(offt),'" . $day . "',`adults`,`children`,UNIX_TIMESTAMP(dtime),'" . $payment_amount . "','" . $row5['phone'] . "','paypal',4,'中国','" . $item_number . "' FROM pm_gwc WHERE onum LIKE '" . $item_number . "'";
	                
	                $rs = $pdo->exec($sql);
	                $message = $message . $sql ."\n";
                }
                $rs0 = $pdo->exec("UPDATE pm_gwc SET pay=1,tai = 3,paytime=now(),paynum='" . $txn_id . "' WHERE id = " . $row['id'] . " ");
            }
            fwrite($file,$message);
            
            echo "success";

        } else{
        	fwrite($file,"\n"."fail");
        	
            echo "fail";
        }
    }
    fclose($fp);
    
    
    fclose($file);
}
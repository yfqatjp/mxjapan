<?php
define("SYSBASE",realpath(__DIR__."/../../../")."/");
require_once(SYSBASE."common/lib.php");
require_once(SYSBASE."common/define.php");

if(isset($_POST['mc_gross'])){
    
    $req = "cmd=_notify-validate";
    
    foreach($_POST as $key => $value){
        $value = urlencode(stripslashes($value));
        $req .= "&".$key."=".$value;
    }
    
    $host = (PAYPAL_TEST_MODE == 1) ? "www.sandbox.paypal.com" : "www.paypal.com";
    
    $header = "POST /cgi-bin/webscr HTTP/1.1\r\n";
    $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
    $header .= "Host: ".$host."\r\n";
    $header .= "Content-Length: ".strlen($req)."\r\n";
    $header .= "Connection: close\r\n\r\n";
    $fp = fsockopen("ssl://".$host, 443, $errno, $errstr, 30);
    
    if($fp !== false){
        
        $payment_status = $_POST['payment_status'];
        $payment_amount = $_POST['mc_gross'];
        $payment_currency = $_POST['mc_currency'];
        $txn_id = $_POST['txn_id'];
        $receiver_email = $_POST['receiver_email'];
        $payer_email = $_POST['payer_email'];
        $id_booking = $_POST['custom'];
    
        fputs($fp, $header.$req);
        
        while(!feof($fp)){
            
            $res = fgets($fp, 1024);
            
            if(strcmp($res, "VERIFIED") !== false){
                
                if($payment_status == "Completed"){
                    
                    $result_booking = $db->query("SELECT * FROM pm_booking WHERE id = ".$id_booking." AND status = 1 AND (trans IS NULL OR trans = '')");
                    if($result_booking !== false && $db->last_row_count() == 1){
                        
                        $row = $result_booking->fetch();
                
                        if($receiver_email == PAYPAL_EMAIL && $payment_currency == CURRENCY_CODE
                        && ((ENABLE_DOWN_PAYMENT == 1 && $payment_amount == $row['down_payment']) || (ENABLE_DOWN_PAYMENT == 0 && $payment_amount == $row['total']))){
                            
                            $data['id'] = $id_booking;
                            $data['status'] = 4;
                            $data['payment_date'] = time();
                            $data['trans'] = $txn_id;
                            
                            $result_booking = db_prepareUpdate($db, "pm_booking", $data);
                            if($result_booking->execute() !== false){
                                
                                $mailContent = "
                                <p><strong>".$texts['BILLING_ADDRESS']."</strong><br>
                                ".$row['firstname']." ".$row['lastname']."<br>";
                                if($row['company'] != "") $mailContent .= $texts['COMPANY']." : ".$row['company']."<br>";
                                $mailContent .= nl2br($row['address'])."<br>
                                ".$row['postcode']." ".$row['city']."<br>
                                ".$texts['PHONE']." : ".$row['phone']."<br>";
                                if($row['mobile'] != "") $mailContent .= $texts['MOBILE']." : ".$row['mobile']."<br>";
                                $mailContent .= $texts['EMAIL']." : ".$row['email']."</p>
                                
                                <p>".$texts['HOTEL']." : <strong>".$row['hotel']."</strong><br>
                                ".$texts['ROOM']." : <strong>".$row['room']."</strong><br>
                                ".$texts['CHECK_IN']." <strong>".strftime(DATE_FORMAT, $row['from_date'])."</strong><br>
                                ".$texts['CHECK_OUT']." <strong>".strftime(DATE_FORMAT, $row['to_date'])."</strong><br>
                                <strong>".$row['nights']."</strong> ".$texts['NIGHTS']."<br>
                                <strong>".($row['adults']+$row['children'])."</strong> ".$texts['PERSONS']." - 
                                ".$texts['ADULTS'].": <strong>".$row['adults']."</strong> / 
                                ".$texts['CHILDREN'].": <strong>".$row['children']."</strong><br>
                                ".$texts['AMOUNT'].": ".formatPrice($row['amount']*CURRENCY_RATE)." ".$texts['INCL_VAT']."</p>";

                                if($row['extra_services'] != ""){
                                    $extra_services = explode("|", $row['extra_services']);
                                    if(is_array($extra_services) && !empty($extra_services)){
                                            
                                        $mailContent .= "<p><strong>".$texts['EXTRA_SERVICES']."</strong><br>";
                                        foreach($extra_services as $extra){
                                            $extra = explode(";", $extra);
                                            $mailContent .= $extra[0]." x ".$extra[1]." : ".formatPrice($extra[2]*CURRENCY_RATE)." ".$texts['INCL_VAT']."<br>";
                                        }
                                        $mailContent .= "</p>";
                                    }
                                }

                                if(ENABLE_TOURIST_TAX == 1 && $row['tourist_tax'] > 0) $mailContent .= "<p>".$texts['TOURIST_TAX']." : ".formatPrice($row['tourist_tax']*CURRENCY_RATE)."</p>";
                                
                                if($row['comments'] != "") $mailContent .= "<p><b>".$texts['COMMENTS']."</b><br>".nl2br($row['comments'])."</p>";
                                
                                $mailContent .= "<p>".$texts['TOTAL']." : <b>".formatPrice($row['total']*CURRENCY_RATE)." ".$texts['INCL_VAT']."</b></p>";
                                
                                if(ENABLE_DOWN_PAYMENT == 1 && $row['down_payment'] > 0)
                                    $mailContent .= "<p>".$texts['DOWN_PAYMENT']." : <b>".formatPrice($row['down_payment']*CURRENCY_RATE)." ".$texts['INCL_VAT']."</b></p>";
                                
                                sendMail(EMAIL, OWNER, "Booking notice", $mailContent, $row['email'], $row['firstname']." ".$row['lastname']);
                                sendMail($row['email'], $row['firstname']." ".$row['lastname'], "Booking notice", $mailContent);
                            }
                        }
                    }
                }
            }
        }
        fclose ($fp);
    }
}

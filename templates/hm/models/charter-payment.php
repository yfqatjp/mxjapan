<?php

// 前台
require(SYSBASE."common/front.php");

if(!isset($_SESSION['charter_booking']) || count($_SESSION['charter_booking']) == 0){
    // 非法请求
    header("Location: ".DOCBASE.$sys_pages['charters']['alias']);
    exit();
}

$msg_error = "";
$msg_success = "";
$field_notice = array();

$payment_type = "";
// 支付方法
//$payment_arr = array_map("trim", explode(",", PAYMENT_TYPE));
$payment_arr = array("alipay");
if(isset($_POST['payment_type'])){
    $payment_type = $_POST['payment_type'];
    $handle = true;
}else{
    $payment_type = PAYMENT_TYPE;
    $handle = false;
}

// 预定订单是否已经处理
if(isset($_SESSION['charter_booking']['id']) && isset($_SESSION['charter_booking']['booking_code'])){
    $result_booking = $db->query("SELECT * FROM pm_charter_booking WHERE id = ".$_SESSION['charter_booking']['id']." AND status != 1 ");
    if($result_booking !== false && $db->last_row_count() > 0){
       $hotelApp->clearCharterSession();
        header("Location: ".DOCBASE.$sys_pages['charters']['alias']);
        exit();
    }
}

require(getFromTemplate("common/paypal.php", false));

// 订单总金额
$total = $hotelApp->getTotal();
// 支付金额
$paymentTotal = $hotelApp->getPaymentTotal();

$detailTitle = $_SESSION["charter_booking"]["title"];
//
if($handle && (!isset($_SESSION['charter_booking']['id']) || is_null($_SESSION['charter_booking']['id']))){
        
    $data = array();
    switch($payment_type){
        case "check": $data['payment_method'] = "Check";
        break;
        case "arrival": $data['payment_method'] = "On arrival";
        break;
        case "alipay": $data['payment_method'] = "alipay";
        break;
        case "paypal": $data['payment_method'] = "PayPal";
        break;
        case "cards": $data['payment_method'] = "Credit card (2Checkout.com)";
        break;
    }
    
    $data["session_data"] = serialize($_SESSION['charter_booking']);
    // 预定订单插入
    $bookingId = $hotelApp->insertCharterBooking($data);
    if ($bookingId > 0) {
    	if($payment_type == "check" || $payment_type == "alipay"){
    	
    		
    	}
    	// 清空保存的会话数据
    	$hotelApp->clearCharterSession();
    	
    	// TODO
    	header("Location: ".DOCBASE.$sys_pages['charter-payment-complete']['alias']);
    	exit();
    }
}

/* ==============================================
 * CSS AND JAVASCRIPT USED IN THIS MODEL
 * ==============================================
 */
if($payment_type == "cards")
    $javascripts[] = "https://www.2checkout.com/static/checkout/javascript/direct.min.js";

require(getFromTemplate("common/header.php", false)); ?>

<section id="page">
    
    <?php include(getFromTemplate("common/page_header.php", false)); ?>
    
    <div id="content" class="pt30 pb30">
        <div class="container">

            <div class="alert alert-success" style="display:none;"></div>
            <div class="alert alert-danger" style="display:none;"></div>
            

            
            <?php echo $page['text']; ?>
            
            <?php
            if($payment_type == "paypal"){ ?>
                <div class="text-center">
                    <?php echo $texts['PAYMENT_PAYPAL_NOTICE']; ?><br>
                    <img src="<?php echo getFromTemplate("images/paypal-cards.png"); ?>" alt="PayPal" class="img-responsive mt10 mb30">
                    <form action="https://www.<?php if(PAYMENT_TEST_MODE == 1) echo "sandbox."; ?>paypal.com/cgi-bin/webscr" method="post">
                        <input type='hidden' value="<?php echo str_replace(",", ".", round($amount*CURRENCY_RATE, 2)); ?>" name="amount">
                        <input name="currency_code" type="hidden" value="<?php echo CURRENCY_CODE; ?>">
                        <input name="shipping" type="hidden" value="0.00">
                        <input name="tax" type="hidden" value="0.00">
                        <input name="return" type="hidden" value="<?php echo getUrl(true).DOCBASE.$sys_pages['booking']['alias']."?action=confirm"; ?>">
                        <input name="cancel_return" type="hidden" value="<?php echo getUrl(true).DOCBASE.$sys_pages['booking']['alias']."?action=cancel"; ?>">
                        <input name="notify_url" type="hidden" value="<?php echo getUrl(true).getFromTemplate("common/paypal_notify.php"); ?>">
                        <input name="cmd" type="hidden" value="_xclick">
                        <input name="business" type="hidden" value="<?php echo PAYPAL_EMAIL; ?>">
                        <input name="item_name" type="hidden" value="<?php echo addslashes($_SESSION['tmp_book']['hotel']." - ".$_SESSION['tmp_book']['room']." - ".strftime(DATE_FORMAT, $_SESSION['tmp_book']['from_date'])." > ".strftime(DATE_FORMAT, $_SESSION['tmp_book']['to_date'])." - ".$_SESSION['tmp_book']['nights']." ".$texts['NIGHTS']." - ".($_SESSION['tmp_book']['adults']+$_SESSION['tmp_book']['children'])." ".$texts['PERSONS']); ?>">
                        <input name="no_note" type="hidden" value="1">
                        <input name="lc" type="hidden" value="<?php echo strtoupper(LANG_TAG); ?>">
                        <input name="bn" type="hidden" value="PP-BuyNowBF">
                        <input name="custom" type="hidden" value="<?php echo $_SESSION['tmp_book']['id']; ?>">
                        
                        <button type="submit" name="submit" class="btn btn-primary btn-lg pull-right"><i class="fa fa-paypal"></i> <?php echo $texts['PAY']; ?></button>
                    </form>
                </div>
                <?php
            }elseif($payment_type == "cards"){ ?>
                <div class="text-center">
                    <?php echo $texts['PAYMENT_CARDS_NOTICE']; ?><br>
                    <img src="<?php echo getFromTemplate("images/2checkout-cards.png"); ?>" alt="2Checkout.com" class="img-responsive mt10 mb30">
                    <form action="https://<?php if(PAYMENT_TEST_MODE == 1) echo "sandbox"; else echo "www"; ?>.2checkout.com/checkout/purchase" method="post">
                        <input type="hidden" name="sid" value="<?php echo VENDOR_ID; ?>">
                        <input type="hidden" name="mode" value="2CO">
                        <input type="hidden" name="merchant_order_id" value="<?php echo $_SESSION['tmp_book']['id']; ?>">
                        <input type="hidden" name="li_0_type" value="product">
                        <input type="hidden" name="li_0_name" value="<?php echo addslashes($_SESSION['tmp_book']['hotel']." - ".$_SESSION['tmp_book']['room']." - ".strftime(DATE_FORMAT, $_SESSION['tmp_book']['from_date'])." > ".strftime(DATE_FORMAT, $_SESSION['tmp_book']['to_date'])." - ".$_SESSION['tmp_book']['nights']." ".$texts['NIGHTS']." - ".($_SESSION['tmp_book']['adults']+$_SESSION['tmp_book']['children'])." ".$texts['PERSONS']); ?>">
                        <input type="hidden" name="li_0_price" value="<?php echo str_replace(",", ".", round($amount*CURRENCY_RATE, 2)); ?>">
                        <input type="hidden" name="card_holder_name" value="<?php echo $_SESSION['book']['lastname']." ".$_SESSION['book']['lastname']; ?>">
                        <input type="hidden" name="street_address" value="<?php echo $_SESSION['book']['address']; ?>">
                        <input type="hidden" name="street_address2" value="">
                        <input type="hidden" name="city" value="<?php echo $_SESSION['book']['city']; ?>">
                        <input type="hidden" name="state" value="">
                        <input type="hidden" name="zip" value="<?php echo $_SESSION['book']['postcode']; ?>">
                        <input type="hidden" name="country" value="<?php echo $_SESSION['book']['country']; ?>">
                        <input type="hidden" name="email" value="<?php echo $_SESSION['book']['email']; ?>">
                        <input type="hidden" name="phone" value="<?php echo $_SESSION['book']['phone']; ?>">
                        <input type="hidden" name="x_receipt_link_url" value="<?php echo getUrl(true).getFromTemplate("common/payment_notify.php"); ?>">
                        
                        <button type="submit" name="submit" class="btn btn-primary btn-lg pull-right"><i class="fa fa-credit-card"></i> <?php echo $texts['PAY']; ?></button>
                    </form>
                </div>
                <?php
            }else{ ?>
            
                <div class="text-center lead pt20 pb20">

                    <form method="post" action="<?php echo DOCBASE.$sys_pages['charter-payment']['alias']; ?>">
                        <?php
                        if(!isset($_POST['payment_type'])){
                            $payments = $payment_arr;
                            if(count($payments) >= 1){ ?>
                                <div class="mb10">
                                    <?php echo $texts['CHOOSE_PAYMENT']; ?>
                                </div>
                                <?php
                                foreach($payments as $payment){ ?>
                                    <button type="submit" name="payment_type" class="btn btn-default" value="<?php echo $payment; ?>">
                                        <?php
                                        switch($payment){
                                            case "cards": ?>
                                                <i class="fa fa-credit-card"></i><br><?php echo $texts['PAYMENT_CREDIT_CARDS'];
                                            break;
                                            case "paypal": ?>
                                                <i class="fa fa-paypal"></i><br>PayPal
                                                <?php
                                            break;
                                            case "check": ?>
                                                <i class="fa fa-envelope"></i><br><?php echo $texts['PAYMENT_CHECK']; ?>
                                                <?php
                                            break;
                                            case "arrival": ?>
                                                <i class="fa fa-building"></i><br><?php echo $texts['PAYMENT_ARRIVAL']; ?>
                                                <?php
                                            break;
                                            case "alipay": ?>
												<img src="/plugins/ALIDIRECTPAY/img/alipay_logo.png" height="30px">
												<?php
											break;
                                        } ?>
                                    </button>
                                    <?php
                                }
                            }
                        }else{ ?>
                            <input type="hidden" name="payment_type" value="<?php echo $payment_type; ?>">
                            <?php
                        } ?>
                    </form>
                </div>
                <div class="clearfix"></div>
                <a class="btn btn-default btn-lg pull-left" href="<?php echo DOCBASE.$sys_pages['summary']['alias']; ?>"><i class="fa fa-angle-left"></i> <?php echo $texts['PREVIOUS_STEP']; ?></a>
                <?php
            } ?>
        </div>
    </div>
</section>

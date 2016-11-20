<?php

// 前台
require(SYSBASE."common/front.php");

$arrCharter = array();
$max_adults_search = 10;
// 是否可以预定
$bookingEnble = "0";
//
$charterId = 0;
$charter_alias = "";
if (!$hotelApp->isPOST()) {
	// 非法请求
	header("Location: ".DOCBASE."charters/");
	exit();
}

// 还没有登录
if(!$hotelApp->isLogin()){
	header("Location: ".DOCBASE."charter/".text_format($arrCharter['alias']));
	exit();
}

// token的check
if (!$hotelApp->checkBooking()) {
	// 非法请求
	header("Location: ".DOCBASE.$sys_pages['charters']['alias']);
	exit();
}

$msg_error = "";
$msg_success = "";
$field_notice = array();
//
$arrBookingUser = array();
// 预定的场合
if ($hotelApp->query("action") == "booking") {
	//
	$arrMsg = $hotelApp->checkBookingForm();
	if ($arrMsg != null && count($arrMsg) > 0) {
		$msg_error = implode("<br/>", $arrMsg);
		$arrBookingUser = $_POST;
	} else {
		// 预定处理
		$hotelApp->setCharterBooking();
		
		// 
		// 预定支付确认画面
		header("Location: ".DOCBASE.$sys_pages['charter-payment']['alias']);
		exit();
	}
}
//
$charterId = $hotelApp->query("charter_id");
//
$charter_alias = $hotelApp->query("charter_alias");

// 
$result = $db->query("SELECT t1.*, 
		t2.car_brand, t2.car_model, t2.car_no, t2.car_seat, t2.safe, t2.fee  
		FROM pm_charter t1 
		INNER JOIN pm_charter_info t2 on t1.id = t2.id_charter 
		WHERE t1.checked = 1 AND t1.lang = ".LANG_ID." AND t1.id = ".$db->quote($charterId));
if($result !== false && $db->last_row_count() == 1){
	$arrCharter = $result->fetch(PDO::FETCH_ASSOC);
	$page_alias = DOCBASE.$pages[$page_id]['alias']."/".text_format($arrCharter['alias']);
} else {
	$hotelApp->setBookingCheckMsg("CHARTER_NOT_EXIST");
	header("Location: ".DOCBASE."charters/");
	exit();
}

// 将追加的包车服务放到预约车里
$hotelApp->charterSession($arrCharter);


// 个人的信息/否则显示刚才自己输入过的信息
if(isset($_SESSION['user']) && count($arrBookingUser) == 0){
	$result_user = $db->query("SELECT * FROM pm_user WHERE id = ".$db->quote($_SESSION['user']['id'])." AND checked = 1");
	if($result_user !== false && $db->last_row_count() > 0){
		$arrBookingUser = $result_user->fetch();
	}
}

// 安全考虑
$token = $hotelApp->getToken();

require(getFromTemplate("common/header.php", false)); ?>

<section id="page">
    
    <?php include(getFromTemplate("common/page_header.php", false)); ?>
    
    <div id="content" class="pt30 pb30">
        <div class="container">

            <div class="alert alert-success" style="display:none;"></div>
            <?php 
            	if (!empty($msg_error)) {
            ?>
            <div class="alert alert-danger"><?php echo $msg_error;?></div>
            <?php 
            	}
            ?>
            <form method="post" action="?" class="ajax-form">
            
				<input type="hidden" name="charter_id" value="<?php echo $arrCharter['id']; ?>" />
		    	<input type="hidden" name="action" value="booking" />
		    	<input type="hidden" name="<?php echo $hotelApp->token_name; ?>" value="<?php echo $token; ?>" />
            	
                <div class="row">
                    <div class="col-md-6">
                        <fieldset>
                            <legend><?php echo $texts['CONTACT_DETAILS']; ?></legend>
            
                            <div class="row form-group">
                                <label class="col-lg-3 control-label"><?php echo $texts['LASTNAME']; ?> *</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="lastname" value="<?php echo $hotelApp->t("name", $arrBookingUser); ?>"/>
                                    <div class="field-notice" rel="lastname"></div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-lg-3 control-label"><?php echo $texts['FIRSTNAME']; ?> *</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="firstname" value="<?php echo $hotelApp->t("firstname", $arrBookingUser); ?>"/>
                                    <div class="field-notice" rel="firstname"></div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-lg-3 control-label"><?php echo $texts['EMAIL']; ?> *</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="email" value="<?php echo $hotelApp->t("email", $arrBookingUser); ?>"/>
                                    <div class="field-notice" rel="email"></div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-lg-3 control-label"><?php echo $texts['COMPANY']; ?></label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="company" value="<?php echo $hotelApp->t("company", $arrBookingUser); ?>"/>
                                    <div class="field-notice" rel="company"></div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-lg-3 control-label"><?php echo $texts['ADDRESS']; ?> *</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="address" value="<?php echo $hotelApp->t("address", $arrBookingUser); ?>"/>
                                    <div class="field-notice" rel="address"></div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-lg-3 control-label"><?php echo $texts['POSTCODE']; ?> *</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="postcode" value="<?php echo $hotelApp->t("postcode", $arrBookingUser); ?>"/>
                                    <div class="field-notice" rel="postcode"></div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-lg-3 control-label"><?php echo $texts['CITY']; ?> *</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="city" value="<?php echo $hotelApp->t("city", $arrBookingUser); ?>"/>
                                    <div class="field-notice" rel="city"></div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-lg-3 control-label"><?php echo $texts['COUNTRY']; ?> *</label>
                                <div class="col-lg-9">
                                    <select class="form-control" name="country">
                                        <option value="0">-</option>
                                        <?php
                                        $result_country = $db->query("SELECT * FROM pm_country");
                                        $country = $hotelApp->t("country", $arrBookingUser);
                                        if($result_country !== false){
                                            foreach($result_country as $i => $row){
                                                $id_country = $row['id'];
                                                $country_name = $row['name'];
                                                $selected = ($country == $country_name) ? " selected=\"selected\"" : "";
                                                
                                                echo "<option value=\"".$country_name."\"".$selected.">".$country_name."</option>";
                                            }
                                        } ?>
                                    </select>
                                    <div class="field-notice" rel="country"></div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-lg-3 control-label"><?php echo $texts['PHONE']; ?> *</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="phone" value="<?php echo $hotelApp->t("phone", $arrBookingUser); ?>"/>
                                    <div class="field-notice" rel="phone"></div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-lg-3 control-label"><?php echo $texts['MOBILE']; ?></label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="mobile" value="<?php echo $hotelApp->t("mobile", $arrBookingUser); ?>"/>
                                    <div class="field-notice" rel="mobile"></div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-md-6">
                        <fieldset class="mb20">
                            <legend><?php echo $hotelApp->getTextsByName("CHARTER_DETAILS"); ?></legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <h3><?php echo $hotelApp->t("title", $_SESSION['charter_booking']); ?></h3>
                                </div>
                                    <div class="col-md-6">
                                        <span class="pull-right lead">
                                            <?php echo formatPrice($hotelApp->t("price", $_SESSION['charter_booking'])*CURRENCY_RATE); ?>
                                        </span>
                                    </div>
                            </div>
                            
  							<div class="row">
								<div class="col-md-6"><p><?php echo $hotelApp->getTextsByName("CHARTER_DESTINATION"); ?></p></div>
                                <div class="col-md-6">
                                    <span class="pull-right"><?php echo $hotelApp->t("destination", $_SESSION['charter_booking']); ?></span>
                                </div>
                            </div>
                            
                            <div class="row">
								<div class="col-md-6"><p><?php echo $hotelApp->getTextsByName("CHARTER_PHONE"); ?></p></div>
                                <div class="col-md-6">
                                    <span class="pull-right"><?php echo $hotelApp->t("phone", $_SESSION['charter_booking']); ?></span>
                                </div>
                            </div>
                            
                            <div class="row">
								<div class="col-md-6"><p><?php echo $hotelApp->getTextsByName("CHARTER_CAR_INFO"); ?></p></div>
                                <div class="col-md-6">
                                    <span class="pull-right">
                                    <?php 
                                    	echo $hotelApp->t("car_model", $_SESSION['charter_booking'])." - ".$hotelApp->t("car_no", $_SESSION['charter_booking']); 
                                    ?>
                                    </span>
                                </div>
                            </div>
                            
                            <div class="row">
								<div class="col-md-6"><p><?php echo $hotelApp->getTextsByName("CHARTER_SAFE"); ?></p></div>
                                <div class="col-md-6">
                                    <span class="pull-right"><?php echo $hotelApp->t("safe", $_SESSION['charter_booking']); ?></span>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="mb20">
                            <legend><?php echo $hotelApp->getTextsByName("CHARTER_BOOKING_DETAILS"); ?></legend>
                                <div class="row">
                                    <div class="col-md-6"><p><?php echo $hotelApp->getTextsByName("CHARTER_DEPART_DATE"); ?></p></div>
                                    <div class="col-md-6 pull-right input-group">
                                    	<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
						                <input type="text" class="form-control text-right" name="depart_date" id="depart_date" value="" >
                                    </div>
                                </div>
        
                                <div class="row">
                                    <div class="col-md-6"><p><?php echo $hotelApp->getTextsByName("CHARTER_DEPART_NUM"); ?></p></div>
                                    <div class="col-md-6 input-group pull-right">
					                    <select name="depart_num" class="selectpicker form-control">
					                        <?php
					                        for($i = 1; $i <= $max_adults_search; $i++){
					                            //$select = ($num_adults == $i) ? " selected=\"selected\"" : "";
					                            echo "<option value=\"".$i."\"".$select.">".$i."</option>";
					                        } ?>
					                    </select>
                                    </div>
                                </div>
                        </fieldset>
                       
                       
                        <fieldset>
                            <legend><?php echo $texts['SPECIAL_REQUESTS']; ?></legend>
                            <div class="form-group">
                                <textarea class="form-control" name="comments"><?php echo $hotelApp->t("comments", $arrBookingUser); ?></textarea>
                                <div class="field-notice" rel="comments"></div>
                            </div>
                            <p><?php //echo $texts['BOOKING_TERMS']; ?></p>
                        </fieldset>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary btn-lg pull-right" name="request"><i class="fa fa-send"></i> <?php echo $texts['MAKE_A_REQUEST']; ?></button>
            </form>
        </div>
    </div>
</section>



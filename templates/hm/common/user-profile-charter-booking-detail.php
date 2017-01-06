<?php
// 前台
require(SYSBASE."common/front.php");

// 取得预订订单ID
$charterBookingId = $hotelApp->query("id");

// 取得包车服务详情
$arrCharterInfo = $hotelApp->getCharterBookingById($charterBookingId);

if ($arrCharterInfo != null && count($arrCharterInfo) == 0) {
	header("Location: ".DOCBASE.LANG_ALIAS."account/6");
	exit();
}


function echoInfo($arr, $key){
	if (isset($arr[$key])) {
		return $arr[$key];
	} else {
		return "";
	}
}
?>

<div id="content" class="pt30 pb30">
    <div class="container">
		<h4>订单详情</h4>
        <div class="row">
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label">订单编号</label>
	                <div class="col-lg-9">
	                    <div class="field-notice"><?php echo echoInfo($arrCharterInfo, "booking_code");?></div>
	                </div>
	            </div>

	        </div>
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label">订单状态</label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo $hotelApp->displayStatusName(echoInfo($arrCharterInfo, "status"));?></div>
	                </div>
	            </div>
	        </div>
        </div>

        <div class="row">
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label">车牌号码</label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo echoInfo($arrCharterInfo, "car_no");?></div>
	                </div>
	            </div>

	        </div>
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label">车品牌</label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo echoInfo($arrCharterInfo, "car_model");?></div>
	                </div>
	            </div>
	        </div>
        </div>

		<div class="row">
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label">接送日</label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo date("Y-m-d H:i:s", echoInfo($arrCharterInfo, "depart_date"));?></div>
	                </div>
	            </div>
	        </div>
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label">接送人数</label>
	                <div class="col-lg-9">
	                    <div class="field-notice"><?php echo echoInfo($arrCharterInfo, "depart_num");?></div>
	                </div>
	            </div>

	        </div>
        </div>

		<div class="row">
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label">服务标题</label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo echoInfo($arrCharterInfo, "title");?></div>
	                </div>
	            </div>
	        </div>
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label">接送地点</label>
	                <div class="col-lg-9">
	                    <div class="field-notice"><?php echo echoInfo($arrCharterInfo, "destination");?></div>
	                </div>
	            </div>

	        </div>
        </div>

		<div class="row">
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label">订单总额</label>
	                <div class="col-lg-9">
	                    <div class="field-notice"><?php echo formatPrice(echoInfo($arrCharterInfo, "total")*CURRENCY_RATE);?></div>
	                </div>
	            </div>

	        </div>
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label">支付总额</label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo formatPrice(echoInfo($arrCharterInfo, "payment_total")*CURRENCY_RATE);?></div>
	                </div>
	            </div>
	        </div>
        </div>

		<div class="row">

	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label">下单时间</label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo date("Y-m-d H:i:s", echoInfo($arrCharterInfo, "add_date"));?></div>
	                </div>
	            </div>
	        </div>

	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label">支付时间</label>
	                <div class="col-lg-9">
	                    <div class="field-notice" >
	                    <?php 
	                    if (!empty(echoInfo($arrCharterInfo, "payment_date"))) {
		                    echo date("Y-m-d H:i:s", echoInfo($arrCharterInfo, "payment_date"));
	                    }
	                    
	                    ?>
	                    </div>
	                </div>
	            </div>
	        </div>

        </div>

        <h4>预订人信息</h4>
        <div class="row">
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label"><?php echo $texts['FULLNAME']; ?></label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo echoInfo($arrCharterInfo, "firstname");?></div>
	                </div>
	            </div>

	        </div>
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label"><?php echo $texts['LASTNAME']; ?></label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo echoInfo($arrCharterInfo, "lastname");?></div>
	                </div>
	            </div>
	        </div>
        </div>

		<div class="row">
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label"><?php echo $texts['EMAIL']; ?></label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo echoInfo($arrCharterInfo, "email");?></div>
	                </div>
	            </div>

	        </div>
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label"><?php echo $texts['COMPANY']; ?></label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo echoInfo($arrCharterInfo, "company");?></div>
	                </div>
	            </div>
	        </div>
        </div>


		<div class="row">
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label"><?php echo $texts['EMAIL']; ?></label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo echoInfo($arrCharterInfo, "email");?></div>
	                </div>
	            </div>

	        </div>
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label"><?php echo $texts['COMPANY']; ?></label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo echoInfo($arrCharterInfo, "company");?></div>
	                </div>
	            </div>
	        </div>
        </div>

 		<div class="row">
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label"><?php echo $texts['ADDRESS']; ?></label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo echoInfo($arrCharterInfo, "address");?></div>
	                </div>
	            </div>

	        </div>
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label"><?php echo $texts['POSTCODE']; ?></label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo echoInfo($arrCharterInfo, "postcode");?></div>
	                </div>
	            </div>
	        </div>
        </div>

 		<div class="row">
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label"><?php echo $texts['CITY']; ?></label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo echoInfo($arrCharterInfo, "city");?></div>
	                </div>
	            </div>

	        </div>
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label"><?php echo $texts['PHONE']; ?></label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo echoInfo($arrCharterInfo, "phone");?></div>
	                </div>
	            </div>
	        </div>
        </div>

 		<div class="row">
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label"><?php echo $texts['MOBILE']; ?></label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo echoInfo($arrCharterInfo, "mobile");?></div>
	                </div>
	            </div>

	        </div>
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label"><?php echo $texts['COUNTRY']; ?></label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo echoInfo($arrCharterInfo, "country");?></div>
	                </div>
	            </div>
	        </div>
        </div>

 		<div class="row">
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label"><?php echo $texts['COMMENTS']; ?></label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo echoInfo($arrCharterInfo, "comments");?></div>
	                </div>
	            </div>

	        </div>
        </div>

    </div>
</div>
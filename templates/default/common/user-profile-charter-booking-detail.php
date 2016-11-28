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
	                    <div class="field-notice"><?php echo echoInfo($charterBookingId, "booking_code");?></div>
	                </div>
	            </div>

	        </div>
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label">订单状态</label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo $hotelApp->displayStatusName(echoInfo($charterBookingId, "status"));?></div>
	                </div>
	            </div>
	        </div>
        </div>

        <div class="row">
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label">车牌号码</label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo echoInfo($charterBookingId, "car_no");?></div>
	                </div>
	            </div>

	        </div>
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label">车品牌</label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo echoInfo($charterBookingId, "car_model");?></div>
	                </div>
	            </div>
	        </div>
        </div>

		<div class="row">
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label">接送日</label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo date("Y-m-d H:i:s", echoInfo($charterBookingId, "depart_date"));?></div>
	                </div>
	            </div>
	        </div>
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label">接送人数</label>
	                <div class="col-lg-9">
	                    <div class="field-notice"><?php echo echoInfo($charterBookingId, "depart_num");?></div>
	                </div>
	            </div>

	        </div>
        </div>

		<div class="row">
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label">服务标题</label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo echoInfo($charterBookingId, "title");?></div>
	                </div>
	            </div>
	        </div>
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label">接送地点</label>
	                <div class="col-lg-9">
	                    <div class="field-notice"><?php echo echoInfo($charterBookingId, "destination");?></div>
	                </div>
	            </div>

	        </div>
        </div>

		<div class="row">
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label">订单总额</label>
	                <div class="col-lg-9">
	                    <div class="field-notice"><?php echo formatPrice(echoInfo($charterBookingId, "total")*CURRENCY_RATE);?></div>
	                </div>
	            </div>

	        </div>
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label">支付总额</label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo formatPrice(echoInfo($charterBookingId, "payment_total")*CURRENCY_RATE);?></div>
	                </div>
	            </div>
	        </div>
        </div>

		<div class="row">

	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label">下单时间</label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo date("Y-m-d H:i:s", echoInfo($charterBookingId, "add_date"));?></div>
	                </div>
	            </div>
	        </div>

	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label">支付时间</label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo date("Y-m-d H:i:s", echoInfo($charterBookingId, "payment_date"));?></div>
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
	                    <div class="field-notice" ><?php echo echoInfo($charterBookingId, "firstname");?></div>
	                </div>
	            </div>

	        </div>
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label"><?php echo $texts['LASTNAME']; ?></label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo echoInfo($charterBookingId, "lastname");?></div>
	                </div>
	            </div>
	        </div>
        </div>

		<div class="row">
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label"><?php echo $texts['EMAIL']; ?></label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo echoInfo($charterBookingId, "email");?></div>
	                </div>
	            </div>

	        </div>
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label"><?php echo $texts['COMPANY']; ?></label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo echoInfo($charterBookingId, "company");?></div>
	                </div>
	            </div>
	        </div>
        </div>


		<div class="row">
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label"><?php echo $texts['EMAIL']; ?></label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo echoInfo($charterBookingId, "email");?></div>
	                </div>
	            </div>

	        </div>
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label"><?php echo $texts['COMPANY']; ?></label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo echoInfo($charterBookingId, "company");?></div>
	                </div>
	            </div>
	        </div>
        </div>

 		<div class="row">
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label"><?php echo $texts['ADDRESS']; ?></label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo echoInfo($charterBookingId, "address");?></div>
	                </div>
	            </div>

	        </div>
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label"><?php echo $texts['POSTCODE']; ?></label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo echoInfo($charterBookingId, "postcode");?></div>
	                </div>
	            </div>
	        </div>
        </div>

 		<div class="row">
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label"><?php echo $texts['CITY']; ?></label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo echoInfo($charterBookingId, "city");?></div>
	                </div>
	            </div>

	        </div>
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label"><?php echo $texts['PHONE']; ?></label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo echoInfo($charterBookingId, "phone");?></div>
	                </div>
	            </div>
	        </div>
        </div>

 		<div class="row">
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label"><?php echo $texts['MOBILE']; ?></label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo echoInfo($charterBookingId, "mobile");?></div>
	                </div>
	            </div>

	        </div>
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label"><?php echo $texts['COUNTRY']; ?></label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo echoInfo($charterBookingId, "country");?></div>
	                </div>
	            </div>
	        </div>
        </div>

 		<div class="row">
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label"><?php echo $texts['COMMENTS']; ?></label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo echoInfo($charterBookingId, "comments");?></div>
	                </div>
	            </div>

	        </div>
        </div>

    </div>
</div>
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
	                <label class="col-lg-3 control-label">服务内容</label>
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
	                <label class="col-lg-3 control-label">支付</label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo echoInfo($charterBookingId, "title");?></div>
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
        </div>



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
	                <label class="col-lg-3 control-label">服务内容</label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo echoInfo($charterBookingId, "title");?></div>
	                </div>
	            </div>
	        </div>
        </div>

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
	                <label class="col-lg-3 control-label">服务内容</label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo echoInfo($charterBookingId, "title");?></div>
	                </div>
	            </div>
	        </div>
        </div>

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
	                <label class="col-lg-3 control-label">服务内容</label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo echoInfo($charterBookingId, "title");?></div>
	                </div>
	            </div>
	        </div>
        </div>

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
	                <label class="col-lg-3 control-label">服务内容</label>
	                <div class="col-lg-9">
	                    <div class="field-notice" ><?php echo echoInfo($charterBookingId, "title");?></div>
	                </div>
	            </div>
	        </div>
        </div>

        <h4>预订人详情</h4>
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
    </div>
</div>
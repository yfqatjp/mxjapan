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
	                <label class="col-lg-3 control-label"><?php echo $texts['FULLNAME']; ?></label>
	                <div class="col-lg-9">
	                    <div class="field-notice">1111111</div>
	                </div>
	            </div>

	        </div>
	        <div class="col-sm-5">
	            <div class="row form-group">
	                <label class="col-lg-3 control-label"><?php echo $texts['ADDRESS']; ?></label>
	                <div class="col-lg-9">
	                    <div class="field-notice" >2222</div>
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
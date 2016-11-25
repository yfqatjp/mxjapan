<?php
// 前台
require(SYSBASE."common/front.php");

$viewMsg = "";
if ($hotelApp->isPOST()) {
	// 取得预订订单ID
	$charterBookingId = $hotelApp->query("booking_id");

	// 操作Action
	$action =  $hotelApp->query("action");

	//
	$arrData = array();
	if ($action == "cancel") {
		$arrData["status"] = BOOKING_STAUTS_CANCEL;
		// 取消操作
		$hotelApp->updateCharterBookingById($charterBookingId, $arrData);

		// 记录操作日志
		$hotelApp->insertCharterLog("pm_charter_booking", "【状态变更】【".BOOKING_STAUTS_CANCEL."】", $charterBookingId, $_SESSION['user']['id'], $arrData);
		$viewMsg = $hotelApp->getTextsByName("BOOKING_STAUTS_UPDATE_MSG");
	}

	if ($action == "complete") {
		$arrData["status"] = BOOKING_STAUTS_COMPLETE;
		// 操作服务完成
		$hotelApp->updateCharterBookingById($charterBookingId, $arrData);
		// 记录操作日志
		$hotelApp->insertCharterLog("pm_charter_booking", "【状态变更】【".BOOKING_STAUTS_COMPLETE."】", $charterBookingId, $_SESSION['user']['id'], $arrData);
		$viewMsg = $hotelApp->getTextsByName("BOOKING_STAUTS_UPDATE_MSG");
	}

	// 去支付处理
	if ($action == "pay") {
		header("Location: ".DOCBASE.LANG_ALIAS."account/6");
		exit();
	}
}

// 取得包车服务订单一览
$arrCharterHistory = $hotelApp->findChartersHistory();


?>

<?php
if (strlen($viewMsg) > 0) {
?>
<div class="alert alert-success" ><?php echo $viewMsg;?></div>
<?php
}
?>
<form id="charter_form" action="<?php echo DOCBASE.LANG_ALIAS.'account/6'; ?>" method="post">
<input type="hidden" id="action" name="action" value="" />
<input type="hidden" id="booking_id" name="booking_id" value="" />
<table class="table table-bordered table-striped table-booking-history">
    <thead>
        <tr>
            <th>目的地</th>
            <th>标题</th>
            <th>出发日</th>
            <th>爱车信息</th>
            <th>车主姓名</th>
            <th>车主电话</th>
            <th>金额</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
    <?php
		foreach($arrCharterHistory as $i => $row){
			$booking_id = $row['booking_id'];
			$charter_title = $row['title'];
			$charter_alias = $row['alias'];
			$destination = $row["destination"];
			$car_model = $row["car_model"];
			$car_no = $row["car_no"];
			$depart_date = $row["depart_date"];
			$total = $row["total"];
			$status = $row["status"];
			$add_date = $row["add_date"];
			$charter_name = $row["charter_name"];
			$charter_phone = $row["charter_phone"];
	?>
        <tr>
            <td class="booking-history-type">
            	<a href="<?php echo DOCBASE.LANG_ALIAS.'account/7'; ?>?id=<?php echo $booking_id;?>" ><?php echo $destination;?></a>
            </td>
            <td class="booking-history-title"><?php echo $charter_title;?></td>
            <td><?php echo $depart_date;?></td>
            <td><?php echo $car_model."(".$car_no.")";?></td>
            <td><?php echo $charter_name;?></td>
            <td><?php echo $charter_phone;?></td>
            <td><?php echo formatPrice($total*CURRENCY_RATE);?></td>
            <td><?php echo $hotelApp->displayStatusName($status);?></td>
            <td class="text-center">
				<?php
				if ($status == BOOKING_STAUTS_WAITING) {
				?>
            	<a class="btn btn-default btn-sm" href="javascript:void(0);" onclick="submitCharterForm('cancel', <?php echo $booking_id;?>);">取消</a>
            	<a class="btn btn-success btn-sm" href="javascript:void(0);" onclick="submitCharterForm('pay', <?php echo $booking_id;?>);">支付</a>
            	<?php
				} else if ($status == BOOKING_STAUTS_PAYED) {
            	?>
				<a class="btn btn-success btn-sm" href="javascript:void(0);" onclick="submitCharterForm('complete', <?php echo $booking_id;?>);">完成</a>
            	<?php
				}
				?>
            </td>
        </tr>
	<?php
		}
	?>
    </tbody>
</table>
</form>

    <script>
        function submitCharterForm(action, bookingId) {

			$("#action").val(action);
			$("#booking_id").val(bookingId);
			$("#charter_form").submit();
        }
    </script>

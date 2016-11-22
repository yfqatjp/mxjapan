<?php
// 前台
require(SYSBASE."common/front.php");

//
$arrCharterHistory = $hotelApp->findChartersHistory();

?>
<div class="checkbox">
    <label>
        <input class="i-check" type="checkbox" />Show only current trip</label>
</div>
<form action="?" method="post">
<input type="hidden" name="action" value="" />
<input type="hidden" name="action" value="booking" />
<table class="table table-bordered table-striped table-booking-history">
    <thead>
        <tr>
            <th>Destination</th>
            <th>Title</th>
            <th>Depart Date</th>
            <th>Car Info</th>
            <th>Total</th>
            <th>Charter Owner</th>
            <th>Charter Phone</th>
            <th>Cancel</th>
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
            	<i class="fa fa-plane"></i><small><?php echo $destination;?></small>
            </td>
            <td class="booking-history-title"><?php echo $charter_title;?></td>
            <td><?php echo $depart_date;?></td>
            <td><?php echo $car_model."(".$car_no.")";?></td>
            <td><?php echo formatPrice($total*CURRENCY_RATE);?></td>
            <td><?php echo $charter_name;?></td>
            <td><?php echo $charter_phone;?></td>
            <td class="text-center"><a class="btn btn-default btn-sm" href="#">Cancel</a></td>
        </tr>
	<?php 
		}
	?>
    </tbody>
</table>
</form>
<?php
if(isset($db) && $db !== false){
    $result_notice = $db->query("SELECT * FROM pm_notice WHERE lang = ".LANG_ID." AND checked = 1 ORDER BY rank LIMIT 0, 5");

    if($result_notice !== false){
?>
<table class="table table-bordered table-striped table-booking-history">
    <thead>
        <tr>
            <th>Category</th>
            <th>Title</th>
            <th>Level</th>
            <th>Expiration Date</th>
        </tr>
    </thead>
    <tbody>
<?php
		$notice_id = 0;
		foreach($result_notice as $i => $row){
			$notice_id += 1;
			$notice_category = $row['category'];
			$notice_title = $row['title'];
			$notice_text = $row['text'];
			$notice_level = $row['level'];
			$notice_expiration = $row['expiration_date'];
?>
		<tr onclick="show_hide_row('<?php echo $notice_id;?>');">
    	    <td><?php echo $notice_category;?></td>
            <td><?php echo $notice_title;?></td>
	        <td><?php echo $notice_level;?></td>
    	    <td><?php echo $notice_expiration;?></td>
    	</tr>
		<tr id="<?php echo $notice_id;?>" style="display:none;">
    	    <td colspan=4><?php echo $notice_text;?></td>
    	</tr>
<?php
	    }
?>
    </tbody>
</table>
<?php
    } else {
?>
		<div class="checkbox">
			<label>There is no notice.</label>
		</div>
<?php
	}
}
?>

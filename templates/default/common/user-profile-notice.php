<?php
// $today = time();
if(isset($db) && $db !== false){
    $result_notice = $db->query("SELECT * FROM pm_notice WHERE lang = ".LANG_ID." AND checked = 1 ORDER BY rank LIMIT 0, 5");
// 	$result_notice = $db->query("SELECT * FROM pm_notice WHERE lang = ".LANG_ID." AND checked = 1 AND unpublish_date >= ".$today."ORDER BY rank LIMIT 0, 5");

    if($result_notice !== false){
?>
<table class="table table-bordered table-striped table-booking-history">
    <thead>
        <tr>
            <th>No</th>
        	<th>类别</th>
            <th>标题</th>
            <th>优先级</th>
            <th>有效期限</th>
            <th>发布日</th>
        </tr>
    </thead>
    <tbody>
<?php
		$notice_id = 0;
		foreach($result_notice as $i => $row){
			$notice_id += 1;
			$query_category = "SELECT category FROM pm_category WHERE value = ".$row['category']." AND lang = ".LANG_ID;
			$result_category = $db->query($query_category);
			if($result_category !== false && $db->last_row_count() > 0){
				$row_category = $result_category->fetch();
				$notice_category = $row_category['category'];
			} else {
				$notice_category = '-';
			}
			$notice_title = $row['title'];
			$notice_text = $row['text'];
			$query_level = "SELECT level FROM pm_level WHERE value = ".$row['level']." AND lang = ".LANG_ID;
			$result_level = $db->query($query_level);
			if($result_level !== false && $db->last_row_count() > 0){
				$row_level = $result_level->fetch();
				$notice_level = $row_level['level'];
			} else {
				$notice_level = '-';
			}
            $notice_expiration = (is_null($row['expiration_date'])) ? "-" : strftime(DATE_FORMAT." ".TIME_FORMAT, $row['expiration_date']);
            $notice_publish = (is_null($row['publish_date'])) ? "-" : strftime(DATE_FORMAT." ".TIME_FORMAT, $row['publish_date']);
?>
		<tr onclick="show_hide_row('<?php echo $notice_id;?>');">
    	    <td><?php echo $notice_id;?></td>
			<td><?php echo $notice_category;?></td>
            <td><?php echo $notice_title;?></td>
	        <td><?php echo $notice_level;?></td>
    	    <td><?php echo $notice_expiration;?></td>
    	    <td><?php echo $notice_publish;?></td>
    	</tr>
		<tr id="<?php echo $notice_id;?>" style="display:none;">
    	    <td colspan=6><?php echo $notice_text;?></td>
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
			<label>目前没有任何公告。</label>
		</div>
<?php
	}
}
?>

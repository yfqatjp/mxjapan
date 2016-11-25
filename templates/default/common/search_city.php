<?php
require_once("../../../common/lib.php");
require_once("../../../common/define.php");

if(isset($_GET['q']) && $_GET['q'] != ""){

	$q = $_GET['q'];

	$query_destination = db_getSearchRequest($db, "pm_charter_city", array("name"), $q, 6, 0, "", "", "", "", 1);
	$result_destination = $db->query($query_destination);
	if($result_destination !== false){
		foreach($result_destination as $row){
			$city_id	= $row['id'];
			$city_name = $row['name'];

			echo "<a href=\"#\" class=\"live-search-result\" data-id=\"".$city_id."\" data-descr=\"".$city_name."\">".highlight($city_name, $q)."</a>";
		}
	}
}
?>

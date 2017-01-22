<?php
debug_backtrace() || die ("Direct access not permitted");


if(!isset($city_id)) $city_id = 0;
if(!isset($city_name)) $city_name = "";

if (empty($page_alias)) {
	$page_alias = "charters";
}

$arrCity = $hotelApp->getCharterCity();

?>

<form action="<?php echo DOCBASE.$page_alias; ?>" method="post" class="booking-search">
    <div class="row">
		<div class="col-md-2 col-sm-6 col-xs-6">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon">城市</div>
                    <select name="city_id" class="selectpicker form-control">
                    	<option value="" >ALL</option>
                        <?php
                        foreach($arrCity as $id => $city) {
                        	$select = ($city_id == $id) ? " selected=\"selected\"" : "";
                        	echo "<option value=\"".$id."\"".$select.">".$city."</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-1 col-sm-12">
            <div class="form-group">
                <button class="btn btn-block btn-primary" type="submit" name="check_availabilities">GO</button>
            </div>
        </div>
    </div>
</form>

<?php
if(!isset($max_adults_search) || !isset($max_children_search)){
    $result_max = $db->query("SELECT MAX(max_adults) as max_a, MAX(max_children) as max_c FROM pm_room WHERE checked = 1");
    if($result_max !== false && $db->last_row_count() == 1){
        $row = $result_max->fetch();
        $max_adults_search = $row['max_a'];
        $max_children_search = $row['max_c'];
    }else{
        $max_adults_search = 15;
        $max_children_search = 14;
    }
}

if(!isset($num_adults))
    $num_adults = (isset($_SESSION['book']['adults'])) ? $_SESSION['book']['adults'] : 1;
if(!isset($num_children))
    $num_children = (isset($_SESSION['book']['children'])) ? $_SESSION['book']['children'] : 0;

if(!isset($from_time) || !is_numeric($from_time))
    $from_time = (isset($_SESSION['book']['from_date'])) ? $_SESSION['book']['from_date'] : time();
if(!isset($to_time) || !is_numeric($to_time))
    $to_time = (isset($_SESSION['book']['to_date'])) ? $_SESSION['book']['to_date'] : time()+86400;

if(!isset($from_date)) $from_date = date("j/m/Y", $from_time);
if(!isset($to_date)) $to_date = date("j/m/Y", $to_time); ?>

<form action="<?php echo DOCBASE.$sys_pages['booking']['alias']; ?>" method="post" class="booking-search">
    <?php
    if(isset($hotel_id)){ ?>
        <input type="hidden" name="hotel_id" value="<?php echo $hotel_id; ?>">
        <?php
    } ?>
    <div class="row">
        <div class="col-md-3 col-sm-6">
            <div class="form-group">
                <label class="sr-only" for="from"></label>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-calendar"></i> <?php echo $texts['CHECK_IN']; ?></div>
                    <input type="text" class="form-control" id="from_picker" name="from_date" value="<?php echo $from_date; ?>">
                </div>
                <div class="field-notice" rel="from_date"></div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-calendar"></i> <?php echo $texts['CHECK_OUT']; ?></div>
                    <input type="text" class="form-control" id="to_picker" name="to_date" value="<?php echo $to_date; ?>">
                </div>
                <div class="field-notice" rel="to_date"></div>
            </div>
        </div>
        <div class="col-md-2 col-sm-6">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-male"></i> <?php echo $texts['ADULTS']; ?></div>
                    <select name="num_adults" class="selectpicker form-control">
                        <?php
                        for($i = 1; $i <= $max_adults_search; $i++){
                            $select = ($num_adults == $i) ? " selected=\"selected\"" : "";
                            echo "<option value=\"".$i."\"".$select.">".$i."</option>";
                        } ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-6">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-male"></i> <?php echo $texts['CHILDREN']; ?></div>
                    <select name="num_children" class="selectpicker form-control">
                        <?php
                        for($i = 0; $i <= $max_children_search; $i++){
                            $select = ($num_children == $i) ? " selected=\"selected\"" : "";
                            echo "<option value=\"".$i."\"".$select.">".$i."</option>";
                        } ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-12">
            <div class="form-group">
                <button class="btn btn-block btn-primary" type="submit" name="check_availabilities"><i class="fa fa-search"></i> <?php echo $texts['CHECK']; ?></button>
            </div>
        </div>
    </div>
</form>

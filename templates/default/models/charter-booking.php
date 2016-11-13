<?php


$msg_error = "";
$msg_success = "";
$field_notice = array();

$id = 0;
$lastname = "";
$firstname = "";
$email = "";
$address = "";
$postcode = "";
$city = "";
$company = "";
$country = "";
$mobile = "";
$phone = "";
$comments = "";

if(isset($_SESSION['user'])){
	$result_user = $db->query("SELECT * FROM pm_user WHERE id = ".$db->quote($_SESSION['user']['id'])." AND checked = 1");
	if($result_user !== false && $db->last_row_count() > 0){
		$row = $result_user->fetch();

		$lastname = $row['name'];
		$email = $row['email'];
		$address = $row['address'];
		$postcode = $row['postcode'];
		$city = $row['city'];
		$company = $row['company'];
		$country = $row['country'];
		$mobile = $row['mobile'];
		$phone = $row['phone'];
	}
}

require(getFromTemplate("common/header.php", false)); ?>

<section id="page">
    
    <?php include(getFromTemplate("common/page_header.php", false)); ?>
    
    <div id="content" class="pt30 pb30">
        <div class="container">

            <div class="alert alert-success" style="display:none;"></div>
            <div class="alert alert-danger" style="display:none;"></div>
            
            <form method="post" action="<?php echo DOCBASE.$page['alias']; ?>" class="ajax-form">
                <div class="row">
                    <div class="col-md-6">
                        <fieldset>
                            <legend><?php echo $texts['CONTACT_DETAILS']; ?></legend>
            
                            <div class="row form-group">
                                <label class="col-lg-3 control-label"><?php echo $texts['LASTNAME']; ?> *</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="lastname" value="<?php echo $lastname; ?>"/>
                                    <div class="field-notice" rel="lastname"></div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-lg-3 control-label"><?php echo $texts['FIRSTNAME']; ?> *</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="firstname" value="<?php echo $firstname; ?>"/>
                                    <div class="field-notice" rel="firstname"></div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-lg-3 control-label"><?php echo $texts['EMAIL']; ?> *</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="email" value="<?php echo $email; ?>"/>
                                    <div class="field-notice" rel="email"></div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-lg-3 control-label"><?php echo $texts['COMPANY']; ?></label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="company" value="<?php echo $company; ?>"/>
                                    <div class="field-notice" rel="company"></div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-lg-3 control-label"><?php echo $texts['ADDRESS']; ?> *</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="address" value="<?php echo $address; ?>"/>
                                    <div class="field-notice" rel="address"></div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-lg-3 control-label"><?php echo $texts['POSTCODE']; ?> *</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="postcode" value="<?php echo $postcode; ?>"/>
                                    <div class="field-notice" rel="postcode"></div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-lg-3 control-label"><?php echo $texts['CITY']; ?> *</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="city" value="<?php echo $city; ?>"/>
                                    <div class="field-notice" rel="city"></div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-lg-3 control-label"><?php echo $texts['COUNTRY']; ?> *</label>
                                <div class="col-lg-9">
                                    <select class="form-control" name="country">
                                        <option value="0">-</option>
                                        <?php
                                        $result_country = $db->query("SELECT * FROM pm_country");
                                        if($result_country !== false){
                                            foreach($result_country as $i => $row){
                                                $id_country = $row['id'];
                                                $country_name = $row['name'];
                                                $selected = ($country == $country_name) ? " selected=\"selected\"" : "";
                                                
                                                echo "<option value=\"".$country_name."\"".$selected.">".$country_name."</option>";
                                            }
                                        } ?>
                                    </select>
                                    <div class="field-notice" rel="country"></div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-lg-3 control-label"><?php echo $texts['PHONE']; ?> *</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>"/>
                                    <div class="field-notice" rel="phone"></div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-lg-3 control-label"><?php echo $texts['MOBILE']; ?></label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="mobile" value="<?php echo $mobile; ?>"/>
                                    <div class="field-notice" rel="mobile"></div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-md-6">
                        <fieldset class="mb20">
                            <legend><?php echo $texts['BOOKING_DETAILS']; ?></legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <h3><?php echo $_SESSION['book']['hotel']; ?></h3>
                                    <h4><?php echo $_SESSION['book']['room']; ?></h4>
                                    <p>
                                        <?php
                                        echo $texts['CHECK_IN']." <strong>".strftime(DATE_FORMAT, $_SESSION['book']['from_date'])."</strong><br>
                                        ".$texts['CHECK_OUT']." <strong>".strftime(DATE_FORMAT, $_SESSION['book']['to_date'])."</strong><br>
                                        <strong>".$_SESSION['book']['nights']."</strong> ".$texts['NIGHTS']." -
                                        <strong>".($_SESSION['book']['adults']+$_SESSION['book']['children'])."</strong> ".$texts['PERSONS']; ?>
                                    </p>
                                </div>
                                <?php
                                if(isset($_SESSION['book']['amount_rooms'])){ ?>
                                    <div class="col-md-6">
                                        <span class="pull-right lead">
                                            <?php echo formatPrice($_SESSION['book']['amount_rooms']*CURRENCY_RATE); ?><br/>
                                        </span>
                                    </div>
                                    <?php
                                } ?>
                            </div>
                            <?php
                            if(ENABLE_TOURIST_TAX == 1 && isset($_SESSION['book']['tourist_tax'])){ ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>
                                            <strong><?php echo $texts['TOURIST_TAX']; ?></strong>
                                            <span class="pull-right"><?php echo formatPrice($_SESSION['book']['tourist_tax']*CURRENCY_RATE); ?></span>
                                        </p>
                                    </div>
                                </div>
                                <?php
                            } ?>
                        </fieldset>
                        <?php
                        if(isset($_SESSION['book']['activities']) && count($_SESSION['book']['activities']) > 0){ ?>
                            <fieldset class="mb20">
                                <legend><?php echo $texts['ACTIVITIES']; ?></legend>
                                <?php
                                foreach($_SESSION['book']['activities'] as $id_activity => $activity){ ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>
                                                <?php
                                                echo "<strong>".$activity['title']."</strong> - ".$activity['duration']."<br>
                                                <strong>".strftime(DATE_FORMAT." ".TIME_FORMAT, $activity['session_date'])."</strong> -
                                                <strong>".($activity['adults']+$activity['children'])."</strong> ".$texts['PERSONS']; ?>
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <span class="pull-right">
                                                <?php echo formatPrice($activity['amount']*CURRENCY_RATE); ?><br/>
                                            </span>
                                        </div>
                                    </div>
                                    <?php
                                } ?>
                            </fieldset>
                            <?php
                        } ?>
                        <fieldset class="mb20">
                            <legend><?php echo $texts['EXTRA_SERVICES']; ?></legend>
                            <?php
                            $result_service = $db->query("SELECT * FROM pm_service WHERE rooms REGEXP '(^|,)".$_SESSION['book']['room_id']."(,|$)' AND lang = ".LANG_ID." AND checked = 1 ORDER BY rank");
                            if($result_service !== false){
                                $action = getFromTemplate("common/update_booking.php");
                                foreach($result_service as $i => $row){
                                    $id_service = $row['id'];
                                    $service_title = $row['title'];
                                    $service_descr = $row['descr'];
                                    $service_long_descr = $row['long_descr'];
                                    $service_price = $row['price'];
                                    $service_type = $row['type'];

                                    if($service_type == "person") $service_price *= $_SESSION['book']['adults']+$_SESSION['book']['children'];
                                    if($service_type == "person-night" || $service_type == "qty-person-night") $service_price *= ($_SESSION['book']['adults']+$_SESSION['book']['children'])*$_SESSION['book']['nights'];
                                    if($service_type == "qty-night" || $service_type == "night") $service_price *= $_SESSION['book']['nights'];

                                    $checked = array_key_exists($id_service, $_SESSION['book']['extra_services']) ? " checked=\"checked\"" : ""; ?>

                                    <div class="row form-group">
                                        <label class="col-sm-<?php echo (strpos($service_type, "qty") !== false) ? 7 : 10; ?> col-xs-9 control-label">
                                            <input type="checkbox" name="extra_services[]" value="<?php echo $id_service; ?>" class="sendAjaxForm" data-action="<?php echo $action; ?>" data-target="#total_booking"<?php echo $checked;?>>
                                            <?php
                                            echo $service_title;
                                            if($service_descr != ""){ ?>
                                                <br><small><?php echo $service_descr; ?></small>
                                                <?php
                                            }
                                            if($service_long_descr != ""){ ?>
                                                <br><small><a href="#service_<?php echo $id_service; ?>" class="popup-modal"><?php echo $texts['READMORE']; ?></a></small>
                                                <div id="service_<?php echo $id_service; ?>" class="white-popup-block mfp-hide">
                                                    <?php echo $service_long_descr; ?>
                                                </div>
                                                <?php
                                            } ?>
                                        </label>
                                        <?php
                                        if(strpos($service_type, "qty") !== false){
                                            $qty = isset($_SESSION['book']['extra_services'][$id_service]['qty']) ? $_SESSION['book']['extra_services'][$id_service]['qty'] : 1; ?>
                                            <div class="col-sm-3 col-xs-9">
                                                <div class="input-group">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-default btn-number" data-field="qty_service_<?php echo $id_service; ?>" data-type="minus" disabled="disabled" type="button">
                                                            <i class="fa fa-minus"></i>
                                                        </button>
                                                    </span>
                                                    <input class="form-control input-number sendAjaxForm" type="text" max="20" min="1" value="<?php echo $qty; ?>" name="qty_service_<?php echo $id_service; ?>" data-action="<?php echo $action; ?>" data-target="#total_booking">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-default btn-number" data-field="qty_service_<?php echo $id_service; ?>" data-type="plus" type="button">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                            <?php
                                        } ?>
                                        <div class="col-sm-2 col-xs-3 text-right">
                                            <?php
                                            if(strpos($service_type, "qty") !== false) echo "x ";
                                            echo formatPrice($service_price*CURRENCY_RATE); ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } ?>
                        </fieldset>
                        <?php
                        if(isset($_SESSION['book']['amount_rooms'])){
                            $total = $_SESSION['book']['amount_rooms']+$_SESSION['book']['tourist_tax']+$_SESSION['book']['amount_activities']+$_SESSION['book']['amount_services'];
                            $vat_total = $_SESSION['book']['vat_rooms']+$_SESSION['book']['vat_activities']+$_SESSION['book']['vat_services'];  ?>
                            <hr>
                            <div class="row">
                                <div class="col-xs-6">
                                    <h3>
                                        <?php
                                        echo $texts['TOTAL'];
                                        if($vat_total > 0) echo " ".$texts['INCL_VAT']; ?>
                                    </h3>
                                    
                                    <?php if($vat_total > 0) echo $texts['VAT_AMOUNT']; ?>
                                </div>
                                <div class="col-xs-6 lead text-right">
                                    <span id="total_booking">
                                        <?php echo formatPrice($total*CURRENCY_RATE); ?><br>
                                        
                                        <?php
                                        if($vat_total > 0){ ?>
                                            <small>
                                                <?php echo formatPrice($vat_total*CURRENCY_RATE); ?>
                                            </small>
                                            <?php
                                        } ?>
                                    </span>
                                </div>
                            </div>
                            <?php
                        } ?>
                        <fieldset>
                            <legend><?php echo $texts['SPECIAL_REQUESTS']; ?></legend>
                            <div class="form-group">
                                <textarea class="form-control" name="comments"><?php echo $comments; ?></textarea>
                                <div class="field-notice" rel="comments"></div>
                            </div>
                            <p><?php //echo $texts['BOOKING_TERMS']; ?></p>
                        </fieldset>
                    </div>
                </div>
                
                <a class="btn btn-default btn-lg pull-left" href="<?php echo (isset($_SESSION['book']['activities'])) ? DOCBASE.$sys_pages['booking-activities']['alias'] : DOCBASE.$sys_pages['booking']['alias']; ?>"><i class="fa fa-angle-left"></i> <?php echo $texts['PREVIOUS_STEP']; ?></a>
                <?php
                if(isset($_SESSION['book']['amount_rooms'])){ ?>
                    <button type="submit" class="btn btn-primary btn-lg pull-right" name="book"><?php echo $texts['NEXT_STEP']; ?> <i class="fa fa-angle-right"></i></button>
                    <?php
                }else{ ?>
                    <button type="submit" class="btn btn-primary btn-lg pull-right" name="request"><i class="fa fa-send"></i> <?php echo $texts['MAKE_A_REQUEST']; ?></button>
                    <?php
                } ?>
            </form>
        </div>
    </div>
</section>

<?php
if($article_alias == "") err404();
// 前台
require(SYSBASE."common/front.php");
$field_notice = array();
$msg_error = $hotelApp->getBookingCheckMsg();
$msg_success = "";
// 包车服务
$arrCharter = array();
// 包车详情
$arrCharterInfo = array();
// 车主信息
$arrCharterOwner = array();
// 车主信息
$arrCharterOwnerInfo = array();

// 包车路线
$arrCharterLines = array();

// 包车服务的ID
$charterId = 0;

$result = $db->query("SELECT * FROM pm_charter WHERE checked = 1 AND lang = ".LANG_ID." AND alias = ".$db->quote($article_alias));
if($result !== false && $db->last_row_count() == 1){
    $arrCharter = $result->fetch(PDO::FETCH_ASSOC);
    $charterId = $arrCharter['id'];
    $title_tag = $arrCharter['title']." - ".$title_tag;
    $page_title = $arrCharter['title'];
    $page_subtitle = "";
    $page_alias = DOCBASE.$pages[$page_id]['alias']."/".text_format($arrCharter['alias']);
}else err404();

check_URI($page_alias);

/* ==============================================
 * CSS AND JAVASCRIPT USED IN THIS MODEL
 * ==============================================
 */
$javascripts[] = DOCBASE."js/plugins/jquery.sharrre-1.3.4/jquery.sharrre-1.3.4.min.js";

$javascripts[] = DOCBASE."js/plugins/jquery.event.calendar/js/jquery.event.calendar.js";
$javascripts[] = DOCBASE."js/plugins/jquery.event.calendar/js/languages/jquery.event.calendar.".LANG_TAG.".js";
$stylesheets[] = array("file" => DOCBASE."js/plugins/jquery.event.calendar/css/jquery.event.calendar.css", "media" => "all");

$stylesheets[] = array("file" => DOCBASE."js/plugins/owl-carousel/owl.carousel.css", "media" => "all");
$stylesheets[] = array("file" => DOCBASE."js/plugins/owl-carousel/owl.theme.css", "media" => "all");
$javascripts[] = DOCBASE."js/plugins/owl-carousel/owl.carousel.min.js";

$stylesheets[] = array("file" => DOCBASE."js/plugins/star-rating/css/star-rating.min.css", "media" => "all");
$javascripts[] = DOCBASE."js/plugins/star-rating/js/star-rating.min.js";

$stylesheets[] = array("file" => DOCBASE."js/plugins/isotope/css/style.css", "media" => "all");
$javascripts[] = DOCBASE."js/plugins/isotope/jquery.isotope.min.js";
$javascripts[] = DOCBASE."js/plugins/isotope/jquery.isotope.sloppy-masonry.min.js";

$stylesheets[] = array("file" => DOCBASE."js/plugins/lazyloader/lazyloader.css", "media" => "all");
$javascripts[] = DOCBASE."js/plugins/lazyloader/lazyloader.js";

$stylesheets[] = array("file" => DOCBASE."js/plugins/live-search/jquery.liveSearch.css", "media" => "all");
$javascripts[] = DOCBASE."js/plugins/live-search/jquery.liveSearch.js";

// 包车服务详情
$result = $db->query("SELECT * FROM pm_charter_info WHERE id_charter = ".$charterId);
if($result !== false && $db->last_row_count() == 1){
	$arrCharterInfo = $result->fetch(PDO::FETCH_ASSOC);
}

//
$arrCharterItem = array();
$result = $db->query("SELECT t1.*, t2.file, t2.id as fileid FROM pm_charter_item t1 left join pm_charter_item_file t2 ON ( t1.id = t2.id_item and t2.lang = t1.lang ) WHERE  t1.lang = ".DEFAULT_LANG);
if($result !== false){
	foreach($result as $row) {
		$arrCharterItem[$row["id"]]["name"] = $row["name"];
		$arrCharterItem[$row["id"]]["file"] = $row["file"];
		$arrCharterItem[$row["id"]]["file_id"] = $row["fileid"];
	}
}

// 包含的费用
$haveFeeName = "";
$notHaveFeeName = "";
$arrFeeName = array();
$result = $db->query("SELECT t1.* FROM pm_charter_cost t1 WHERE  t1.lang = ".DEFAULT_LANG);
if($result !== false){
	foreach($result as $row) {
		$arrFeeName[$row["id"]] = $row["name"];
	}
}
if (count($arrFeeName) > 0 ) {
	//
	$arrFeeItem = array();
	if (isset($arrCharterInfo["fee_item"]) && !empty($arrCharterInfo["fee_item"])) {
		$arrFeeItem = explode(",", $arrCharterInfo["fee_item"]);
	}

	foreach($arrFeeName as $feeId => $feeName) {
		if (array_key_exists($feeId, $arrFeeItem)) {
			$haveFeeName .= $feeName.",";
		} else {
			$notHaveFeeName .= $feeName.",";
		}
	}
	if (!empty($haveFeeName)) {$haveFeeName = substr($haveFeeName, 0, strlen($haveFeeName)-1); }
	if (!empty($notHaveFeeName)) {$notHaveFeeName = substr($notHaveFeeName, 0, strlen($notHaveFeeName)-1); }
}
//

// 包车游玩的场合
if (isset($arrCharter["charter_type"]) && $arrCharter["charter_type"] == "2") {
	$arrCharterLines = $db->query("SELECT * FROM pm_charter_line WHERE id_charter = ".$charterId);
}

// 车主的上传的图片
$arrCharterOwnerFile = array();
$arrCharterOwnerFile[1] = array();
$arrCharterOwnerFile[2] = array();
$arrCharterOwnerFile[3] = array();
// 取得车主信息
if (isset($arrCharter["id_user"])) {
	$arrCharterOwner = $db->query("SELECT * FROM pm_user WHERE id = ".$arrCharter["id_user"]);
	if($arrCharterOwner !== false){
		$arrCharterOwner = $arrCharterOwner->fetch(PDO::FETCH_ASSOC);
	}

	// 车主详细情报
	$queryResult = $db->query("SELECT * FROM pm_charter_user WHERE user_id = ".$arrCharter["id_user"]);
	if($queryResult !== false){
		$arrCharterOwnerInfo = $queryResult->fetch(PDO::FETCH_ASSOC);

		//
		$query_file = "SELECT * FROM pm_charter_user_file WHERE user_id = ".$db->quote($arrCharter["id_user"]);
		$query_file .= " ORDER BY type asc, id asc ";
		$result_file = $db->query($query_file);

		if ($result_file != null && count($result_file) > 0) {
			foreach ($result_file as $file_row) {
				$type = $file_row["type"];
				if (!array_key_exists($type, $arrCharterOwnerFile)) {
					$arrCharterOwnerFile[$type] = array();
				}
				$arrCharterOwnerFile[$type][] = $file_row;
			}
		}
	}
}

//
$arrCharterGuaranteed = array();
$result = $db->query("SELECT t1.*, t2.file, t2.id as fileid FROM pm_charter_guaranteed t1 left join pm_charter_guaranteed_file t2 ON ( t1.id = t2.id_item and t2.lang = t1.lang ) WHERE  t1.lang = ".DEFAULT_LANG);
if($result !== false){
	foreach($result as $row) {
		$arrCharterGuaranteed[$row["id"]]["name"] = $row["name"];
		$arrCharterGuaranteed[$row["id"]]["content"] = $row["content"];
		$arrCharterGuaranteed[$row["id"]]["file"] = $row["file"];
		$arrCharterGuaranteed[$row["id"]]["file_id"] = $row["fileid"];
	}
}

// 安全考虑
$token = $hotelApp->getToken();

function echoInfo($arr, $key){
	if (isset($arr[$key])) {
		return $arr[$key];
	} else {
		return "";
	}
}

//
require(SYSBASE."templates/".TEMPLATE."/common/header.php");

?>

<section id="page">

    <?php include(getFromTemplate("common/page_header.php", false)); ?>

    <div id="content" class="pb30">

        <div class="container" >
            <div class="alert alert-success" style="display:none;"></div>
            <div class="alert alert-danger" style="display:none;"><?php echo $msg_error;?></div>
        </div>

    	<form method="post" action="<?php echo DOCBASE.$sys_pages['charter-booking']['alias']; ?>">

    	<input type="hidden" name="charter_id" value="<?php echo $arrCharter['id']; ?>" />
    	<input type="hidden" name="charter_alias" value="<?php echo $arrCharter['alias']; ?>" />
    	<input type="hidden" name="<?php echo $hotelApp->token_name; ?>" value="<?php echo $token; ?>" />

        <article class="container pt20">
            <div class="row">
                <div class="col-md-8 mb20">
                    <div class="row mb10">
                        <div class="col-sm-8">
                            <h1 class="mb0"><?php echo $arrCharter['title']; ?></h1>
                            <div class="clearfix"></div>
                            <h2><?php echo $arrCharter['subtitle']; ?></h2>
                        </div>
                        <div class="col-sm-4 text-right">
                            <div class="price text-primary">
                                <?php
                                $min_price = 0;
                                if (isset($arrCharterInfo['fee'])) {
                                	$min_price = $arrCharterInfo['fee'];
                                }
                                if($min_price > 0){
                                ?>
                                	<i class="fa fa-map-marker"></i><?php echo $arrCharter["destination"]; ?>
                                    <span itemprop="priceRange">
                                        <?php echo formatPrice($min_price*CURRENCY_RATE); ?>
                                    </span>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <div class="row mb10">
                        <div class="col-md-12">
                            <div class="owl-carousel owlWrapper" data-items="1" data-autoplay="true" data-dots="true" data-nav="false" data-rtl="<?php echo (RTL_DIR) ? "true" : "false"; ?>">
                                <?php
                                $result_file = $db->query("SELECT * FROM pm_charter_file WHERE id_item = ".$charterId." AND checked = 1 AND lang = ".DEFAULT_LANG." AND type = 'image' AND file != '' ORDER BY rank");
                                if($result_file !== false){

                                    foreach($result_file as $i => $row){

                                        $file_id = $row['id'];
                                        $filename = $row['file'];
                                        $label = $row['label'];

                                        $realpath = SYSBASE."medias/charter/big/".$file_id."/".$filename;
                                        $thumbpath = DOCBASE."medias/charter/big/".$file_id."/".$filename;

                                        if(is_file($realpath)){ ?>
                                            <img alt="<?php echo $label; ?>" src="<?php echo $thumbpath; ?>" class="img-responsive" style="max-height:600px;"/>
                                            <?php
                                        }
                                    }
                                } ?>
                            </div>
                        </div>
                    </div>


                    <div class="tabbable booking-details-tabbable">
                    	<ul class="nav nav-tabs" id="myTab">
                            <li class="active"><a href="#tab-1" data-toggle="tab"><i class="fa fa-camera"></i>图文详情</a>
                            </li>
                            <li><a href="#guaranteed-tab" data-toggle="tab"><i class="fa fa-legal"></i>交易保障</a>
                            </li>
                        </ul>

                    	<div class="tab-content">
                    		<div class="tab-pane fade in active" id="tab-1">
			                    <div class="row mb10">
			                        <div class="col-md-12" itemprop="description">
										<?php
			                            echo $arrCharter['descr'];
			                            ?>
			                        </div>
			                    </div>
			    				<!--  -->
			    				<?php
			    				if ($arrCharterInfo != null && count($arrCharterInfo) > 0) {
			    					if (isset($arrCharterItem[1])) {
			    						$realpath = SYSBASE."medias/charter_item/big/".$arrCharterItem[1]["file_id"]."/".$arrCharterItem[1]["file"];
			    						$thumbpath = DOCBASE."medias/charter_item/big/".$arrCharterItem[1]["file_id"]."/".$arrCharterItem[1]["file"];
			    				?>
				                    <div class="row">
				                        <div class="col-md-12">
											<!-- Comments -->
										    <h3 class="mb10">
										    <?php if(is_file($realpath)) {?>
										    <img src="<?php echo $thumbpath; ?>" alt="" style="width:25px;">
										    <?php
			    							}
										    echo $arrCharterItem[1]["name"]; ?>
										    </h3>

					                        <section class="clearfix">
						                        <div class="media row">
									                <div class="col-sm-3">汽车品牌:</div>
									                <div class="text-right col-sm-8"><?php echo $arrCharterInfo["car_brand"]; ?></div>
									            </div>
									            <div class="media row">
									                <div class="col-sm-3">汽车型号:</div>
									                <div class="text-right col-sm-8"><?php echo $arrCharterInfo["car_model"]; ?></div>
									            </div>
									            <div class="media row">
									                <div class="col-sm-3">车牌号:</div>
									                <div class="text-right col-sm-8"><?php echo $arrCharterInfo["car_no"]; ?></div>
									            </div>
									            <div class="media row">
									                <div class="col-sm-3">座位:</div>
									                <div class="text-right col-sm-8"><?php echo $arrCharterInfo["car_seat"]; ?>座</div>
									            </div>
									            <div class="media row">
									                <div class="col-sm-3">驾龄:</div>
									                <div class="text-right col-sm-8"><?php echo $arrCharterInfo["driving_year"]; ?>年</div>
									            </div>
									            <div class="media row">
									                <div class="col-sm-3">行李数量</div>
									                <div class="text-right col-sm-8"><?php echo $arrCharterInfo["luggage"]; ?>座</div>
									            </div>
									            <div class="media row">
									                <div class="col-sm-3">乘客保险</div>
									                <div class="text-right col-sm-8"><?php echo $arrCharterInfo["safe"]; ?></div>
									            </div>
										    </section>
									    </div>
				                    </div>
								<?php
			    					}

			    					if (isset($arrCharterItem[2])) {
			    						$realpath = SYSBASE."medias/charter_item/big/".$arrCharterItem[2]["file_id"]."/".$arrCharterItem[2]["file"];
			    						$thumbpath = DOCBASE."medias/charter_item/big/".$arrCharterItem[2]["file_id"]."/".$arrCharterItem[2]["file"];
			    				?>

			                    <div class="row">
				                        <div class="col-md-12">
											<!-- Comments -->
										    <h3 class="mb10">
										    <?php if(is_file($realpath)) {?>
										    <img src="<?php echo $thumbpath; ?>" alt="" style="width:25px;">
										    <?php
			    							}
										    echo $arrCharterItem[2]["name"]; ?>
										    </h3>

					                        <section class="clearfix">
						                        <div class="media row">
									                <div class="col-sm-3">包含:</div>
									                <div class="text-right col-sm-8"><?php echo $haveFeeName; ?></div>
									            </div>

									            <div class="media row">
									                <div class="col-sm-3">不包含:</div>
									                <div class="text-right col-sm-8"><?php echo $notHaveFeeName; ?></div>
									            </div>
										    </section>
									    </div>
				                    </div>
								<?php
			    					}
			    					if (count($arrCharterItem) >= 3) {
			    						for ($i = 3; $i <= count($arrCharterItem); $i++ ) {
			    							$realpath = SYSBASE."medias/charter_item/big/".$arrCharterItem[$i]["file_id"]."/".$arrCharterItem[$i]["file"];
			    							$thumbpath = DOCBASE."medias/charter_item/big/".$arrCharterItem[$i]["file_id"]."/".$arrCharterItem[$i]["file"];
			    				?>
			    				<div class="row">
			    					<div class="col-md-12">
											<!-- Comments -->
										    <h3 class="mb10">
										    <?php if(is_file($realpath)) {?>
										    <img src="<?php echo $thumbpath; ?>" alt="" class="">
										    <?php
			    							}
										    echo $arrCharterItem[$i]["name"]; ?>
										    </h3>
									</div>
			    					<div class="col-md-12" itemprop="description">
			                            <?php
			                            $notekey = 'note'.($i-2);
			                            echo $arrCharterInfo[$notekey];
			                            ?>
			                        </div>
			                    </div>
			                      <?php
			    						}
			    					}
			    				}
			    				?>
			    			</div><!-- tab1 -->

			    			<div class="tab-pane fade" id="guaranteed-tab">
			    				<?php
			    					if ($arrCharterGuaranteed != null && count($arrCharterGuaranteed) > 0) {

			    						foreach($arrCharterGuaranteed as $key => $guaranteedInfo) {

			    						$realpath = SYSBASE."medias/charter_guaranteed/big/".$guaranteedInfo["file_id"]."/".$guaranteedInfo["file"];
			    						$thumbpath = DOCBASE."medias/charter_guaranteed/big/".$guaranteedInfo["file_id"]."/".$guaranteedInfo["file"];
			    						?>
                                    <div class="row">
                                    	<?php if(!empty($guaranteedInfo["content"])) {?>
                                    		<div class="col-md-12" itemprop="description">
                                    			<?php echo $guaranteedInfo["content"]; ?>
                                    		</div>
                                    	<?php
			    							}
			    							?>
			    						<div class="col-md-12">
			    							<?php if(is_file($realpath)) {?>
										    	<img src="<?php echo $thumbpath; ?>" alt="" class="">
										    <?php
			    							}
			    							?>
			    						</div>
			    					</div>
			    					 <?php
			    					}
			    				}
			    				?>
                            </div>

	    				</div> <!-- tab-content end -->
    				</div> <!-- tabbable end -->

                    <div class="row">
    					<div class="col-md-12">
							<button type="submit" name="confirm_booking" class="btn btn-primary btn-lg pull-right"><?php echo $texts['CONFIRM_BOOKING']; ?> <i class="fa fa-angle-right"></i></button>
						</div>
                    </div>

                </div>

                <aside class="col-md-4 mb20">
                    <div class="boxed">
                        <div >
                            <h3 itemprop="name"><?php echo echoInfo($arrCharterOwnerInfo, "user_name");?></h3>
                            
                        </div>
						<?php if (count($arrCharterOwnerFile[3]) > 0 ) {?>
                            <div class="owl-carousel owlWrapper" data-items="1" data-autoplay="true" data-dots="true" data-nav="false" data-rtl="<?php echo (RTL_DIR) ? "true" : "false"; ?>">
                                <?php
                                
                                foreach($arrCharterOwnerFile[3] as $row_file){
                                
                                	$filename = $row_file['file'];
                                	$id_file = $row_file['id'];
                                	$type = $row_file['type'];
                                	$userId = $row_file['user_id'];
                                	$file_path = "medias/charter_user/".$userId."/".$id_file."/".$filename;
                                	
                                    if(is_file($file_path)){ ?>
                                    <img src="<?php echo DOCBASE.$file_path; ?>" class="img-responsive" style="max-height:200px;">
                                   <?php
                                    }
                                } ?>
                            </div>
						<?php } ?>
						
						<div >
                            <h3 itemprop="name">联系方式：<?php echo echoInfo($arrCharterOwnerInfo, "mobile");?></h3>
                            <h3 itemprop="name">自我评价：<?php echo echoInfo($arrCharterOwnerInfo, "self_comment");?></h3>
                            <h3 itemprop="name">驾龄：<?php echo echoInfo($arrCharterOwnerInfo, "drive_year");?></h3>
                        </div>
						
                        <!-- TODO::路线设定 -->
                        
                        
                        
                        
                        
                    </div>
                </aside>
            </div>
        </article>
        </form>
    </div>
</section>

    <script>
      <?php
      	if (!empty($msg_error)) {
      ?>
		$(".alert-danger").show();
      <?php
		}
      ?>
    </script>


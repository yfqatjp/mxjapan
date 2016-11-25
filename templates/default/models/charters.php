<?php
// 前台
require(SYSBASE."common/front.php");

$field_notice = array();
$msg_error = $hotelApp->getBookingCheckMsg();
$msg_success = "";
$response = "";
//$room_stock = 1;
//$max_people = 30;

// 检索的条件
$arrContidion = array();

if ($page_alias == "pickup") {
	// 包车接送
	$arrContidion["charter_type"] = "1";
}
if ($page_alias == "charters") {
	// 包车游玩
	$arrContidion["charter_type"] = "2";
}

$city_id = $hotelApp->query("city_id", "");
if (!empty($city_id)) {
	$arrContidion["charter_city"] = $city_id;
}
// 检索结果的取得
$arrResult = array();
// 总页码
$totalPage = 0;
$offset = intval($hotelApp->query("page", 1));
$limit = 9;
$num_records = 0;
// 没有错误的场合
if(count($field_notice) == 0){
	// 检索条件的设定
	$arrContidion["offset"] = $offset;
	$arrContidion["limit"] = $limit;
	//
	$countSql = $hotelApp->getChartersSql($arrContidion, true);
	$result = $db->query($countSql);
	if($result !== false){
		$num_records = $result->fetchColumn(0);
		$totalPage = ceil($num_records/$limit);
	}
	//
	if ($num_records > 0) {
		// 检索的sql
		$searchSql = $hotelApp->getChartersSql($arrContidion);
		// 检索结果的取得
		$arrResult = $db->query($searchSql);
	}
	//
    if(empty($arrResult)) $msg_error .= $texts['NO_AVAILABILITY'];
}

// 默认id
$charter_id = 0;

$result_file = $db->prepare("SELECT * FROM pm_charter_file WHERE id_item = :charter_id AND checked = 1 AND lang = ".LANG_ID." AND type = 'image' AND file != '' ORDER BY rank LIMIT 1");
$result_file->bindParam(":charter_id", $charter_id);

//
if(isset($_GET['action'])){
    if($_GET['action'] == "confirm")
        $msg_success .= "<p class=\"text-center lead\">".$texts['PAYMENT_SUCCESS_NOTICE']."</p>";
    elseif($_GET['action'] == "cancel")
        $msg_error .= "<p class=\"text-center lead\">".$texts['PAYMENT_CANCEL_NOTICE']."</p>";
}


/* ==============================================
 * CSS AND JAVASCRIPT USED IN THIS MODEL
 * ==============================================
 */
$javascripts[] = DOCBASE."js/plugins/jquery.event.calendar/js/jquery.event.calendar.js";

if(is_file(SYSBASE."js/plugins/jquery.event.calendar/js/languages/jquery.event.calendar.".LANG_TAG.".js"))
	$javascripts[] = DOCBASE."js/plugins/jquery.event.calendar/js/languages/jquery.event.calendar.".LANG_TAG.".js";
	else
		$javascripts[] = DOCBASE."js/plugins/jquery.event.calendar/js/languages/jquery.event.calendar.en.js";

		$stylesheets[] = array("file" => DOCBASE."js/plugins/jquery.event.calendar/css/jquery.event.calendar.css", "media" => "all");

		$stylesheets[] = array("file" => DOCBASE."js/plugins/star-rating/css/star-rating.min.css", "media" => "all");
		$javascripts[] = DOCBASE."js/plugins/star-rating/js/star-rating.min.js";

		$stylesheets[] = array("file" => DOCBASE."js/plugins/owl-carousel/owl.carousel.css", "media" => "all");
		$stylesheets[] = array("file" => DOCBASE."js/plugins/owl-carousel/owl.theme.css", "media" => "all");
		$javascripts[] = DOCBASE."js/plugins/owl-carousel/owl.carousel.min.js";

		$stylesheets[] = array("file" => DOCBASE."js/plugins/live-search/jquery.liveSearch.css", "media" => "all");
		$javascripts[] = DOCBASE."js/plugins/live-search/jquery.liveSearch.js";

require(getFromTemplate("common/header.php", false)); ?>

<section id="page">

    <?php include(getFromTemplate("common/page_header.php", false)); ?>

    <div id="content" class="pb30">

        <div id="search-page" class="mb30">
            <div class="container">
                <?php
				include(getFromTemplate("common/charter_search.php", false));
				?>
            </div>
        </div>

    <?php
        if($arrResult !== false){
    ?>
    <div class="container mb20">
        <div class="row">

            <aside class="col-md-3 col-md-push-9" id="sidebar">
                <div class="theiaStickySidebar ">
                    <div id="filters_col">
                        <a data-toggle="collapse" href="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters" id="filters_col_bt">Filters </a>
                        <div class="collapse" id="collapseFilters">
                            <p>
                <?php

//                 echo $texts['CHECK_IN']." <b>".$from_date."</b> ".$texts['CHECK_OUT']." <b>".$to_date."</b><br>";
//                 if(isset($num_nights) && $num_nights > 0) echo "<b>".$num_nights."</b> ".$texts['NIGHTS']." - ";
//                 echo "<b>".($num_adults+$num_children)."</b> ".$texts['PERSONS'];

                ?>
            </p>
            <div class="alert alert-success" style="display:none;"></div>
            <div class="alert alert-danger" style="display:none;"><?php echo $msg_error;?></div>
                            <!--<div class="filter_type">
                                <h6>Duration</h6>
                                <input type="text" id="range" name="range" value="">
                            </div>
                            <div class="filter_type">
                                <h6>Review score</h6>
                                <ul>
                                    <li>
                                        <label>Superb: 9+ (77)</label>
                                        <input type="checkbox" class="js-switch" checked>
                                    </li>
                                    <li>
                                        <label>Very good: 8+ (552)</label>
                                        <input type="checkbox" class="js-switch">
                                    </li>
                                    <li>
                                        <label>Good: 7+ (909)</label>
                                        <input type="checkbox" class="js-switch">
                                    </li>
                                    <li>
                                        <label>Pleasant: 6+ (1196)</label>
                                        <input type="checkbox" class="js-switch">
                                    </li>
                                    <li>
                                        <label>No rating (198)</label>
                                        <input type="checkbox" class="js-switch">
                                    </li>
                                </ul>
                            </div>
                            <div class="filter_type">
                                <h6>Type</h6>
                                <ul>
                                    <li>
                                        <label>Historic (77)</label>
                                        <input type="checkbox" class="js-switch" checked>
                                    </li>
                                    <li>
                                        <label>Monumets (552)</label>
                                        <input type="checkbox" class="js-switch">
                                    </li>
                                    <li>
                                        <label>Interesting (909)</label>
                                        <input type="checkbox" class="js-switch">
                                    </li>
                                    <li>
                                        <label>Architectural (1196)</label>
                                        <input type="checkbox" class="js-switch">
                                    </li>
                                </ul>
                            </div>-->
                        </div>
                        <!--End collapse -->
                    </div>
                    <!--End filters col-->
                </div>
                <!--End Sticky -->
            </aside>
            <!--End aside -->

            <div class="col-md-9 col-md-pull-3">
                <div class="row">
                    <?php
                        foreach($arrResult as $i => $row){
                            $charter_id = $row['id'];
                            $charter_title = $row['title'];
                            $charter_subtitle = $row['subtitle'];
                            $charter_alias = $row['alias'];
                            $charter_price = $row["charter_price"];
                            $destination = $row["destination"];

                            $charter_lat = $row['lat'];
                            $charter_lng = $row['lng'];
                            $charter_descr = $row['descr'];
                            $charter_type_name = $row["charter_type_name"];

                            $charter_alias = DOCBASE."charter/".text_format($charter_alias);

                            $min_price = 0;
                            if ($charter_price > 0) {
                            	$min_price = $charter_price;
                            }

                    ?>
                    <div class="col-sm-6 wow fadeIn" data-wow-delay="0.1s">
                        <div class="img_wrapper">
                            <div class="ribbon">
                                <span><?php echo $charter_type_name;?></span>
                            </div>
                            <div class="tools_i">
                                <form action="http://maps.google.com/maps" method="get" target="_blank" class="directions_list">
                                    <input type="hidden" name="daddr" value="<?php echo $charter_lat;?>, <?php echo $charter_lng;?>">
                                    <button type="submit" class="tooltip_styled tooltip-effect-4">
                                        <span class="tooltip-item"></span>
                                        <span class="tooltip-content"><?php echo $destination;?></span>
                                    </button>
                                </form>
                                <!--
                                <div class="wishlist">
                                    <a class="tooltip_styled tooltip-effect-4"><span class="tooltip-item"></span>
                                    <div class="tooltip-content"> Bookmark</div>
                                    </a>
                                </div>
                                 -->
                            </div>
                            <!-- End tools i-->
                            <div class="img_container">
                                <a href="<?php echo $charter_alias; ?>" title="<?php echo $texts['READMORE']; ?>">
                                    <?php
                                        $result_file->execute();
                                        if($result_file !== false && $db->last_row_count() > 0){
                                            $row = $result_file->fetch(PDO::FETCH_ASSOC);

                                            $file_id = $row['id'];
                                            $filename = $row['file'];
                                            $label = $row['label'];

                                            $realpath = SYSBASE."medias/charter/medium/".$file_id."/".$filename;
                                            $thumbpath = DOCBASE."medias/charter/medium/".$file_id."/".$filename;
                                            $zoompath = DOCBASE."medias/charter/big/".$file_id."/".$filename;

                                            if(is_file($realpath)){ ?>
                                                <img src="<?php echo $thumbpath;?>" width="800" height="533" class="img-responsive" alt="<?php echo $label; ?>">
                                                <?php
                                            }
                                        }
                                    ?>
                                    <div class="short_info">
                                        <!--<small>1.30 min</small>-->
                                        <h3><?php echo $charter_title; ?></h3>
                                        <em><?php echo $charter_subtitle; ?></em>
                                        <p>
                                            <?php echo strtrunc(strip_tags($charter_descr), 120); ?>
                                        </p>
                                        <p>

                                        </p>
                                        <div class="score_wp"><?php echo formatPrice($min_price*CURRENCY_RATE);?>
                                            <div id="score_1" class="score" data-value="7.5"></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- End img_wrapper -->
                    </div>
                    <!-- End col-md-6 -->

                    <?php
                        }
                    ?>
                </div>
                <!-- End row -->

                <!--
                <nav>
                    <ul class="pagination">
                        <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>
                        </li>
                        <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a>
                        </li>
                        <li><a href="#">2</a>
                        </li>
                        <li><a href="#">3</a>
                        </li>
                        <li><a href="#">4</a>
                        </li>
                        <li><a href="#">5</a>
                        </li>
                        <li>
                            <a href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                 -->
            </div>
            <!-- End col lg 9 -->
        </div>
        <!-- End row -->
    </div>
    <!-- End container -->
    <!-- Fixed sidebar + Input Range + Carousel + Switch-->
    <script src="js/theia-sticky-sidebar.min.js"></script>
    <script>
        'use strict';
        jQuery('#sidebar').theiaStickySidebar({
            additionalMarginTop: 80
        });

        <?php
			if (!empty($msg_error)) {
		?>
				$(".alert-danger").show();
		<?php
			}
		?>
    </script>
    <?php
        }
    ?>
    </div>
</section>

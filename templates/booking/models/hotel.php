<?php
if($article_alias == "") err404();

$result = $db->query("SELECT * FROM pm_hotel WHERE checked = 1 AND lang = ".LANG_ID." AND alias = ".$db->quote($article_alias));
if($result !== false && $db->last_row_count() == 1){
    
    $hotel = $result->fetch(PDO::FETCH_ASSOC);
    
    $hotel_id = $hotel['id'];
    $article_id = $hotel_id;
    $title_tag = $hotel['title']." - ".$title_tag;
    $page_title = $hotel['title'];
    $page_subtitle = "";
    $page_alias = DOCBASE.$pages[$page_id]['alias']."/".text_format($hotel['alias']);
    
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

require(SYSBASE."templates/".TEMPLATE."/common/send_comment.php");

require(SYSBASE."templates/".TEMPLATE."/common/header.php"); ?>

<article id="page">
    <?php include(SYSBASE."templates/".TEMPLATE."/common/page_header.php"); ?>
    
    <div id="content" class="pt20 pb30">
        <div class="container boxed mb20">
            <legend><?php echo $texts['AVAILABILITIES']; ?></legend>
            <div class="alert alert-success" style="display:none;"></div>
            <div class="alert alert-danger" style="display:none;"></div>
            <?php include(SYSBASE."templates/".TEMPLATE."/common/search.php"); ?>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 boxed mb20">
                    <div class="row mb10">
                        <div class="col-sm-8">
                            <h1 class="mb0"><?php echo $hotel['title']; ?></h1>
                            <?php
                            $result_rating = $db->query("SELECT count(*) as count_rating, AVG(rating) as avg_rating FROM pm_comment WHERE item_type = 'hotel' AND id_item = ".$hotel_id." AND checked = 1 AND rating > 0 AND rating <= 5");
                            if($result_rating !== false && $db->last_row_count() == 1){
                                $row = $result_rating->fetch();
                                $hotel_rating = $row['avg_rating'];
                                $count_rating = $row['count_rating'];
                                
                                if($hotel_rating > 0 && $hotel_rating <= 5){ ?>
                                
                                    <input type="hidden" class="rating pull-left" value="<?php echo $hotel_rating; ?>" data-rtl="<?php echo (RTL_DIR) ? true : false; ?>" data-size="xs" readonly="true" data-default-caption="<?php echo $count_rating." ".$texts['RATINGS']; ?>" data-show-caption="true">
                                    <?php
                                }
                            } ?>
                            <div class="clearfix"></div>
                            <h2><?php echo $hotel['subtitle']; ?></h2>
                        </div>
                        <div class="col-sm-4 text-right">
                            <div class="price text-primary">
                                <?php
                                $min_price = 0;
                                $result_rate = $db->query("
                                    SELECT DISTINCT(ra.price), type
                                    FROM pm_rate as ra, pm_room as ro
                                    WHERE ro.id = id_room
                                        AND id_hotel = ".$hotel_id."
                                        AND ra.price IN(SELECT MIN(ra.price) FROM pm_rate as ra, pm_room as ro WHERE ro.id = id_room AND id_hotel = ".$hotel_id.")
                                    ORDER BY ra.price, CASE type
                                        WHEN 'week' THEN 1
                                        WHEN 'mid-week' THEN 2
                                        WHEN 'week-end' THEN 3
                                        WHEN '2-nights' THEN 4
                                        WHEN 'night' THEN 5
                                        ELSE 6 END
                                    LIMIT 1");
                                if($result_rate !== false && $db->last_row_count() == 1){
                                    $row = $result_rate->fetch();
                                    $price = $row['price'];
                                    if($price > 0) $min_price = $price;
                                }
                                if($min_price > 0){
                                    echo $texts['FROM_PRICE']; ?>
                                    <span itemprop="priceRange">
                                        <?php echo formatPrice($min_price*CURRENCY_RATE); ?>
                                    </span>
                                    / <?php echo $texts['NIGHT'];
                                } ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb10">
                        <div class="col-sm-12">
                            <?php
                            $result_facility = $db->query("SELECT * FROM pm_facility WHERE lang = ".LANG_ID." AND id IN(".$hotel['facilities'].") ORDER BY name",PDO::FETCH_ASSOC);
                            if($result_facility !== false && $db->last_row_count() > 0){
                                foreach($result_facility as $i => $row){
                                    $facility_id 	= $row['id'];
                                    $facility_name  = $row['name'];
                                    
                                    $result_facility_file = $db->query("SELECT * FROM pm_facility_file WHERE id_item = ".$facility_id." AND checked = 1 AND lang = ".DEFAULT_LANG." AND type = 'image' AND file != '' ORDER BY rank LIMIT 1",PDO::FETCH_ASSOC);
                                    if($result_facility_file !== false && $db->last_row_count() == 1){
                                        $row = $result_facility_file->fetch();
                                        
                                        $file_id 	= $row['id'];
                                        $filename 	= $row['file'];
                                        $label	 	= $row['label'];
                                        
                                        $realpath	= SYSBASE."medias/facility/big/".$file_id."/".$filename;
                                        $thumbpath	= DOCBASE."medias/facility/big/".$file_id."/".$filename;
                                            
                                        if(is_file($realpath)){ ?>
                                            <span class="facility-icon">
                                                <img alt="<?php echo $facility_name; ?>" title="<?php echo $facility_name; ?>" src="<?php echo $thumbpath; ?>" class="tips">
                                            </span>
                                            <?php
                                        }
                                    }
                                }
                            } ?>
                        </div>
                    </div>
                    <div class="row mb10">
                        <div class="col-md-12">
                            <div class="owl-carousel owlWrapper" data-items="1" data-autoplay="true" data-dots="true" data-nav="false" data-rtl="<?php echo (RTL_DIR) ? "true" : "false"; ?>">
                                <?php
                                $result_hotel_file = $db->query("SELECT * FROM pm_hotel_file WHERE id_item = ".$hotel_id." AND checked = 1 AND lang = ".DEFAULT_LANG." AND type = 'image' AND file != '' ORDER BY rank");
                                if($result_hotel_file !== false){
                                    
                                    foreach($result_hotel_file as $i => $row){
                                    
                                        $file_id = $row['id'];
                                        $filename = $row['file'];
                                        $label = $row['label'];
                                        
                                        $realpath = SYSBASE."medias/hotel/big/".$file_id."/".$filename;
                                        $thumbpath = DOCBASE."medias/hotel/big/".$file_id."/".$filename;
                                        
                                        if(is_file($realpath)){ ?>
                                            <img alt="<?php echo $label; ?>" src="<?php echo $thumbpath; ?>" class="img-responsive" style="max-height:600px;"/>
                                            <?php
                                        }
                                    }
                                } ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" itemprop="description">
                            <?php echo $hotel['descr']; ?>
                        </div>
                    </div>
                </div>
                <aside class="col-md-4 mb20">
                    <div class="boxed">
                        <div itemscope itemtype="http://schema.org/Corporation">
                        <h3 itemprop="name"><?php echo $hotel['title']; ?></h3>
                        <address>
                            <p>
                                <i class="fa fa-map-marker"></i> <span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress"><?php echo $hotel['address']; ?></span><br>
                                <?php if($hotel['phone'] != "") : ?><i class="fa fa-phone"></i> <span itemprop="telephone" dir="ltr"><?php echo $hotel['phone']; ?></span><br><?php endif; ?>
                                <?php if($hotel['email'] != "") : ?><i class="fa fa-envelope"></i> <a itemprop="email" dir="ltr" href="mailto:<?php echo $hotel['email']; ?>"><?php echo $hotel['email']; ?></a><?php endif; ?>
                            </p>
                        </address>
                    </div>
                        <script type="text/javascript">
                            var locations = [
                                ['<?php echo $hotel['title']; ?>', '<?php echo $hotel['address']; ?>', '<?php echo $hotel['lat']; ?>', '<?php echo $hotel['lng']; ?>']
                            ];
                        </script>
                        <div id="mapWrapper" class="mb10" data-marker="<?php echo DOCBASE."templates/".TEMPLATE."/images/marker.png"; ?>" data-api_key="<?php echo GMAPS_API_KEY; ?>"></div>
                        <?php
                        $id_facility = 0;
                        $result_facility_file = $db->prepare("SELECT * FROM pm_facility_file WHERE id_item = :id_facility AND checked = 1 AND lang = ".DEFAULT_LANG." AND type = 'image' AND file != '' ORDER BY rank LIMIT 1");
                        $result_facility_file->bindParam(":id_facility", $id_facility);

                        $room_facilities = "0";
                        $result_facility = $db->prepare("SELECT * FROM pm_facility WHERE lang = ".LANG_ID." AND FIND_IN_SET(id, :room_facilities) ORDER BY rank LIMIT 8");
                        $result_facility->bindParam(":room_facilities", $room_facilities);
            
                        $id_room = 0;
                        $result_rate = $db->prepare("
                            SELECT DISTINCT(price), type
                            FROM pm_rate
                            WHERE
                                id_room = :id_room
                                AND price IN(SELECT MIN(price) FROM pm_rate WHERE id_room = :id_room)
                            ORDER BY price, CASE type
                                WHEN 'week' THEN 1
                                WHEN 'mid-week' THEN 2
                                WHEN 'week-end' THEN 3
                                WHEN '2-nights' THEN 4
                                WHEN 'night' THEN 5
                                ELSE 6 END
                            LIMIT 1");
                        $result_rate->bindParam(":id_room", $id_room);
                        
                        $result_room_file = $db->prepare("SELECT * FROM pm_room_file WHERE id_item = :id_room AND checked = 1 AND lang = ".LANG_ID." AND type = 'image' AND file != '' ORDER BY rank");
                        $result_room_file->bindParam(":id_room", $id_room, PDO::PARAM_STR);
                
                        $result_room = $db->query("SELECT * FROM pm_room WHERE id_hotel = ".$hotel_id." AND checked = 1 AND lang = ".LANG_ID." ORDER BY rank", PDO::FETCH_ASSOC);
                        if($result_room !== false && $db->last_row_count() > 0){ ?>
                            <p class="widget-title"><?php echo $texts['ROOMS']; ?></p>
                            
                            <?php
                            foreach($result_room as $i => $row){
                                $id_room = $row['id'];
                                $room_title = $row['title'];
                                $room_subtitle = $row['subtitle'];
                                $room_descr = $row['descr'];
                                $room_alias = $row['alias'];
                                $room_facilities = $row['facilities'];
                                $max_people = $row['max_people'];
                                $room_price = $row['price']; ?>
                                
                                <a class="popup-modal" href="#room-<?php echo $id_room; ?>">
                                    <div class="row">
                                        <div class="col-xs-4 mb20">
                                            <?php
                                            $result_room_file->execute();
                                            if($result_room_file !== false && $db->last_row_count() > 0){
                                                $row = $result_room_file->fetch(PDO::FETCH_ASSOC);
                                                
                                                $file_id = $row['id'];
                                                $filename = $row['file'];
                                                $label = $row['label'];
                                                
                                                $realpath = SYSBASE."medias/room/small/".$file_id."/".$filename;
                                                $thumbpath = DOCBASE."medias/room/small/".$file_id."/".$filename;
                                                    
                                                if(is_file($realpath)){ ?>
                                                    <div class="img-container sm">
                                                        <img alt="" src="<?php echo $thumbpath; ?>">
                                                    </div>
                                                    <?php
                                                }
                                            } ?>
                                        </div>
                                        <div class="col-xs-8">
                                            <h3 class="mb0"><?php echo $room_title; ?></h3>
                                            <h4 class="mb0"><?php echo $room_subtitle; ?></h4>
                                            <?php
                                            $min_price = $room_price;
                                            $result_rate->execute();
                                            if($result_rate !== false && $db->last_row_count() == 1){
                                                $row = $result_rate->fetch();
                                                $price = $row['price'];
                                                if($price > 0) $min_price = $price;
                                            } ?>
                                            <div class="price text-primary">
                                                <?php echo $texts['FROM_PRICE']; ?>
                                                <span itemprop="priceRange">
                                                    <?php echo formatPrice($min_price*CURRENCY_RATE); ?>
                                                </span>
                                                / <?php echo $texts['NIGHT']; ?>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <div id="room-<?php echo $id_room; ?>" class="white-popup-block mfp-hide">
                                    <div class="fluid-container">
                                        <div class="row">
                                            <div class="col-xs-12 mb20">
                                                <div class="owl-carousel" data-items="1" data-autoplay="true" data-dots="true" data-nav="false" data-rtl="<?php echo (RTL_DIR) ? "true" : "false"; ?>">
                                                    <?php
                                                    $result_room_file->execute();
                                                    if($result_room_file !== false){
                                                        foreach($result_room_file as $i => $row){
                                    
                                                            $file_id = $row['id'];
                                                            $filename = $row['file'];
                                                            $label = $row['label'];
                                                            
                                                            $realpath = SYSBASE."medias/room/medium/".$file_id."/".$filename;
                                                            $thumbpath = DOCBASE."medias/room/medium/".$file_id."/".$filename;
                                                            
                                                            if(is_file($realpath)){ ?>
                                                                <div><img alt="<?php echo $label; ?>" src="<?php echo $thumbpath; ?>" class="img-responsive" style="max-height:600px;"></div>
                                                                <?php
                                                            }
                                                        }
                                                    } ?>
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <h3 class="mb0"><?php echo $room_title; ?></h3>
                                                <h4 class="mb0"><?php echo $room_subtitle; ?></h4>
                                            </div>
                                            <div class="col-sm-4 text-right">
                                                <?php
                                                $type = "night";
                                                $min_price = $room_price;
                                                $result_rate->execute();
                                                if($result_rate !== false && $db->last_row_count() == 1){
                                                    $row = $result_rate->fetch();
                                                    $price = $row['price'];
                                                    $type = $row['type'];
                                                    if($price > 0){
                                                        switch($type){
                                                            case "night": $type = $texts['NIGHT']; break;
                                                            case "week": $type = $texts['WEEK']; break;
                                                        }
                                                        $min_price = $price;
                                                    }
                                                }
                                                if($type == "night") $type = $texts['NIGHT']; ?>
                                                <div class="price text-primary">
                                                    <?php echo $texts['FROM_PRICE']; ?>
                                                    <span itemprop="priceRange">
                                                        <?php echo formatPrice($min_price*CURRENCY_RATE); ?>
                                                    </span>
                                                    / <?php echo $type; ?>
                                                </div>
                                                <p>
                                                    <?php echo $texts['CAPACITY']; ?> : <i class="fa fa-male"></i>x<?php echo $max_people; ?>
                                                </p>
                                            </div>
                                            <div class="col-xs-12">
                                                <div class="clearfix mb5">
                                                    <?php
                                                    $result_facility->execute();
                                                    if($result_facility !== false && $db->last_row_count() > 0){
                                                        foreach($result_facility as $row){
                                                            $id_facility = $row['id'];
                                                            $facility_name = $row['name'];
                                                            
                                                            $result_facility_file->execute();
                                                            if($result_facility_file !== false && $db->last_row_count() == 1){
                                                                $row = $result_facility_file->fetch();
                                                                
                                                                $file_id = $row['id'];
                                                                $filename = $row['file'];
                                                                $label = $row['label'];
                                                                
                                                                $realpath = SYSBASE."medias/facility/big/".$file_id."/".$filename;
                                                                $thumbpath = DOCBASE."medias/facility/big/".$file_id."/".$filename;
                                                                    
                                                                if(is_file($realpath)){ ?>
                                                                    <span class="facility-icon">
                                                                        <img alt="<?php echo $facility_name; ?>" title="<?php echo $facility_name; ?>" src="<?php echo $thumbpath; ?>" class="tips">
                                                                    </span>
                                                                    <?php
                                                                }
                                                            }
                                                        }
                                                    } ?>
                                                </div>
                                                <?php echo $room_descr; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            } ?>
                            <?php
                        } ?>
                    </div>
                </aside>
                <div class="col-md-8">
                    <?php
                    $nb_comments = 0;
                    $item_type = "hotel";
                    $item_id = $hotel_id;
                    $allow_comment = ALLOW_COMMENTS;
                    $allow_rating = ALLOW_RATINGS;
                    if($allow_comment == 1){
                        $result_comment = $db->query("SELECT * FROM pm_comment WHERE id_item = ".$item_id." AND item_type = '".$item_type."' AND checked = 1 ORDER BY add_date DESC");
                        if($result_comment !== false)
                            $nb_comments = $db->last_row_count();
                    }
                    include(SYSBASE."templates/".TEMPLATE."/common/comments.php"); ?>
                </div>
            </div>
        </div>
    </div>
</article>

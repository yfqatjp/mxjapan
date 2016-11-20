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
    $page_alias = $pages[$page_id]['alias']."/".text_format($hotel['alias']);
    
    $result_hotel_file = $db->query("SELECT * FROM pm_hotel_file WHERE id_item = ".$hotel_id." AND checked = 1 AND lang = ".DEFAULT_LANG." AND type = 'image' AND file != '' ORDER BY rank LIMIT 1");
    if($result_hotel_file !== false && $db->last_row_count() > 0){
        
        $row = $result_hotel_file->fetch();
        
        $file_id = $row['id'];
        $filename = $row['file'];
        
        if(is_file(SYSBASE."medias/hotel/medium/".$file_id."/".$filename))
            $page_img = getUrl(true)."/medias/hotel/medium/".$file_id."/".$filename;
    }
    
}else err404();

check_URI(DOCBASE.$page_alias);

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

require(getFromTemplate("common/send_comment.php", false));

require(getFromTemplate("common/header.php", false)); ?>

<section id="page">
    
    <?php include(getFromTemplate("common/page_header.php", false)); ?>
    
    <div id="content" class="pb30">
    
<!--        <div id="search-page" class="mb30">
            <div class="container">
                <?php include(getFromTemplate("common/search.php", false)); ?>
            </div>
        </div>-->
        
        <div class="container">
            <div class="alert alert-success" style="display:none;"></div>
            <div class="alert alert-danger" style="display:none;"></div>
        </div>
        
        <div class="container">
            <div class="booking-item-details">
                <header class="booking-item-header">
                    <div class="row">
                        <div class="col-md-9">
                            <h2 class="lh1em"><?php echo $hotel['title']; ?></h2>
                            <p class="lh1em text-small"><i class="fa fa-map-marker"></i> 6782 Sarasea Circle, Siesta Key, FL 34242</p>
                            <ul class="list list-inline text-small">
                                <li><a href="#"><i class="fa fa-envelope"></i> Hotel E-mail</a>
                                </li>
                                <li><a href="#"><i class="fa fa-home"></i> Hotel Website</a>
                                </li>
                                <li><i class="fa fa-phone"></i> +1 (163) 493-1463</li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <p class="booking-item-header-price"><small>price from</small>  <span class="text-lg">$350</span>/night</p>
                        </div>
                    </div>
                </header>
                <div class="row">
                    <div class="col-md-6">
                        <div class="tabbable booking-details-tabbable">
                            <ul class="nav nav-tabs" id="myTab">
                                <li class="active"><a href="#tab-1" data-toggle="tab"><i class="fa fa-camera"></i>Photos</a>
                                </li>
                                <li><a href="#google-map-tab" data-toggle="tab"><i class="fa fa-map-marker"></i>On the Map</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="tab-1">
                                    <div class="fotorama" data-allowfullscreen="true" data-nav="thumbs">
                                        <img src="<?php echo getFromTemplate("images/800x600.png"); ?>" alt="Image Alternative text" title="hotel PORTO BAY SERRA GOLF living room" />
                                        <img src="<?php echo getFromTemplate("images/800x600.png"); ?>" alt="Image Alternative text" title="hotel PORTO BAY RIO INTERNACIONAL rooftop pool" />
                                        <img src="<?php echo getFromTemplate("images/800x600.png"); ?>" alt="Image Alternative text" title="hotel PORTO BAY SERRA GOLF library" />
                                        <img src="<?php echo getFromTemplate("images/800x600.png"); ?>" alt="Image Alternative text" title="The pool" />
                                        <img src="<?php echo getFromTemplate("images/800x600.png"); ?>" alt="Image Alternative text" title="hotel PORTO BAY SERRA GOLF suite2" />
                                        <img src="<?php echo getFromTemplate("images/800x600.png"); ?>" alt="Image Alternative text" title="hotel PORTO BAY LIBERDADE" />
                                        <img src="<?php echo getFromTemplate("images/800x600.png"); ?>" alt="Image Alternative text" title="hotel 1" />
                                        <img src="<?php echo getFromTemplate("images/800x600.png"); ?>" alt="Image Alternative text" title="hotel PORTO BAY SERRA GOLF suite" />
                                        <img src="<?php echo getFromTemplate("images/800x600.png"); ?>" alt="Image Alternative text" title="hotel PORTO BAY RIO INTERNACIONAL de luxe" />
                                        <img src="<?php echo getFromTemplate("images/800x600.png"); ?>" alt="Image Alternative text" title="hotel THE CLIFF BAY spa suite" />
                                        <img src="<?php echo getFromTemplate("images/800x600.png"); ?>" alt="Image Alternative text" title="hotel 2" />
                                        <img src="<?php echo getFromTemplate("images/800x600.png"); ?>" alt="Image Alternative text" title="LHOTEL PORTO BAY SAO PAULO luxury suite" />
                                        <img src="<?php echo getFromTemplate("images/800x600.png"); ?>" alt="Image Alternative text" title="hotel EDEN MAR suite" />
                                        <img src="<?php echo getFromTemplate("images/800x600.png"); ?>" alt="Image Alternative text" title="LHOTEL PORTO BAY SAO PAULO lobby" />
                                        <img src="<?php echo getFromTemplate("images/800x600.png"); ?>" alt="Image Alternative text" title="LHOTEL PORTO BAY SAO PAULO suite lhotel living room" />
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="google-map-tab">
                                    <div id="map-canvas" style="width:100%; height:500px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="booking-item-meta">
                            <h2 class="lh1em mt40">Exeptional!</h2>
                            <h3>97% <small >of guests recommend</small></h3>
                            <div class="booking-item-rating">
                                <ul class="icon-list icon-group booking-item-rating-stars">
                                    <li><i class="fa fa-star"></i>
                                    </li>
                                    <li><i class="fa fa-star"></i>
                                    </li>
                                    <li><i class="fa fa-star"></i>
                                    </li>
                                    <li><i class="fa fa-star"></i>
                                    </li>
                                    <li><i class="fa fa-star"></i>
                                    </li>
                                </ul><span class="booking-item-rating-number"><b >4.7</b> of 5 <small class="text-smaller">guest rating</small></span>
                                <p><a class="text-default" href="#">based on 1535 reviews</a>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <h4 class="lh1em">Traveler raiting</h4>
                                <ul class="list booking-item-raiting-list">
                                    <li>
                                        <div class="booking-item-raiting-list-title">Exellent</div>
                                        <div class="booking-item-raiting-list-bar">
                                            <div style="width:91%;"></div>
                                        </div>
                                        <div class="booking-item-raiting-list-number">1223</div>
                                    </li>
                                    <li>
                                        <div class="booking-item-raiting-list-title">Very Good</div>
                                        <div class="booking-item-raiting-list-bar">
                                            <div style="width:6%;"></div>
                                        </div>
                                        <div class="booking-item-raiting-list-number">61</div>
                                    </li>
                                    <li>
                                        <div class="booking-item-raiting-list-title">Average</div>
                                        <div class="booking-item-raiting-list-bar">
                                            <div style="width:5%;"></div>
                                        </div>
                                        <div class="booking-item-raiting-list-number">40</div>
                                    </li>
                                    <li>
                                        <div class="booking-item-raiting-list-title">Poor</div>
                                        <div class="booking-item-raiting-list-bar">
                                            <div style="width:3%;"></div>
                                        </div>
                                        <div class="booking-item-raiting-list-number">15</div>
                                    </li>
                                    <li>
                                        <div class="booking-item-raiting-list-title">Terrible</div>
                                        <div class="booking-item-raiting-list-bar">
                                            <div style="width:1%;"></div>
                                        </div>
                                        <div class="booking-item-raiting-list-number">9</div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h4 class="lh1em">Summary</h4>
                                <ul class="list booking-item-raiting-summary-list">
                                    <li>
                                        <div class="booking-item-raiting-list-title">Sleep</div>
                                        <ul class="icon-group booking-item-rating-stars">
                                            <li><i class="fa fa-smile-o"></i>
                                            </li>
                                            <li><i class="fa fa-smile-o"></i>
                                            </li>
                                            <li><i class="fa fa-smile-o"></i>
                                            </li>
                                            <li><i class="fa fa-smile-o"></i>
                                            </li>
                                            <li><i class="fa fa-smile-o"></i>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <div class="booking-item-raiting-list-title">Location</div>
                                        <ul class="icon-group booking-item-rating-stars">
                                            <li><i class="fa fa-smile-o"></i>
                                            </li>
                                            <li><i class="fa fa-smile-o"></i>
                                            </li>
                                            <li><i class="fa fa-smile-o"></i>
                                            </li>
                                            <li><i class="fa fa-smile-o"></i>
                                            </li>
                                            <li><i class="fa fa-smile-o text-gray"></i>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <div class="booking-item-raiting-list-title">Service</div>
                                        <ul class="icon-group booking-item-rating-stars">
                                            <li><i class="fa fa-smile-o"></i>
                                            </li>
                                            <li><i class="fa fa-smile-o"></i>
                                            </li>
                                            <li><i class="fa fa-smile-o"></i>
                                            </li>
                                            <li><i class="fa fa-smile-o"></i>
                                            </li>
                                            <li><i class="fa fa-smile-o"></i>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <div class="booking-item-raiting-list-title">Clearness</div>
                                        <ul class="icon-group booking-item-rating-stars">
                                            <li><i class="fa fa-smile-o"></i>
                                            </li>
                                            <li><i class="fa fa-smile-o"></i>
                                            </li>
                                            <li><i class="fa fa-smile-o"></i>
                                            </li>
                                            <li><i class="fa fa-smile-o"></i>
                                            </li>
                                            <li><i class="fa fa-smile-o"></i>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <div class="booking-item-raiting-list-title">Rooms</div>
                                        <ul class="icon-group booking-item-rating-stars">
                                            <li><i class="fa fa-smile-o"></i>
                                            </li>
                                            <li><i class="fa fa-smile-o"></i>
                                            </li>
                                            <li><i class="fa fa-smile-o"></i>
                                            </li>
                                            <li><i class="fa fa-smile-o"></i>
                                            </li>
                                            <li><i class="fa fa-smile-o"></i>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <a href="#" class="btn btn-primary">Write a Review</a>
                    </div>
                </div>
                <div class="gap"></div>
                <h3>Available Rooms</h3>
                <div class="row">
                    <div class="col-md-9">
                        <div class="booking-item-dates-change">
                            <form>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-daterange" data-date-format="MM d, D">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                                                        <label>Check in</label>
                                                        <input class="form-control" name="start" type="text" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                                                        <label>Check out</label>
                                                        <input class="form-control" name="end" type="text" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group form-group-select-plus">
                                            <label>Adults</label>
                                            <div class="btn-group btn-group-select-num" data-toggle="buttons">
                                                <label class="btn btn-primary active">
                                                    <input type="radio" name="options" />1</label>
                                                <label class="btn btn-primary">
                                                    <input type="radio" name="options" />2</label>
                                                <label class="btn btn-primary">
                                                    <input type="radio" name="options" />3</label>
                                                <label class="btn btn-primary">
                                                    <input type="radio" name="options" />3+</label>
                                            </div>
                                            <select class="form-control hidden">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option selected="selected">4</option>
                                                <option>5</option>
                                                <option>6</option>
                                                <option>7</option>
                                                <option>8</option>
                                                <option>9</option>
                                                <option>10</option>
                                                <option>11</option>
                                                <option>12</option>
                                                <option>13</option>
                                                <option>14</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group form-group-select-plus">
                                            <label>Children</label>
                                            <div class="btn-group btn-group-select-num" data-toggle="buttons">
                                                <label class="btn btn-primary active">
                                                    <input type="radio" name="options" />0</label>
                                                <label class="btn btn-primary">
                                                    <input type="radio" name="options" />1</label>
                                                <label class="btn btn-primary">
                                                    <input type="radio" name="options" />2</label>
                                                <label class="btn btn-primary">
                                                    <input type="radio" name="options" />2+</label>
                                            </div>
                                            <select class="form-control hidden">
                                                <option>0</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option selected="selected">3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                <option>6</option>
                                                <option>7</option>
                                                <option>8</option>
                                                <option>9</option>
                                                <option>10</option>
                                                <option>11</option>
                                                <option>12</option>
                                                <option>13</option>
                                                <option>14</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group form-group-select-plus">
                                            <label>Rooms</label>
                                            <div class="btn-group btn-group-select-num" data-toggle="buttons">
                                                <label class="btn btn-primary active">
                                                    <input type="radio" name="options" />1</label>
                                                <label class="btn btn-primary">
                                                    <input type="radio" name="options" />2</label>
                                                <label class="btn btn-primary">
                                                    <input type="radio" name="options" />3</label>
                                                <label class="btn btn-primary">
                                                    <input type="radio" name="options" />3+</label>
                                            </div>
                                            <select class="form-control hidden">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option selected="selected">4</option>
                                                <option>5</option>
                                                <option>6</option>
                                                <option>7</option>
                                                <option>8</option>
                                                <option>9</option>
                                                <option>10</option>
                                                <option>11</option>
                                                <option>12</option>
                                                <option>13</option>
                                                <option>14</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="gap gap-small"></div>
                        <ul class="booking-list">
                            <li>
                                <a class="booking-item">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <img src="<?php echo getFromTemplate("images/800x600.png"); ?>" alt="Image Alternative text" title="hotel PORTO BAY RIO INTERNACIONAL rooftop pool" />
                                        </div>
                                        <div class="col-md-6">
                                            <h5 class="booking-item-title">Superior Penthouse</h5>
                                            <p class="text-small">Platea fringilla cursus aliquam euismod integer viverra dis facilisi in augue vehicula sed</p>
                                            <ul class="booking-item-features booking-item-features-sign clearfix">
                                                <li rel="tooltip" data-placement="top" title="Adults Occupancy"><i class="fa fa-male"></i><span class="booking-item-feature-sign">x 1</span>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Children Occupancy"><i class="im im-children"></i><span class="booking-item-feature-sign">x 1</span>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Beds"><i class="im im-bed"></i><span class="booking-item-feature-sign">x 1</span>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Room footage (square feet)"><i class="im im-width"></i><span class="booking-item-feature-sign">320</span>
                                                </li>
                                            </ul>
                                            <ul class="booking-item-features booking-item-features-small clearfix">
                                                <li rel="tooltip" data-placement="top" title="Air Conditioning"><i class="im im-air"></i>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Flat Screen TV"><i class="im im-tv"></i>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Mini Bar"><i class="im im-bar"></i>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Bathtub"><i class="im im-bathtub"></i>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Kitchen"><i class="im im-kitchen"></i>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Patio"><i class="im im-patio"></i>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Washing Machine"><i class="im im-washing-machine"></i>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Pool"><i class="im im-pool"></i>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-3"><span class="booking-item-price">$428</span><span>/night</span><span class="btn btn-primary">Book</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="booking-item">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <img src="<?php echo getFromTemplate("images/800x600.png"); ?>" alt="Image Alternative text" title="The pool" />
                                        </div>
                                        <div class="col-md-6">
                                            <h5 class="booking-item-title">Family Suite</h5>
                                            <p class="text-small">Metus eu eros ipsum mattis vehicula nisl egestas nec ultrices varius semper laoreet</p>
                                            <ul class="booking-item-features booking-item-features-sign clearfix">
                                                <li rel="tooltip" data-placement="top" title="Adults Occupancy"><i class="fa fa-male"></i><span class="booking-item-feature-sign">x 2</span>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Beds"><i class="im im-bed"></i><span class="booking-item-feature-sign">x 1</span>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Room footage (square feet)"><i class="im im-width"></i><span class="booking-item-feature-sign">580</span>
                                                </li>
                                            </ul>
                                            <ul class="booking-item-features booking-item-features-small clearfix">
                                                <li rel="tooltip" data-placement="top" title="Mini Bar"><i class="im im-bar"></i>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Bathtub"><i class="im im-bathtub"></i>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Kitchen"><i class="im im-kitchen"></i>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Patio"><i class="im im-patio"></i>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Soundproof"><i class="im im-soundproof"></i>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="SPA tub"><i class="im im-spa"></i>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Terrace"><i class="im im-terrace"></i>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Washing Machine"><i class="im im-washing-machine"></i>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-3"><span class="booking-item-price">$211</span><span>/night</span><span class="btn btn-primary">Book</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="booking-item">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <img src="<?php echo getFromTemplate("images/800x600.png"); ?>" alt="Image Alternative text" title="LHOTEL PORTO BAY SAO PAULO lobby" />
                                        </div>
                                        <div class="col-md-6">
                                            <h5 class="booking-item-title">Standard Double room</h5>
                                            <p class="text-small">Molestie purus euismod fames odio volutpat eleifend turpis nec cras quam litora dignissim</p>
                                            <ul class="booking-item-features booking-item-features-sign clearfix">
                                                <li rel="tooltip" data-placement="top" title="Adults Occupancy"><i class="fa fa-male"></i><span class="booking-item-feature-sign">x 2</span>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Children Occupancy"><i class="im im-children"></i><span class="booking-item-feature-sign">x 2</span>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Beds"><i class="im im-bed"></i><span class="booking-item-feature-sign">x 1</span>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Room footage (square feet)"><i class="im im-width"></i><span class="booking-item-feature-sign">730</span>
                                                </li>
                                            </ul>
                                            <ul class="booking-item-features booking-item-features-small clearfix">
                                                <li rel="tooltip" data-placement="top" title="Air Conditioning"><i class="im im-air"></i>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Mini Bar"><i class="im im-bar"></i>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Bathtub"><i class="im im-bathtub"></i>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Kitchen"><i class="im im-kitchen"></i>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Patio"><i class="im im-patio"></i>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Terrace"><i class="im im-terrace"></i>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Washing Machine"><i class="im im-washing-machine"></i>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Pool"><i class="im im-pool"></i>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-3"><span class="booking-item-price">$493</span><span>/night</span><span class="btn btn-primary">Book</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="booking-item">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <img src="<?php echo getFromTemplate("images/800x600.png"); ?>" alt="Image Alternative text" title="hotel 2" />
                                        </div>
                                        <div class="col-md-6">
                                            <h5 class="booking-item-title">Double Room with Town View</h5>
                                            <p class="text-small">Curae lacus platea sociis mauris hendrerit sed fringilla dignissim cum mi amet orci</p>
                                            <ul class="booking-item-features booking-item-features-sign clearfix">
                                                <li rel="tooltip" data-placement="top" title="Adults Occupancy"><i class="fa fa-male"></i><span class="booking-item-feature-sign">x 2</span>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Children Occupancy"><i class="im im-children"></i><span class="booking-item-feature-sign">x 2</span>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Beds"><i class="im im-bed"></i><span class="booking-item-feature-sign">x 2</span>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Room footage (square feet)"><i class="im im-width"></i><span class="booking-item-feature-sign">310</span>
                                                </li>
                                            </ul>
                                            <ul class="booking-item-features booking-item-features-small clearfix">
                                                <li rel="tooltip" data-placement="top" title="Flat Screen TV"><i class="im im-tv"></i>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Kitchen"><i class="im im-kitchen"></i>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Patio"><i class="im im-patio"></i>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Soundproof"><i class="im im-soundproof"></i>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="SPA tub"><i class="im im-spa"></i>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Washing Machine"><i class="im im-washing-machine"></i>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-3"><span class="booking-item-price">$451</span><span>/night</span><span class="btn btn-primary">Book</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="booking-item">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <img src="<?php echo getFromTemplate("images/800x600.png"); ?>" alt="Image Alternative text" title="hotel 1" />
                                        </div>
                                        <div class="col-md-6">
                                            <h5 class="booking-item-title">Junior Suite</h5>
                                            <p class="text-small">Tellus auctor sem sociosqu cras cursus vitae erat aliquam adipiscing iaculis suscipit curabitur</p>
                                            <ul class="booking-item-features booking-item-features-sign clearfix">
                                                <li rel="tooltip" data-placement="top" title="Adults Occupancy"><i class="fa fa-male"></i><span class="booking-item-feature-sign">x 3</span>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Children Occupancy"><i class="im im-children"></i><span class="booking-item-feature-sign">x 2</span>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Beds"><i class="im im-bed"></i><span class="booking-item-feature-sign">x 1</span>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Room footage (square feet)"><i class="im im-width"></i><span class="booking-item-feature-sign">470</span>
                                                </li>
                                            </ul>
                                            <ul class="booking-item-features booking-item-features-small clearfix">
                                                <li rel="tooltip" data-placement="top" title="Air Conditioning"><i class="im im-air"></i>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Flat Screen TV"><i class="im im-tv"></i>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Mini Bar"><i class="im im-bar"></i>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Bathtub"><i class="im im-bathtub"></i>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Kitchen"><i class="im im-kitchen"></i>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Patio"><i class="im im-patio"></i>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Soundproof"><i class="im im-soundproof"></i>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Terrace"><i class="im im-terrace"></i>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Pool"><i class="im im-pool"></i>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-3"><span class="booking-item-price">$318</span><span>/night</span><span class="btn btn-primary">Book</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <h4>About the Hotel</h4>
                        <p class="mb30">Torquent egestas pharetra est cum tellus ultrices aliquam nam gravida hendrerit primis class egestas primis porta egestas non eleifend risus</p>
                        <h4>Hotel Facilities</h4>
                        <ul class="booking-item-features booking-item-features-expand mb30 clearfix">
                            <li><i class="im im-wi-fi"></i><span class="booking-item-feature-title">Wi-Fi Internet</span>
                            </li>
                            <li><i class="im im-parking"></i><span class="booking-item-feature-title">Parking</span>
                            </li>
                            <li><i class="im im-plane"></i><span class="booking-item-feature-title">Airport Transport</span>
                            </li>
                            <li><i class="im im-bus"></i><span class="booking-item-feature-title">Shuttle Bus Service</span>
                            </li>
                            <li><i class="im im-fitness"></i><span class="booking-item-feature-title">Fitness Center</span>
                            </li>
                            <li><i class="im im-pool"></i><span class="booking-item-feature-title">Pool</span>
                            </li>
                            <li><i class="im im-spa"></i><span class="booking-item-feature-title">SPA</span>
                            </li>
                            <li><i class="im im-restaurant"></i><span class="booking-item-feature-title">Restaurant</span>
                            </li>
                            <li><i class="im im-wheel-chair"></i><span class="booking-item-feature-title">Wheelchair Access</span>
                            </li>
                            <li><i class="im im-business-person"></i><span class="booking-item-feature-title">Business Center</span>
                            </li>
                            <li><i class="im im-children"></i><span class="booking-item-feature-title">Children Activites</span>
                            </li>
                            <li><i class="im im-casino"></i><span class="booking-item-feature-title">Casino & Gambling</span>
                            </li>
                            <li><i class="im im-bar"></i><span class="booking-item-feature-title">Bar/Lounge</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <h3 class="mb20">Hotel Reviews</h3>
                <div class="row row-wrap">
                    <div class="col-md-8">
                        <ul class="booking-item-reviews list">
                            <li>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="booking-item-review-person">
                                            <a class="booking-item-review-person-avatar round" href="#">
                                                <img src="<?php echo getFromTemplate("images/70x70.png"); ?>" alt="Image Alternative text" title="Afro" />
                                            </a>
                                            <p class="booking-item-review-person-name"><a href="#">John Doe</a>
                                            </p>
                                            <p class="booking-item-review-person-loc">Palm Beach, FL</p><small><a href="#">143 Reviews</a></small>
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="booking-item-review-content">
                                            <h5>"Ridiculus volutpat varius"</h5>
                                            <ul class="icon-group booking-item-rating-stars">
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                            </ul>
                                            <p>Suspendisse velit venenatis facilisi velit quis volutpat enim ipsum mauris mus tortor leo augue non sociosqu ridiculus sagittis odio curabitur nostra maecenas nisi lectus platea mauris venenatis sed dui primis porttitor sit turpis litora<span class="booking-item-review-more"> Eu nisl volutpat nam per primis dictum hendrerit gravida facilisis porta pretium erat turpis erat vivamus torquent ornare bibendum vitae dui congue torquent aptent placerat in tortor arcu eu blandit sit fusce lorem eu tortor proin egestas neque senectus netus ac augue senectus pulvinar rutrum habitasse nostra montes aenean mauris lacinia sociosqu posuere curabitur vestibulum venenatis euismod habitasse litora rhoncus purus pretium nullam nibh montes gravida pharetra eu parturient semper</span>
                                            </p>
                                            <div class="booking-item-review-more-content">
                                                <p>Fringilla dictum montes eget senectus cras dictum dictum sollicitudin maecenas</p>
                                                <p>Aliquam quisque orci auctor auctor natoque ultrices elit quisque porta tortor sollicitudin bibendum proin facilisi duis magna risus fringilla donec velit justo pretium curabitur velit quis platea tristique libero iaculis velit scelerisque ullamcorper id proin placerat faucibus hac purus tristique consectetur interdum donec fames euismod consequat sodales egestas faucibus</p>
                                                <p class="text-small mt20">Stayed March 2014, traveled as a couple</p>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <ul class="list booking-item-raiting-summary-list">
                                                            <li>
                                                                <div class="booking-item-raiting-list-title">Sleep</div>
                                                                <ul class="icon-group booking-item-rating-stars">
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o text-gray"></i>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li>
                                                                <div class="booking-item-raiting-list-title">Location</div>
                                                                <ul class="icon-group booking-item-rating-stars">
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li>
                                                                <div class="booking-item-raiting-list-title">Service</div>
                                                                <ul class="icon-group booking-item-rating-stars">
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <ul class="list booking-item-raiting-summary-list">
                                                            <li>
                                                                <div class="booking-item-raiting-list-title">Clearness</div>
                                                                <ul class="icon-group booking-item-rating-stars">
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o text-gray"></i>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li>
                                                                <div class="booking-item-raiting-list-title">Rooms</div>
                                                                <ul class="icon-group booking-item-rating-stars">
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="booking-item-review-expand"><span class="booking-item-review-expand-more">More <i class="fa fa-angle-down"></i></span><span class="booking-item-review-expand-less">Less <i class="fa fa-angle-up"></i></span>
                                            </div>
                                            <p class="booking-item-review-rate">Was this review helpful?
                                                <a class="fa fa-thumbs-o-up box-icon-inline round" href="#"></a><b class="text-color"> 7</b>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="booking-item-review-person">
                                            <a class="booking-item-review-person-avatar round" href="#">
                                                <img src="<?php echo getFromTemplate("images/70x70.png"); ?>" alt="Image Alternative text" title="Bubbles" />
                                            </a>
                                            <p class="booking-item-review-person-name"><a href="#">Minnie Aviles</a>
                                            </p>
                                            <p class="booking-item-review-person-loc">Palm Beach, FL</p><small><a href="#">128 Reviews</a></small>
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="booking-item-review-content">
                                            <h5>"Neque suspendisse massa cras inceptos volutpat"</h5>
                                            <ul class="icon-group booking-item-rating-stars">
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                            </ul>
                                            <p>Malesuada elit pellentesque lectus ante nisi vel varius magna per iaculis porttitor pharetra lacus mi libero varius gravida magnis inceptos cras iaculis tempus eros nisi a rhoncus est<span class="booking-item-review-more"> Dictum dignissim quam conubia egestas interdum urna at nascetur nulla tortor scelerisque mus fames purus morbi aliquam justo auctor aenean habitant lectus venenatis ligula gravida fusce accumsan mus habitasse natoque fermentum montes eleifend consequat maecenas cubilia fermentum leo neque nascetur ligula mauris egestas molestie vulputate sem magnis est ridiculus eu volutpat luctus convallis justo scelerisque in ultrices dapibus metus primis luctus ad erat porttitor pellentesque ultricies netus aliquam sagittis hac</span>
                                            </p>
                                            <div class="booking-item-review-more-content">
                                                <p>Non varius primis euismod ultrices cubilia sem dignissim nostra suspendisse tincidunt</p>
                                                <p>Aenean etiam sed facilisi est accumsan donec tempor tempus interdum ridiculus viverra fusce nascetur proin ligula nisi at scelerisque odio cum accumsan dignissim himenaeos varius vulputate nullam a leo congue feugiat himenaeos orci vehicula ac sit vulputate nisl torquent donec litora per porta taciti mi elit odio nunc curabitur ultrices laoreet suspendisse sem sagittis</p>
                                                <p class="text-small mt20">Stayed March 2014, traveled as a couple</p>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <ul class="list booking-item-raiting-summary-list">
                                                            <li>
                                                                <div class="booking-item-raiting-list-title">Sleep</div>
                                                                <ul class="icon-group booking-item-rating-stars">
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li>
                                                                <div class="booking-item-raiting-list-title">Location</div>
                                                                <ul class="icon-group booking-item-rating-stars">
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li>
                                                                <div class="booking-item-raiting-list-title">Service</div>
                                                                <ul class="icon-group booking-item-rating-stars">
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <ul class="list booking-item-raiting-summary-list">
                                                            <li>
                                                                <div class="booking-item-raiting-list-title">Clearness</div>
                                                                <ul class="icon-group booking-item-rating-stars">
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li>
                                                                <div class="booking-item-raiting-list-title">Rooms</div>
                                                                <ul class="icon-group booking-item-rating-stars">
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="booking-item-review-expand"><span class="booking-item-review-expand-more">More <i class="fa fa-angle-down"></i></span><span class="booking-item-review-expand-less">Less <i class="fa fa-angle-up"></i></span>
                                            </div>
                                            <p class="booking-item-review-rate">Was this review helpful?
                                                <a class="fa fa-thumbs-o-up box-icon-inline round" href="#"></a><b class="text-color"> 13</b>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="booking-item-review-person">
                                            <a class="booking-item-review-person-avatar round" href="#">
                                                <img src="<?php echo getFromTemplate("images/70x70.png"); ?>" alt="Image Alternative text" title="Good job" />
                                            </a>
                                            <p class="booking-item-review-person-name"><a href="#">Cyndy Naquin</a>
                                            </p>
                                            <p class="booking-item-review-person-loc">Palm Beach, FL</p><small><a href="#">146 Reviews</a></small>
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="booking-item-review-content">
                                            <h5>"Faucibus in litora"</h5>
                                            <ul class="icon-group booking-item-rating-stars">
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                            </ul>
                                            <p>Lectus viverra nascetur neque vivamus per eleifend cras volutpat bibendum proin nibh nascetur libero ullamcorper ultricies fames magna consectetur nisi fames justo dictum neque cum vel ligula habitant varius faucibus rutrum suspendisse est duis<span class="booking-item-review-more"> Massa netus egestas tincidunt lorem malesuada integer aliquet adipiscing auctor tristique torquent vulputate eros felis cursus purus montes proin auctor condimentum tincidunt quis gravida lacus quisque lobortis dictumst morbi convallis litora feugiat senectus lobortis sodales vivamus bibendum pulvinar dis taciti phasellus justo nulla dolor libero lobortis</span>
                                            </p>
                                            <div class="booking-item-review-more-content">
                                                <p>Porttitor posuere purus hendrerit montes nisl interdum at proin nisl ridiculus ante hendrerit ut porta etiam aliquet faucibus mattis egestas sociosqu vehicula auctor suspendisse hendrerit</p>
                                                <p>Nascetur potenti ornare posuere imperdiet eu mus litora convallis conubia aptent primis ac bibendum consequat blandit purus magnis dui orci nam dui facilisis viverra dapibus nec suspendisse donec sagittis laoreet sollicitudin turpis cubilia consequat</p>
                                                <p class="text-small mt20">Stayed March 2014, traveled as a couple</p>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <ul class="list booking-item-raiting-summary-list">
                                                            <li>
                                                                <div class="booking-item-raiting-list-title">Sleep</div>
                                                                <ul class="icon-group booking-item-rating-stars">
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li>
                                                                <div class="booking-item-raiting-list-title">Location</div>
                                                                <ul class="icon-group booking-item-rating-stars">
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o text-gray"></i>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li>
                                                                <div class="booking-item-raiting-list-title">Service</div>
                                                                <ul class="icon-group booking-item-rating-stars">
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o text-gray"></i>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <ul class="list booking-item-raiting-summary-list">
                                                            <li>
                                                                <div class="booking-item-raiting-list-title">Clearness</div>
                                                                <ul class="icon-group booking-item-rating-stars">
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li>
                                                                <div class="booking-item-raiting-list-title">Rooms</div>
                                                                <ul class="icon-group booking-item-rating-stars">
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="booking-item-review-expand"><span class="booking-item-review-expand-more">More <i class="fa fa-angle-down"></i></span><span class="booking-item-review-expand-less">Less <i class="fa fa-angle-up"></i></span>
                                            </div>
                                            <p class="booking-item-review-rate">Was this review helpful?
                                                <a class="fa fa-thumbs-o-up box-icon-inline round" href="#"></a><b class="text-color"> 11</b>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="booking-item-review-person">
                                            <a class="booking-item-review-person-avatar round" href="#">
                                                <img src="<?php echo getFromTemplate("images/70x70.png"); ?>" alt="Image Alternative text" title="Chiara" />
                                            </a>
                                            <p class="booking-item-review-person-name"><a href="#">Carol Blevins</a>
                                            </p>
                                            <p class="booking-item-review-person-loc">Palm Beach, FL</p><small><a href="#">123 Reviews</a></small>
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="booking-item-review-content">
                                            <h5>"Purus diam leo magna mauris nisi lacinia"</h5>
                                            <ul class="icon-group booking-item-rating-stars">
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                            </ul>
                                            <p>Tempor nullam eu euismod convallis ante semper quisque nibh enim facilisi arcu congue dis faucibus tristique ad hendrerit vel massa dapibus praesent senectus nibh turpis pretium accumsan imperdiet auctor habitant congue nibh ac auctor duis leo mus suscipit ultricies<span class="booking-item-review-more"> Ornare at cursus fermentum lacus iaculis vestibulum ac mattis sociis purus auctor commodo eu ligula consectetur ultricies at natoque egestas dis aenean arcu vulputate orci massa in metus lorem habitasse mi integer ipsum turpis vel pretium phasellus ad nulla bibendum volutpat adipiscing a natoque nascetur ridiculus auctor rutrum conubia nisi facilisis semper tempus hac ornare erat nam imperdiet neque donec id mi bibendum erat aptent convallis nostra malesuada</span>
                                            </p>
                                            <div class="booking-item-review-more-content">
                                                <p>Sed aliquet cubilia mi habitant nibh cras lectus turpis nunc nascetur sit dolor mattis tortor risus leo</p>
                                                <p>Arcu condimentum torquent hac odio parturient est curae bibendum mattis maecenas natoque primis curabitur ornare sed lacus mollis habitasse neque molestie cubilia placerat conubia tellus urna elementum curabitur sapien iaculis consectetur tempus cubilia lectus tristique aenean est nisi porta semper ac semper blandit velit porttitor nascetur diam phasellus dolor sem</p>
                                                <p class="text-small mt20">Stayed March 2014, traveled as a couple</p>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <ul class="list booking-item-raiting-summary-list">
                                                            <li>
                                                                <div class="booking-item-raiting-list-title">Sleep</div>
                                                                <ul class="icon-group booking-item-rating-stars">
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li>
                                                                <div class="booking-item-raiting-list-title">Location</div>
                                                                <ul class="icon-group booking-item-rating-stars">
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li>
                                                                <div class="booking-item-raiting-list-title">Service</div>
                                                                <ul class="icon-group booking-item-rating-stars">
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <ul class="list booking-item-raiting-summary-list">
                                                            <li>
                                                                <div class="booking-item-raiting-list-title">Clearness</div>
                                                                <ul class="icon-group booking-item-rating-stars">
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li>
                                                                <div class="booking-item-raiting-list-title">Rooms</div>
                                                                <ul class="icon-group booking-item-rating-stars">
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="booking-item-review-expand"><span class="booking-item-review-expand-more">More <i class="fa fa-angle-down"></i></span><span class="booking-item-review-expand-less">Less <i class="fa fa-angle-up"></i></span>
                                            </div>
                                            <p class="booking-item-review-rate">Was this review helpful?
                                                <a class="fa fa-thumbs-o-up box-icon-inline round" href="#"></a><b class="text-color"> 16</b>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="booking-item-review-person">
                                            <a class="booking-item-review-person-avatar round" href="#">
                                                <img src="<?php echo getFromTemplate("images/70x70.png"); ?>" alt="Image Alternative text" title="Gamer Chick" />
                                            </a>
                                            <p class="booking-item-review-person-name"><a href="#">Cheryl Gustin</a>
                                            </p>
                                            <p class="booking-item-review-person-loc">Palm Beach, FL</p><small><a href="#">29 Reviews</a></small>
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="booking-item-review-content">
                                            <h5>"Morbi platea sollicitudin adipiscing fames duis maecenas"</h5>
                                            <ul class="icon-group booking-item-rating-stars">
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                            </ul>
                                            <p>Dapibus aliquam vivamus libero pretium sociis dignissim nisi ornare euismod nec est justo massa gravida fames vulputate auctor egestas ante suscipit augue lacinia gravida velit conubia pharetra mollis risus facilisis dignissim lobortis euismod dolor placerat<span class="booking-item-review-more"> Maecenas vel ultrices id lacus proin ante vulputate ornare congue placerat quam vivamus ante lacinia hendrerit rhoncus ad habitasse ante taciti vivamus auctor molestie nisl ipsum per aliquam sociis etiam pulvinar eros tortor ante id lectus odio porta dictumst facilisi integer phasellus elit aliquam aenean vivamus curabitur iaculis taciti aptent ac morbi quis tempor in est amet ultrices ipsum quam natoque</span>
                                            </p>
                                            <div class="booking-item-review-more-content">
                                                <p>Cum pellentesque potenti phasellus aenean egestas iaculis duis mi porta litora mi conubia dictum dictumst libero rutrum erat est fusce vestibulum aliquam ultricies adipiscing parturient class tempor suspendisse facilisis molestie gravida</p>
                                                <p>Phasellus tincidunt vel aliquet sociosqu tempor laoreet dignissim diam elementum neque massa aliquam leo maecenas duis enim litora pulvinar aliquam dictumst quis laoreet diam per facilisis cursus hac ante mus aenean sem dapibus malesuada nulla elementum iaculis</p>
                                                <p class="text-small mt20">Stayed March 2014, traveled as a couple</p>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <ul class="list booking-item-raiting-summary-list">
                                                            <li>
                                                                <div class="booking-item-raiting-list-title">Sleep</div>
                                                                <ul class="icon-group booking-item-rating-stars">
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li>
                                                                <div class="booking-item-raiting-list-title">Location</div>
                                                                <ul class="icon-group booking-item-rating-stars">
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li>
                                                                <div class="booking-item-raiting-list-title">Service</div>
                                                                <ul class="icon-group booking-item-rating-stars">
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <ul class="list booking-item-raiting-summary-list">
                                                            <li>
                                                                <div class="booking-item-raiting-list-title">Clearness</div>
                                                                <ul class="icon-group booking-item-rating-stars">
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o text-gray"></i>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li>
                                                                <div class="booking-item-raiting-list-title">Rooms</div>
                                                                <ul class="icon-group booking-item-rating-stars">
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o text-gray"></i>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="booking-item-review-expand"><span class="booking-item-review-expand-more">More <i class="fa fa-angle-down"></i></span><span class="booking-item-review-expand-less">Less <i class="fa fa-angle-up"></i></span>
                                            </div>
                                            <p class="booking-item-review-rate">Was this review helpful?
                                                <a class="fa fa-thumbs-o-up box-icon-inline round" href="#"></a><b class="text-color"> 20</b>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="booking-item-review-person">
                                            <a class="booking-item-review-person-avatar round" href="#">
                                                <img src="<?php echo getFromTemplate("images/70x70.png"); ?>" alt="Image Alternative text" title="AMaze" />
                                            </a>
                                            <p class="booking-item-review-person-name"><a href="#">Joe Smith</a>
                                            </p>
                                            <p class="booking-item-review-person-loc">Palm Beach, FL</p><small><a href="#">113 Reviews</a></small>
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="booking-item-review-content">
                                            <h5>"Nisl adipiscing tempor massa sit sodales lacus"</h5>
                                            <ul class="icon-group booking-item-rating-stars">
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                            </ul>
                                            <p>Turpis odio dapibus consequat lacus accumsan nibh per interdum justo donec facilisis placerat senectus nostra praesent nostra platea tortor curabitur aliquam vulputate pellentesque fermentum eu dolor volutpat laoreet<span class="booking-item-review-more"> Dui eu luctus egestas cursus posuere egestas tristique vivamus lectus senectus dictumst a velit hac facilisi bibendum duis laoreet vel mus porta cum himenaeos est hac augue et nascetur phasellus feugiat tempor facilisi nulla magna tortor sagittis parturient pellentesque mus tristique purus lacinia nec vitae himenaeos tincidunt dapibus sollicitudin magna odio arcu tellus nec rhoncus litora tempus nisl tellus commodo egestas</span>
                                            </p>
                                            <div class="booking-item-review-more-content">
                                                <p>Aenean aliquet dictumst quam sociis tempor lectus sapien lorem lobortis blandit dolor ultricies interdum sociosqu fermentum pellentesque sagittis ultrices volutpat odio donec amet nam fringilla quisque lacus tellus praesent aliquam scelerisque eros erat convallis himenaeos neque ullamcorper odio taciti dapibus cursus ornare magnis tempor</p>
                                                <p>Vivamus quisque vivamus amet senectus at montes mattis pellentesque curae tristique nullam vestibulum convallis et eget posuere nec iaculis per habitasse nibh laoreet rutrum tempor ridiculus curae ultricies proin donec ridiculus ultricies turpis magna vulputate cubilia suspendisse praesent amet integer mus luctus odio at lorem tempor volutpat vestibulum nec magnis sociis libero fringilla laoreet himenaeos hendrerit posuere eu fringilla ante dictum cras urna habitasse potenti nibh tincidunt</p>
                                                <p class="text-small mt20">Stayed March 2014, traveled as a couple</p>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <ul class="list booking-item-raiting-summary-list">
                                                            <li>
                                                                <div class="booking-item-raiting-list-title">Sleep</div>
                                                                <ul class="icon-group booking-item-rating-stars">
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li>
                                                                <div class="booking-item-raiting-list-title">Location</div>
                                                                <ul class="icon-group booking-item-rating-stars">
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li>
                                                                <div class="booking-item-raiting-list-title">Service</div>
                                                                <ul class="icon-group booking-item-rating-stars">
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <ul class="list booking-item-raiting-summary-list">
                                                            <li>
                                                                <div class="booking-item-raiting-list-title">Clearness</div>
                                                                <ul class="icon-group booking-item-rating-stars">
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li>
                                                                <div class="booking-item-raiting-list-title">Rooms</div>
                                                                <ul class="icon-group booking-item-rating-stars">
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="booking-item-review-expand"><span class="booking-item-review-expand-more">More <i class="fa fa-angle-down"></i></span><span class="booking-item-review-expand-less">Less <i class="fa fa-angle-up"></i></span>
                                            </div>
                                            <p class="booking-item-review-rate">Was this review helpful?
                                                <a class="fa fa-thumbs-o-up box-icon-inline round" href="#"></a><b class="text-color"> 19</b>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="booking-item-review-person">
                                            <a class="booking-item-review-person-avatar round" href="#">
                                                <img src="<?php echo getFromTemplate("images/70x70.png"); ?>" alt="Image Alternative text" title="Me with the Uke" />
                                            </a>
                                            <p class="booking-item-review-person-name"><a href="#">Ava McDonald</a>
                                            </p>
                                            <p class="booking-item-review-person-loc">Palm Beach, FL</p><small><a href="#">135 Reviews</a></small>
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="booking-item-review-content">
                                            <h5>"Non ridiculus purus ipsum pharetra fringilla"</h5>
                                            <ul class="icon-group booking-item-rating-stars">
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                            </ul>
                                            <p>Dictum elit tempus suscipit vulputate neque bibendum felis sagittis curae nostra dictum ornare dictum fermentum justo dapibus iaculis mus malesuada leo velit curabitur in auctor<span class="booking-item-review-more"> Ornare ligula nam cubilia penatibus felis vivamus enim primis auctor consectetur magna ante nascetur urna libero hac cum turpis eleifend tellus parturient ac lacus facilisi lacus porta convallis taciti feugiat varius urna euismod phasellus egestas ultrices sagittis fusce malesuada porttitor blandit odio elit hac in lacus lacinia magnis laoreet</span>
                                            </p>
                                            <div class="booking-item-review-more-content">
                                                <p>Aptent massa dolor lacus hac litora at class placerat quisque dictumst orci tempor himenaeos curae sed etiam quisque auctor sagittis primis tortor metus</p>
                                                <p>Felis nec enim nisl nostra per sagittis ullamcorper imperdiet fusce viverra mollis taciti lectus scelerisque augue quisque felis posuere nulla facilisis scelerisque pharetra quisque dignissim elit diam nisi penatibus magnis dapibus pretium lacinia torquent convallis egestas posuere etiam aliquam posuere duis a fringilla enim dictum tortor accumsan litora faucibus felis mi lacinia sociis commodo suscipit pulvinar ligula nibh litora malesuada ipsum orci felis facilisi interdum neque</p>
                                                <p class="text-small mt20">Stayed March 2014, traveled as a couple</p>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <ul class="list booking-item-raiting-summary-list">
                                                            <li>
                                                                <div class="booking-item-raiting-list-title">Sleep</div>
                                                                <ul class="icon-group booking-item-rating-stars">
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li>
                                                                <div class="booking-item-raiting-list-title">Location</div>
                                                                <ul class="icon-group booking-item-rating-stars">
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li>
                                                                <div class="booking-item-raiting-list-title">Service</div>
                                                                <ul class="icon-group booking-item-rating-stars">
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <ul class="list booking-item-raiting-summary-list">
                                                            <li>
                                                                <div class="booking-item-raiting-list-title">Clearness</div>
                                                                <ul class="icon-group booking-item-rating-stars">
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li>
                                                                <div class="booking-item-raiting-list-title">Rooms</div>
                                                                <ul class="icon-group booking-item-rating-stars">
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o"></i>
                                                                    </li>
                                                                    <li><i class="fa fa-smile-o text-gray"></i>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="booking-item-review-expand"><span class="booking-item-review-expand-more">More <i class="fa fa-angle-down"></i></span><span class="booking-item-review-expand-less">Less <i class="fa fa-angle-up"></i></span>
                                            </div>
                                            <p class="booking-item-review-rate">Was this review helpful?
                                                <a class="fa fa-thumbs-o-up box-icon-inline round" href="#"></a><b class="text-color"> 8</b>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="row wrap">
                            <div class="col-md-5">
                                <p><small>1108 reviews on this hotel. &nbsp;&nbsp;Showing 1 to 7</small>
                                </p>
                            </div>
                            <div class="col-md-7">
                                <ul class="pagination">
                                    <li class="active"><a href="#">1</a>
                                    </li>
                                    <li><a href="#">2</a>
                                    </li>
                                    <li><a href="#">3</a>
                                    </li>
                                    <li><a href="#">4</a>
                                    </li>
                                    <li><a href="#">5</a>
                                    </li>
                                    <li><a href="#">6</a>
                                    </li>
                                    <li><a href="#">7</a>
                                    </li>
                                    <li class="dots">...</li>
                                    <li><a href="#">43</a>
                                    </li>
                                    <li class="next"><a href="#">Next Page</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="gap gap-small"></div>
                        <div class="box bg-gray">
                            <h3>Write a Review</h3>
                            <form>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Review Title</label>
                                            <input class="form-control" type="text" />
                                        </div>
                                        <div class="form-group">
                                            <label>Review Text</label>
                                            <textarea class="form-control" rows="6"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="list booking-item-raiting-summary-list stats-list-select">
                                            <li>
                                                <div class="booking-item-raiting-list-title">Sleep</div>
                                                <ul class="icon-group booking-item-rating-stars">
                                                    <li><i class="fa fa-smile-o"></i>
                                                    </li>
                                                    <li><i class="fa fa-smile-o"></i>
                                                    </li>
                                                    <li><i class="fa fa-smile-o"></i>
                                                    </li>
                                                    <li><i class="fa fa-smile-o"></i>
                                                    </li>
                                                    <li><i class="fa fa-smile-o"></i>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <div class="booking-item-raiting-list-title">Location</div>
                                                <ul class="icon-group booking-item-rating-stars">
                                                    <li><i class="fa fa-smile-o"></i>
                                                    </li>
                                                    <li><i class="fa fa-smile-o"></i>
                                                    </li>
                                                    <li><i class="fa fa-smile-o"></i>
                                                    </li>
                                                    <li><i class="fa fa-smile-o"></i>
                                                    </li>
                                                    <li><i class="fa fa-smile-o"></i>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <div class="booking-item-raiting-list-title">Service</div>
                                                <ul class="icon-group booking-item-rating-stars">
                                                    <li><i class="fa fa-smile-o"></i>
                                                    </li>
                                                    <li><i class="fa fa-smile-o"></i>
                                                    </li>
                                                    <li><i class="fa fa-smile-o"></i>
                                                    </li>
                                                    <li><i class="fa fa-smile-o"></i>
                                                    </li>
                                                    <li><i class="fa fa-smile-o"></i>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <div class="booking-item-raiting-list-title">Clearness</div>
                                                <ul class="icon-group booking-item-rating-stars">
                                                    <li><i class="fa fa-smile-o"></i>
                                                    </li>
                                                    <li><i class="fa fa-smile-o"></i>
                                                    </li>
                                                    <li><i class="fa fa-smile-o"></i>
                                                    </li>
                                                    <li><i class="fa fa-smile-o"></i>
                                                    </li>
                                                    <li><i class="fa fa-smile-o"></i>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <div class="booking-item-raiting-list-title">Rooms</div>
                                                <ul class="icon-group booking-item-rating-stars">
                                                    <li><i class="fa fa-smile-o"></i>
                                                    </li>
                                                    <li><i class="fa fa-smile-o"></i>
                                                    </li>
                                                    <li><i class="fa fa-smile-o"></i>
                                                    </li>
                                                    <li><i class="fa fa-smile-o"></i>
                                                    </li>
                                                    <li><i class="fa fa-smile-o"></i>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                        <input class="btn btn-primary" type="submit" value="Leave a Review" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h4>Hotels Near InterContinental New York Barclay</h4>
                        <ul class="booking-list">
                            <li>
                                <div class="booking-item booking-item-small">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <img src="<?php echo getFromTemplate("images/800x600.png"); ?>" alt="Image Alternative text" title="hotel PORTO BAY SERRA GOLF living room" />
                                        </div>
                                        <div class="col-xs-5">
                                            <h5 class="booking-item-title">Waldorf Astoria New York</h5>
                                            <ul class="icon-group booking-item-rating-stars">
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-xs-3"><span class="booking-item-price-from">from</span><span class="booking-item-price">$345</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="booking-item booking-item-small">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <img src="<?php echo getFromTemplate("images/800x600.png"); ?>" alt="Image Alternative text" title="hotel PORTO BAY LIBERDADE" />
                                        </div>
                                        <div class="col-xs-5">
                                            <h5 class="booking-item-title">Holiday Inn Express Kennedy Airport</h5>
                                            <ul class="icon-group booking-item-rating-stars">
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star-half-empty"></i>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-xs-3"><span class="booking-item-price-from">from</span><span class="booking-item-price">$223</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="booking-item booking-item-small">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <img src="<?php echo getFromTemplate("images/800x600.png"); ?>" alt="Image Alternative text" title="hotel THE CLIFF BAY spa suite" />
                                        </div>
                                        <div class="col-xs-5">
                                            <h5 class="booking-item-title">Wellington Hotel</h5>
                                            <ul class="icon-group booking-item-rating-stars">
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star-o"></i>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-xs-3"><span class="booking-item-price-from">from</span><span class="booking-item-price">$395</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="booking-item booking-item-small">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <img src="<?php echo getFromTemplate("images/800x600.png"); ?>" alt="Image Alternative text" title="hotel 2" />
                                        </div>
                                        <div class="col-xs-5">
                                            <h5 class="booking-item-title">New York Hilton Midtown</h5>
                                            <ul class="icon-group booking-item-rating-stars">
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star-half-empty"></i>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-xs-3"><span class="booking-item-price-from">from</span><span class="booking-item-price">$166</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="booking-item booking-item-small">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <img src="<?php echo getFromTemplate("images/800x600.png"); ?>" alt="Image Alternative text" title="The pool" />
                                        </div>
                                        <div class="col-xs-5">
                                            <h5 class="booking-item-title">Grand Hyatt New York</h5>
                                            <ul class="icon-group booking-item-rating-stars">
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star-o"></i>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-xs-3"><span class="booking-item-price-from">from</span><span class="booking-item-price">$423</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="booking-item booking-item-small">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <img src="<?php echo getFromTemplate("images/800x600.png"); ?>" alt="Image Alternative text" title="hotel PORTO BAY RIO INTERNACIONAL rooftop pool" />
                                        </div>
                                        <div class="col-xs-5">
                                            <h5 class="booking-item-title">Warwick New York Hotel</h5>
                                            <ul class="icon-group booking-item-rating-stars">
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                <li><i class="fa fa-star-half-empty"></i>
                                                </li>
                                                <li><i class="fa fa-star-o"></i>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-xs-3"><span class="booking-item-price-from">from</span><span class="booking-item-price">$218</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    
        <article class="container">
            <div class="row">
                <div class="col-md-8 mb20">
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
                    <div class="row mb10">
                        <div class="col-md-12" itemprop="description">
                            <?php echo $hotel['descr']; ?>
                        </div>
                    </div>
                    <div class="row mt30">
                        <?php
                        $lz_offset = 1;
                        $lz_limit = 9;
                        $lz_pages = 0;
                        $num_records = 0;
                        $result = $db->query("SELECT count(*) FROM pm_activity WHERE hotels REGEXP '(^|,)".$hotel_id."(,|$)' AND checked = 1 AND lang = ".LANG_ID);
                        if($result !== false){
                            $num_records = $result->fetchColumn(0);
                            $lz_pages = ceil($num_records/$lz_limit);
                        }
                        if($num_records > 0){ ?>
                            <h3><?php echo $texts['FIND_ACTIVITIES_AND_TOURS']; ?></h3>
                            <div class="isotopeWrapper clearfix isotope lazy-wrapper" data-loader="<?php echo getFromTemplate("common/get_activities.php"); ?>" data-mode="click" data-limit="<?php echo $lz_limit; ?>" data-pages="<?php echo $lz_pages; ?>" data-is_isotope="true" data-variables="page_id=<?php echo $sys_pages['activities']['id']; ?>&page_alias=<?php echo $sys_pages['activities']['alias']; ?>&hotel=<?php echo $hotel_id; ?>">
                                <?php include(getFromTemplate("common/get_activities.php", false)); ?>
                            </div>
                            <?php
                        } ?>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
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
                            include(getFromTemplate("common/comments.php", false)); ?>
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
                        <div id="mapWrapper" class="mb10" data-marker="<?php echo getFromTemplate("images/marker.png"); ?>" data-api_key="<?php echo GMAPS_API_KEY; ?>"></div>
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
                            }
                        } ?>
                    </div>
                </aside>
            </div>
        </article>
    </div>
</section>

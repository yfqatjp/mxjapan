<?php
if($article_alias == "") err404();

$result = $db->query("SELECT * FROM pm_notice WHERE checked = 1 AND lang = ".LANG_ID." AND alias = ".$db->quote($article_alias));
if($result !== false && $db->last_row_count() == 1){
    
    $notice = $result->fetch(PDO::FETCH_ASSOC);
    
    $notice_id = $notice['id'];
    $article_id = $notice_id;
    $title_tag = $notice['title']." - ".$title_tag;
    $page_title = $notice['title'];
    $page_subtitle = "";
    $page_alias = $pages[$page_id]['alias']."/".text_format($notice['alias']);

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
        <div class="container">
            <div class="alert alert-success" style="display:none;"></div>
            <div class="alert alert-danger" style="display:none;"></div>
        </div>
    
        <article class="container">
            <div class="row">
                <div class="col-md-8 mb20">
                    <div class="row mb10">
                        <div class="col-sm-8">
                            <h1 class="mb0"><?php echo $notice['title']; ?></h1>
                        </div>
                        <div class="col-md-12" itemprop="description">
                            <?php echo $notice['text']; ?>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>

<?php
$stylesheets[] = array("file" => DOCBASE."js/plugins/isotope/css/style.css", "media" => "all");
$javascripts[] = DOCBASE."js/plugins/isotope/jquery.isotope.min.js";
$javascripts[] = DOCBASE."js/plugins/isotope/jquery.isotope.sloppy-masonry.min.js";

$stylesheets[] = array("file" => DOCBASE."js/plugins/lazyloader/lazyloader.css", "media" => "all");
$javascripts[] = DOCBASE."js/plugins/lazyloader/lazyloader.js";

require(SYSBASE."templates/".TEMPLATE."/common/header.php"); ?>

<section id="page">
    
    <?php include(SYSBASE."templates/".TEMPLATE."/common/page_header.php"); ?>
    
    <div id="content" class="pt30 pb20">
        <div class="container">
            <div class="row">
                <?php
                if($page['text'] != ""){ ?>
                    <div class="col-md-12"><?php echo $page['text']; ?></div>
                    <?php
                } ?>
            </div>
            <div class="row">
                <?php
                $lz_offset = 1;
                $lz_limit = 9;
                $lz_pages = 0;
                $num_records = 0;
                $result = $db->query("SELECT count(*) FROM pm_hotel WHERE checked = 1 AND lang = ".LANG_ID);
                if($result !== false){
                    $num_records = $result->fetchColumn(0);
                    $lz_pages = ceil($num_records/$lz_limit);
                }
                if($num_records > 0){ ?>
                    <div class="isotopeWrapper clearfix isotope lazy-wrapper" data-loader="<?php echo DOCBASE."templates/".TEMPLATE."/common/get_hotels.php"; ?>" data-mode="click" data-limit="<?php echo $lz_limit; ?>" data-pages="<?php echo $lz_pages; ?>" data-is_isotope="true" data-variables="page_id=<?php echo $page_id; ?>&page_alias=<?php echo $page['alias']; ?>">
                        <?php include(SYSBASE."templates/".TEMPLATE."/common/get_hotels.php"); ?>
                    </div>
                    <?php
                } ?>
            </div>
        </div>
    </div>
</section>


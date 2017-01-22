<?php
/**
 * Script called (Ajax) on scroll or click
 * loads more content with Lazy Loader
 */
$html = "";
if(!isset($lz_offset)) $lz_offset = 1;
if(!isset($lz_limit)) $lz_limit = 30;
if(isset($_POST['ajax']) && $_POST['ajax'] == 1){
    
    require_once("../../../common/lib.php");
    require_once("../../../common/define.php");

    if(isset($_POST['offset']) && is_numeric($_POST['offset'])
    && isset($_POST['limit']) && is_numeric($_POST['limit'])
    && isset($_POST['page_id']) && is_numeric($_POST['page_id'])
    && isset($_POST['page_alias'])){
        $page_id = $_POST['page_id'];
        $lz_offset = $_POST['offset'];
        $lz_limit =	$_POST['limit'];
        $page_alias = $_POST['page_alias'];
    }
}
if(isset($db) && $db !== false){
    
    if(isset($page_id) && isset($pages[$page_id]['alias'])) $page_alias = $pages[$page_id]['alias'];

    $result_notice = $db->query("SELECT * FROM pm_notice WHERE lang = ".LANG_ID." AND checked = 1 ORDER BY rank LIMIT ".($lz_offset-1)*$lz_limit.", ".$lz_limit);

    $notice_id = 0;
    foreach($result_notice as $i => $row){
                                
        $notice_id = $row['id'];
        $notice_title = $row['title'];
        $notice_alias = DOCBASE.$page_alias."/".text_format($notice_id);
        
        $html .= "
        <article class=\"col-sm-4 isotopeItem\" itemscope itemtype=\"http://schema.org/LodgingBusiness\">
            <div class=\"isotopeInner\">
                <a itemprop=\"url\" href=\"".$notice_alias."\">";
                    $html .= "
                    <div class=\"isotopeContent\">
                        <h3 itemprop=\"name\">".$notice_title."</h3>";
                        $html .= "
                        <div class=\"row\">";
                        	$html .= "
                            <div class=\"col-xs-6\">
                                <span class=\"btn btn-primary mt5 pull-right\">".$texts['MORE_DETAILS']."</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </article>";
    }
    if(isset($_POST['ajax']) && $_POST['ajax'] == 1)
        echo json_encode(array("html" => $html));
    else
        echo $html;
}

<?php
/* ==============================================
 * CSS AND JAVASCRIPT USED IN THIS MODEL
 * ==============================================
 */
$stylesheets[] = array("file" => DOCBASE."js/plugins/royalslider/royalslider.css", "media" => "all");
$stylesheets[] = array("file" => DOCBASE."js/plugins/royalslider/skins/minimal-white/rs-minimal-white.css", "media" => "all");
$javascripts[] = DOCBASE."js/plugins/royalslider/jquery.royalslider.min.js";

$stylesheets[] = array("file" => DOCBASE."js/plugins/isotope/css/style.css", "media" => "all");
$javascripts[] = DOCBASE."js/plugins/isotope/jquery.isotope.min.js";
$javascripts[] = DOCBASE."js/plugins/isotope/jquery.isotope.sloppy-masonry.min.js";
$javascripts[] = DOCBASE."common/bootstrap/js/bootstrap-progressbar.min.js";
$javascripts[] = DOCBASE."common/js/jquery.countTo.js";
//$javascripts[] = DOCBASE."common/js/plugins/prettyPhoto/jquery.prettyPhoto.init.min.js";
//$javascripts[] = DOCBASE."common/js/plugins/prettyPhoto/jquery.prettyPhoto.js";

require(SYSBASE."templates/".TEMPLATE."/common/header.php");

$slide_id = 0;
$result_slide_file = $db->prepare("SELECT * FROM pm_slide_file WHERE id_item = :slide_id AND checked = 1 AND lang = ".DEFAULT_LANG." AND type = 'image' AND file != '' ORDER BY rank LIMIT 1");
$result_slide_file->bindParam("slide_id", $slide_id);

$result_slide = $db->query("SELECT * FROM pm_slide WHERE id_page = ".$page_id." AND checked = 1 AND lang = ".LANG_ID." ORDER BY rank", PDO::FETCH_ASSOC);
if($result_slide !== false){
	$nb_slides = $db->last_row_count();
	if($nb_slides > 0){ ?>
        
       <!-- 
       
        <div id="search-home-wrapper">
            <div id="search-home" class="container">
                <?php include(SYSBASE."templates/".TEMPLATE."/common/search.php"); ?>
            </div>
        </div>
 -->
		<section id="sliderContainer">
            
            <div class="royalSlider rsMinW fullSized clearfix">
                <?php
                foreach($result_slide as $i => $row){
                    $slide_id = $row['id'];
                    $slide_legend = $row['legend'];
                    $url_video = $row['url'];
                    $id_page = $row['id_page'];
                    
                    $result_slide_file->execute();
                    
                    if($result_slide_file !== false && $db->last_row_count() == 1){
                        $row = $result_slide_file->fetch();
                        
                        $file_id = $row['id'];
                        $filename = $row['file'];
                        $label = $row['label'];
                        
                        $realpath = SYSBASE."medias/slide/big/".$file_id."/".$filename;
                        $thumbpath = DOCBASE."medias/slide/small/".$file_id."/".$filename;
                        $zoompath = DOCBASE."medias/slide/big/".$file_id."/".$filename;
                            
                        if(is_file($realpath)){ ?>
                        
                            <div class="rsContent">
                                <img class="rsImg" src="<?php echo $zoompath; ?>" alt=""<?php if($url_video != "") echo " data-rsVideo=\"".$url_video."\""; ?>>
                                <?php
                                if($slide_legend != ""){ ?>
                                    <div class="infoBlock" data-fade-effect="" data-move-offset="10" data-move-effect="bottom" data-speed="200">
                                        <?php echo $slide_legend; ?>
                                    </div>
                                    <?php
                                } ?>
                            </div>
                            <?php
                        }
                    }
                } ?>
            </div>
		</section>
		<?php
	}
} ?>

	<div class="section pt-5">
		<div class="container">
			<div class="row">
				<div data-wow-delay="0.5s" class="col-md-12 col-sm-12 wow zoomIn">
					<h2 class="text-center mb-1"><?php echo $page['title']; ?></h2>
					<p class="text-primary text-center text-uppercase">― <?php echo $page['subtitle']; ?> ―</p>
					<div class="separator-inherit-theme mb-3">
						<hr class="mini-sep" />
					</div>
					<p class="text-center mb-5">
						<?php echo $page['text']; ?>
					</p>
				</div>
			</div>
		</div>
	</div>
	<div class="section pb-4">
		<div class="container">
			<div class="row">
				<div data-wow-delay="0.3s" class="col-sm-6 col-lg-3 col-md-3 wow zoomIn">
					<div class="icon-circle">
						<div class="icon-circle-inner">
							<i class="elegant_icon_lightbulb_alt"></i>
						</div>
					</div>
					<h4 class="text-center mt-3 mb-3">民宿 体験</h4>
					<p class="text-center mb-3">世界的な広がりを見せる「個人宅宿泊」であり、「交流や生活文化体験」を求める観光客のための宿泊施設。</p>
				</div>
				<div data-wow-delay="0.4s" class="col-sm-6 col-lg-3 col-md-3 wow zoomIn">
					<div class="icon-circle">
						<div class="icon-circle-inner">
							<i class="elegant_icon_bag_alt"></i>
						</div>
					</div>
					<h4 class="text-center mt-3 mb-3">租車 自驾</h4>
					<p class="text-center mb-3">家用車で近場から遠隔地まで自分たちのペースで動きやすく、公共の交通機関で行くのが難しい場所にも寄れる。</p>
				</div>
				<div data-wow-delay="0.5s" class="col-sm-6 col-lg-3 col-md-3 wow zoomIn">
					<div class="icon-circle">
						<div class="icon-circle-inner">
							<i class="elegant_icon_target"></i>
						</div>
					</div>
					<h4 class="text-center mt-3 mb-3">免税 购物</h4>
					<p class="text-center mb-3">海外でのショッピングと言えば、免税店。日本でのお買い物をお楽しみに。認定店舗数400店！</p>
				</div>
				<div data-wow-delay="0.6s" class="col-sm-6 col-lg-3 col-md-3 wow zoomIn">
					<div class="icon-circle">
						<div class="icon-circle-inner">
							<i class="elegant_icon_lifesaver"></i>
						</div>
					</div>
					<h4 class="text-center mt-3 mb-3">日游 攻略</h4>
					<p class="text-center mb-3">今、話題の自然、遊園地、食、温泉、ホテル、クーポン、イベント情報をご案内致します。</p>
				</div>
			</div>
		</div>
	</div>


	<div class="section">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6 col-lg-3 col-md-3 pr-0 pl-0">
					<div class="counter-block counter-1">
						<div class="counter counter-icon-top">
							<span data-wow-delay="0.3s" class="counter-icon wow zoomIn">
								<i class="elegant_icon_pens"></i>
							</span>
							<div class="counter-count">
								<span class="counter-number" data-from="0" data-to="750" data-speed="5000">750</span>
								<span class="counter-unit">+</span>
							</div>
							<div class="counter-text">民宿房间数</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-lg-3 col-md-3 pr-0 pl-0">
					<div class="counter-block counter-2">
						<div class="counter counter-icon-top">
							<span data-wow-delay="0.3s" class="counter-icon wow zoomIn">
								<i class="elegant_icon_group"></i>
							</span>
							<div class="counter-count">
								<span class="counter-number" data-from="0" data-to="11000" data-speed="5000">5500</span>
								<span class="counter-unit">+</span>
							</div>
							<div class="counter-text">各地租车数</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-lg-3 col-md-3 pr-0 pl-0">
					<div class="counter-block counter-3">
						<div class="counter counter-icon-top">
							<span data-wow-delay="0.3s" class="counter-icon wow zoomIn">
								<i class="elegant_icon_mug"></i>
							</span>
							<div class="counter-count">
								<span class="counter-number" data-from="0" data-to="5000" data-speed="5000">400</span>
								<span class="counter-unit">+</span>
							</div>
							<div class="counter-text">免税商家数</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-lg-3 col-md-3 pr-0 pl-0">
					<div class="counter-block counter-4">
						<div class="counter counter-icon-top">
							<span data-wow-delay="0.3s" class="counter-icon wow zoomIn">
								<i class="elegant_icon_like"></i>
							</span>
							<div class="counter-count">
								<span class="counter-number" data-from="0" data-to="300" data-speed="5000">300</span>
								<span class="counter-unit">+</span>
							</div>
							<div class="counter-text">每日情报数</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>				
				

	<div class="section">
		<div class="container">
			<div class="row">
				<div data-wow-delay="0.3s" class="col-sm-7 hidden-xs wow fadeInLeft">
					<div class="pt-5 pb-5 mln-13">
						<img src="<?php echo DOCBASE."templates/".TEMPLATE."/images/device.png"; ?>"  class="img-responsive" alt="" />
					</div>
				</div>
				<div class="col-sm-5">
					<div class="pt-10">
						<div data-wow-delay="0.3s" class="wow fadeInUp">
							<h2 class="mb-2">我们所拥有的车型</h2>
							<p class="text-primary text-uppercase">― 美溪車友倶楽部 ―</p>
							<p class="mt-1 mb-5">美溪車友倶楽部将为您在日本各地增添全方位，全天候的租车自驾服务，让你的日本之旅更加自由。</p>
						</div>
						<div class="group-progressbar style-tooltip">
							<div class="block-progressbar">
			                	<h5 class="progress-title">情侣跑车</h5>
			                  	<div role="progressbar" data-transitiongoal="60" class="progressbar"></div>
			                </div>
			                <div class="block-progressbar">
			                  	<h5 class="progress-title">舒适轿车</h5>
			                  	<div role="progressbar" data-transitiongoal="74" class="progressbar"></div>
			                </div>
			                <div class="block-progressbar">
			                  	<h5 class="progress-title">家庭3厢车</h5>
			                  	<div role="progressbar" data-transitiongoal="95" class="progressbar"></div>
			                </div>
			                <div class="block-progressbar">
			                  	<h5 class="progress-title">全能越野车</h5>
			                  	<div role="progressbar" data-transitiongoal="88" class="progressbar"></div>
			                </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	
	
	<div class="section mb-4">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<h2 class="mb-2">加盟商家</h2>
					<p class="text-primary text-uppercase mb-4">各种免税商家多数加盟中</p>
					<div class="icon-box-group">
						<div data-wow-delay="0.3s" class="block-icon-box-left-icon wow fadeInUp">
		                    <div class="icon pull-left">
		                    	<i class="elegant_icon_star_alt"></i>
		                    </div>
		                    <div class="right-side">
		                    	<h6 class="heading">信赖商家</h6>
		                    	<p class="content">美溪車友倶楽部所加盟的商家都是日本最大，正规审核通过的免税商家，日本全国400多家商家加盟中</p>
		                    </div>
		                </div>
		                <div data-wow-delay="0.3s" class="block-icon-box-left-icon wow fadeInUp">
		                    <div class="icon pull-left">
		                    	<i class="elegant_icon_bag_alt"></i>
		                    </div>
		                    <div class="right-side">
		                    	<h6 class="heading">世界名牌</h6>
		                    	<p class="content">拥有旗下包括服饰，化妆品，电器等500家世界名牌，为您打造真正的日本的购物天堂。</p>
		                    </div>
		                </div>
		                <div data-wow-delay="0.3s" class="block-icon-box-left-icon wow fadeInUp">
		                    <div class="icon pull-left">
		                    	<i class="elegant_icon_tools"></i>
		                    </div>
		                    <div class="right-side">
		                    	<h6 class="heading">提供日式服务</h6>
		                    	<p class="content">日本式服务是一种暖心的款待，是延续了日本千年文化和日本特有的习惯之后的一种深情款待，即用心细心贴心。</p>
		                    </div>
		                </div>
					</div>
				</div>
				<div class="col-sm-6 hidden-xs">
					<div class="pt-5">
						<div data-wow-delay="0.3s" class="col-sm-6 pr-0 pl-0 wow fadeInUp">
							<img width="404" height="478" src="<?php echo DOCBASE."templates/".TEMPLATE."/images/image_404x478.jpg"; ?>"  class="img-responsive"  alt="" />
						</div>
						<div data-wow-delay="0.5s" class="col-sm-6 pr-0 pl-0 wow fadeInUp">
							<img width="404" height="478" src="<?php echo DOCBASE."templates/".TEMPLATE."/images/image_404x478.jpg"; ?>" class="img-responsive"  alt="" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	
	
<!-- yothube 追加 -->

<div class="section parallax-background">
	<div class="container">
		<div class="row">
			<div data-wow-delay="0.3s" class="col-md-12 col-sm-12 text-center wow fadeInUp">
				 	<a data-wow-delay="0.5s" href="//www.youtube.com/watch?v=HUGmNi9QU5A&amp;width=800&amp;height=500" data-rel="prettyPhoto" class="video-embed-action wow zoomIn">
			         
			      <!--   	<a data-wow-delay="0.5s" href="//j.maka.im/k/ZKURFSGE?isApp=true&from=groupmessage&isappinstalled=1;width=800&amp;height=500" data-rel="prettyPhoto" class="video-embed-action wow zoomIn">
			         -->  
			          <i class="elegant_arrow_triangle-right_alt2 white"></i>
				</a>
				<h2 class="text-primary mb-2 mt-2">日本の風景 その美しい瞬間</h2>
				<p class="white mb-0">Japanese landscape. Its beautiful moment！</p>
			</div>
		</div>
	</div>
</div>

<div class="section pt-7">
	<div class="container-fluid">
		<div class="row">
			<div data-wow-delay="0.5s" class="col-md-12 col-sm-12 wow zoomIn">
				<h2 class="text-center mb-1">特色民宿 ＆ 星级酒店</h2>
				<p class="text-primary text-center text-uppercase">美溪加盟伙伴</p>
				<div class="separator-inherit-theme mb-3">
					<hr class="mini-sep" />
				</div>
				<p class="text-center mb-5">
					世界的な広がりを見せる「個人宅宿泊」であり、「交流や生活文化体験」を求める観光客のための宿泊施設。<br/>
					“走过走廊时木质的地板嘎吱作响” 这是旅客们对Toco这家老式民宿唯一印象。<br/>
					隐藏于高楼林立的东京市区的古老民宿Toco，虽然有着老式的日本庭院以及怀旧的木质家具，但是这家青年旅馆绝对只老不旧。
				</p>
			</div>
		</div>
	</div>
</div>


<section id="content" class="pt20 pb30">
     <div class="container"> 
  <!--  <div class="container-fluid">-->
    
    <!-- 
        <div class="row">
            <div class="col-md-12 text-center mb30">
                <h1 itemprop="name"><?php echo $page['title']; ?></h1>
                <?php
                if($page['subtitle'] != ""){ ?>
                    <h2><?php echo $page['subtitle']; ?></h2>
                    <?php
                } ?>
                <?php echo $page['text']; ?>
            </div>
        </div>
         -->
        <div class="row">
            <?php
            $result_hotel = $db->query("SELECT * FROM pm_hotel WHERE lang = ".LANG_ID." AND checked = 1 AND home = 1 ORDER BY rank");
            if($result_hotel !== false){
                $nb_hotels = $db->last_row_count();
                $hotel_id = 0;
                $result_hotel_file = $db->prepare("SELECT * FROM pm_hotel_file WHERE id_item = :hotel_id AND checked = 1 AND lang = ".DEFAULT_LANG." AND type = 'image' AND file != '' ORDER BY rank LIMIT 1");
                $result_hotel_file->bindParam(":hotel_id",$hotel_id);
                foreach($result_hotel as $i => $row){
                    $hotel_id = $row['id'];
                    $hotel_title = $row['title'];
                    $hotel_alias = $row['title'];
                    $hotel_subtitle = $row['subtitle'];
                    
                    $hotel_alias = DOCBASE.$pages[9]['alias']."/".text_format($row['alias']); ?>
                    
                    <article class="col-sm-4 mb20" itemscope itemtype="http://schema.org/LodgingBusiness">
                      <!--   <a itemprop="url" href="<?php echo $hotel_alias; ?>" class="moreLink">
                       -->
                          <a itemprop="url" href="" class="moreLink">
                            <?php
                            if($result_hotel_file->execute() !== false && $db->last_row_count() == 1){
                                $row = $result_hotel_file->fetch(PDO::FETCH_ASSOC);
                                
                                $file_id = $row['id'];
                                $filename = $row['file'];
                                $label = $row['label'];
                                
                                $realpath = SYSBASE."medias/hotel/small/".$file_id."/".$filename;
                                $thumbpath = DOCBASE."medias/hotel/small/".$file_id."/".$filename;
                                $zoompath = DOCBASE."medias/hotel/big/".$file_id."/".$filename;
                                
                                if(is_file($realpath)){ ?>
                                    <figure class="more-link">
                                        <div class="img-container md">
                                            <img alt="<?php echo $label; ?>" src="<?php echo $thumbpath; ?>">
                                        </div>
                                         
                                        <div class="more-content">
                                            <h3 itemprop="name"><?php echo $hotel_title; ?></h3>
                                        </div> 
                                        <div class="more-action">
                                            <div class="more-icon">
                                                <i class="fa fa-link"></i>
                                            </div>
                                        </div>
                                    </figure>
                                    <?php
                                }
                            } ?>
                        </a> 
                    </article>
                    <?php
                }
            } ?>
        </div>
        <div class="row">
            <?php
            $result_article = $db->query("SELECT * FROM pm_article WHERE (id_page = ".$page_id." OR home = 1) AND checked = 1 AND (publish_date IS NULL || publish_date <= ".time().") AND (unpublish_date IS NULL || unpublish_date > ".time().") AND lang = ".LANG_ID." ORDER BY rank");
            if($result_article !== false){
                $nb_articles = $db->last_row_count();
                
                if($nb_articles > 0){ ?>
                    <div class="clearfix">
                        <?php
                        $article_id = 0;
                        $result_article_file = $db->prepare("SELECT * FROM pm_article_file WHERE id_item = :article_id AND checked = 1 AND lang = ".DEFAULT_LANG." AND type = 'image' AND file != '' ORDER BY rank LIMIT 1");
                        $result_article_file->bindParam(":article_id", $article_id);
                        foreach($result_article as $i => $row){
                            $article_id = $row['id'];
                            $article_title = $row['title'];
                            $article_alias = $row['alias'];
                            $article_text = strtrunc($row['text'], 1200, true, "");
                            $article_page = $row['id_page'];
                            
                            if(isset($pages[$article_page])){
                            
                                $article_alias = DOCBASE.$pages[$article_page]['alias']."/".text_format($article_alias); ?>
                                
                                <article id="article-<?php echo $article_id; ?>" class="col-sm-12" itemscope itemtype="http://schema.org/Article">
                                    <div class="row">
                                        <a itemprop="url" href="<?php echo $article_alias; ?>" class="moreLink">
                                            <div class="col-sm-8 mb20">
                                                <?php
                                                if($result_article_file->execute() !== false && $db->last_row_count() == 1){
                                                    $row = $result_article_file->fetch(PDO::FETCH_ASSOC);
                                                    
                                                    $file_id = $row['id'];
                                                    $filename = $row['file'];
                                                    $label = $row['label'];
                                                    
                                                    $realpath = SYSBASE."medias/article/big/".$file_id."/".$filename;
                                                    $thumbpath = DOCBASE."medias/article/big/".$file_id."/".$filename;
                                                    $zoompath = DOCBASE."medias/article/big/".$file_id."/".$filename;
                                                    
                                                    if(is_file($realpath)){ ?>
                                                        <figure class="more-link">
                                                            <div class="img-container xl">
                                                                <img alt="<?php echo $label; ?>" src="<?php echo $thumbpath; ?>">
                                                            </div>
                                                            <div class="more-action">
                                                                <div class="more-icon">
                                                                    <i class="fa fa-link"></i>
                                                                </div>
                                                            </div>
                                                        </figure>
                                                        <?php
                                                    }
                                                } ?>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="text-overflow">
                                                    <h3 itemprop="name"><?php echo $article_title; ?></h3>
                                                    <?php echo $article_text; ?>
                                                    <div class="more-btn">
                                                        <span class="btn btn-primary"><?php echo $texts['READMORE']; ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </article>
                                <?php
                            }
                        } ?>
                    </div>
                    <?php
                }
            } ?>
        </div>
    </div>  
</section>

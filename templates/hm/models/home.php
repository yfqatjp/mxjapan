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
$stylesheets[] = array("file" => DOCBASE."js/plugins/live-search/jquery.liveSearch.css", "media" => "all");
$javascripts[] = DOCBASE."js/plugins/live-search/jquery.liveSearch.js";

require(getFromTemplate("common/header.php", false));

$slide_id = 0;
$result_slide_file = $db->prepare("SELECT * FROM pm_slide_file WHERE id_item = :slide_id AND checked = 1 AND lang = ".DEFAULT_LANG." AND type = 'image' AND file != '' ORDER BY rank LIMIT 1");
$result_slide_file->bindParam("slide_id", $slide_id);

$result_slide = $db->query("SELECT * FROM pm_slide WHERE id_page = ".$page_id." AND checked = 1 AND lang = ".LANG_ID." ORDER BY rank", PDO::FETCH_ASSOC);
if($result_slide !== false){
	$nb_slides = $db->last_row_count();
	if($nb_slides > 0){ ?>
        

	
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
                        
                        //$realpath = SYSBASE."medias/slide/big/".$file_id."/".$filename;
                        //$thumbpath = DOCBASE."medias/slide/small/".$file_id."/".$filename;
                        //$zoompath = DOCBASE."medias/slide/big/".$file_id."/".$filename;
                        $realpath = SYSBASE."hm/images/".$filename;
                        $thumbpath = DOCBASE."hm/images/".$filename;
                        $zoompath = DOCBASE."hm/images/".$filename;
                            
                        if(is_file($realpath)){ ?>
                        
                            <div class="rsContent">
                                <img class="rsImg" src="<?php echo $zoompath; ?>" alt="">
                                <?php
                                if($slide_legend != ""){ ?>
                                    <div class="infoBlock" data-fade-effect="" data-move-offset="10" data-move-effect="bottom" data-speed="200">
                                        <h2><?php echo $slide_legend; ?></h2>
                                        <p><a href="<?php echo $url_video; ?>" style="text-decoration:none" class="btn btn-primary btn-lg">了解更多</a></p>
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

	<div id="fh5co-services-section">
    <div class="container">
      <div class="row">
        <div class="col-md-6s col-md-offset-3 text-center fh5co-heading animate-box">
          <h2>日本旅行総合服務</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 animate-box yincang">
          <div class="services"><div class="midd"><img src="<?php echo DOCBASE."templates/".TEMPLATE;?>/images/1_03.jpg"></div>
            <div class="desc">
              <h3><a href="list_list.html">民宿 体験</a></h3>
              <p class="midd_1"><a href="list_list.html">世界的な広がりを見せる「個人宅宿泊」であり、「交流や生活文化体験」を求める観光客のための宿泊施設。</a></p>
            </div>
          </div>
        </div>
        <div class="col-md-4 animate-box yincang">
          <div class="services"><div class="midd"><img src="<?php echo DOCBASE."templates/".TEMPLATE;?>/images/1_04.jpg"></div>
            <div class="desc">
              <h3><a href="guide.html">租車 自驾</a></h3>
              <p class="midd_1"><a href="guide.html">家用車で近場から遠隔地まで自分たちのペースで動きやすく、公共の交通機関で行くのが難しい場所にも寄れる。</a></p>
            </div>
          </div>
        </div>
        <div class="col-md-4 animate-box yincang">
          <div class="services"><div class="midd"><img src="<?php echo DOCBASE."templates/".TEMPLATE;?>/images/1_05.jpg"></div>
            <div class="desc">
              <h3><a href="#">免税 购物</a></h3>
              <p class="midd_1"><a href="#">海外でのショッピングと言えば、免税店。日本でのお買い物をお楽しみに。認定店舗数400店！</a></p>
            </div>
          </div>
        </div>
        <div class="col-md-4 animate-box yincang">
          <div class="services"><div class="midd"><img src="<?php echo DOCBASE."templates/".TEMPLATE;?>/images/1_12.jpg"></div>
            <div class="desc">
              <h3><a href="medical.html">医疗 技术</a></h3>
              <p><a href="medical.html">世界的な広がりを見せる「個人宅宿泊」であり、「交流や生活文化体験」を求める観光客のための宿泊施設。</a></p>
            </div>
          </div>
        </div>
        <div class="col-md-4 animate-box yincang">
          <div class="services"><div class="midd"><img src="<?php echo DOCBASE."templates/".TEMPLATE;?>/images/1_14.jpg"></div>
            <div class="desc">
              <h3><a href="gallery.html">旅游 图库</a></h3>
              <p><a href="gallery.html">家用車で近場から遠隔地まで自分たちのペースで動きやすく、公共の交通機関で行くのが難しい場所にも寄れる。</a></p>
            </div>
          </div>
        </div>
        <div class="col-md-4 animate-box yincang">
          <div class="services"><div class="midd"><img src="<?php echo DOCBASE."templates/".TEMPLATE;?>/images/1_13.jpg"></div>
            <div class="desc">
              <h3><a href="realestate.html">不动产 服务</a></h3>
              <p><a href="realestate.html">海外でのショッピングと言えば、免税店。日本でのお買い物をお楽しみに。認定店舗数400店！</a></p>
            </div>
          </div>
        </div>
        <div class="sehun_1 yin">
          <li><a href="list_list.html"><img src="<?php echo DOCBASE."templates/".TEMPLATE;?>/images/user_4_09.png"><span>民宿 体験</span></a></li>
          <li><a href="guide.html"><img src="<?php echo DOCBASE."templates/".TEMPLATE;?>/images/user_4_06.png"><span>租車 自驾</span></a></li>
          <li><a href="#"><img src="<?php echo DOCBASE."templates/".TEMPLATE;?>/images/user_4_03.png"><span>免税 购物</span></a></li>
          <li><a href="medical.html"><img src="<?php echo DOCBASE."templates/".TEMPLATE;?>/images/user_4_15.png"><span>医疗 技术</span></a></li>
          <li><a href="gallery.html"><img src="<?php echo DOCBASE."templates/".TEMPLATE;?>/images/user_4_17.png"><span>旅游 图库</span></a></li>
          <li><a href="realestate.html"><img src="<?php echo DOCBASE."templates/".TEMPLATE;?>/images/user_4_20.png"><span>不动产 服务</span></a></li>
        </div>
      </div>
    </div>
  </div>

<div id="fh5co-work-section" class="fh5co-light-grey-section">
    <div class="container">
      <div class="row">
        <div class="col-md-6s col-md-offset-3 text-center mbottom80 animate-box">
          <h2>特色民宿 ＆ 星级酒店</h2>
        </div>
      </div>
      <form name=search_form onSubmit="return bottomForm(this);" method="post">
        <div class="midd_2">
          <div id="pt1" class="select">
            <a class="midd-sj-4" id="s0">请选择地区</a>
            <div id="pt2" class="part">
              <a id="s1" href="javascript:void(0);">全部</a>
              <a id="s2" href="javascript:void(0);">东京</a>
              <a id="s3" href="javascript:void(0);">大板</a>
              <a id="s4" href="javascript:void(0);">京都</a>
              <a id="s5" href="javascript:void(0);">神户</a>
              <a id="s6" href="javascript:void(0);">札幌</a>
              <a id="s7" href="javascript:void(0);">名古屋</a>
              <a id="s8" href="javascript:void(0);">福冈</a>
              <a id="s9" href="javascript:void(0);">横滨</a>
              <a id="s10" href="javascript:void(0);">神奈川县</a>
              <a id="s11" href="javascript:void(0);">奈良</a>
              <a id="s12" href="javascript:void(0);">那霸</a>
              <a id="s13" href="javascript:void(0);">名古屋</a>
              <a id="s14" href="javascript:void(0);">福冈</a>
              <a id="s15" href="javascript:void(0);">横滨</a>
              <a id="s16" href="javascript:void(0);">神奈川县</a>
              <a id="s17" href="javascript:void(0);">奈良</a>
              <a id="s18" href="javascript:void(0);">那霸</a>
              <a id="s19" href="javascript:void(0);">横滨</a>
              <a id="s20" href="javascript:void(0);">神奈川县</a>
              <a id="s21" href="javascript:void(0);">奈良</a>
              <a id="s22" href="javascript:void(0);">那霸</a>
            </div>
          </div>
          <div class="midd_66">
            <div class="rendezvous-input-date" id="start">入住日期</div>
            <div class="rendezvous-input-date" id="end">退房日期</div>
          </div>
          <!-- 选择日期 -->
          <script src="<?php echo getFromTemplate("js/jquery.min.js"); ?>"></script>
          <script type="text/javascript" src="<?php echo getFromTemplate("js/laydate.js"); ?>"></script>
          <script type="text/javascript">
!function(){
	laydate.skin('dahong');//切换皮肤，请查看skins下面皮肤库
	laydate({elem: '#demo'});//绑定元素
}();

//日期范围限制
var start = {
    elem: '#start',
    format: 'YYYY-MM-DD',
    min: laydate.now(), //设定最小日期为当前日期
    max: '2099-06-16', //最大日期
    istime: true,
    istoday: false,
    choose: function(datas){
         end.min = datas; //开始日选好后，重置结束日的最小日期
         end.start = datas //将结束日的初始值设定为开始日
    }
};

var end = {
    elem: '#end',
    format: 'YYYY-MM-DD',
    min: laydate.now(),
    max: '2099-06-16',
    istime: true,
    istoday: false,
    choose: function(datas){
        start.max = datas; //结束日选好后，充值开始日的最大日期
    }
};
laydate(start);
laydate(end);

//自定义日期格式
laydate({
    elem: '#test1',
    format: 'YYYY年MM月DD日',
    festival: true, //显示节日
    choose: function(datas){ //选择日期完毕的回调
        alert('得到：'+datas);
    }
});

//日期范围限定在昨天到明天
laydate({
    elem: '#hello3',
    min: laydate.now(-1), //-1代表昨天，-2代表前天，以此类推
    max: laydate.now(+1) //+1代表明天，+2代表后天，以此类推
});
</script>
          <input type="submit" name="button" class="input" value="搜索">
          <div class="clearfix"></div>
          <div class="clear"></div>
        </div>
      </form>
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
                    <div class="col-md-4 animate-box"> <a href="<?php echo $hotel_alias; ?>" class="item-grid text-center">

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
                                    <div class="image"><img alt="<?php echo $label; ?>" src="<?php echo $thumbpath; ?>"></div>
          <div class="v-align">
            <div class="v-align-middle">
              <h3 class="title"><?php echo $hotel_title; ?></h3>
              <h5 class="category"><?php echo $hotel_subtitle; ?></h5>
            </div>
          </div>

                                    <?php
                                }
                            } ?>
                        </a> </div>
                    <?php
                }
            } ?>
        <div class="col-md-12 text-center animate-box">
          <p><a href="list_list.html" class="btn btn-primary with-arrow">了解更多</a></p>
        </div>
      </div>
    </div>
  </div>
<div id="fh5co-testimony-section" style="background:#fcfcfc;">
    <div class="container">
      <div class="row">
        <div class="col-md-6s col-md-offset-3 text-center mbottom80 animate-box">
          <h2>包车畅游</h2>
        </div>
      </div>
      <div class="row mbottom70">
        <div class="midd_4 animate-box"> <a href="#" class="item-grid text-center">
          <div class="image"><img src="<?php echo DOCBASE."templates/".TEMPLATE;?>/images/5_11.png"></div>
          <div class="v-align">
            <div class="v-align-middle">
              <h3 class="title">东京专车私导服务</h3>
              <h5 class="category">东京 | <span>244人</span>预约</h5>
            </div>
          </div>
          </a> </div>
        <div class="midd_4 animate-box"> <a href="#" class="item-grid text-center">
          <div class="image"><img src="<?php echo DOCBASE."templates/".TEMPLATE;?>/images/5_11.png"></div>
          <div class="v-align">
            <div class="v-align-middle">
              <h3 class="title">东京专车私导服务</h3>
              <h5 class="category">东京 | <span>244人</span>预约</h5>
            </div>
          </div>
          </a> </div>
        <div class="midd_4 animate-box"> <a href="#" class="item-grid text-center">
          <div class="image"><img src="<?php echo DOCBASE."templates/".TEMPLATE;?>/images/5_11.png"></div>
          <div class="v-align">
            <div class="v-align-middle">
              <h3 class="title">东京专车私导服务</h3>
              <h5 class="category">东京 | <span>244人</span>预约</h5>
            </div>
          </div>
          </a> </div>
        <div class="midd_4 animate-box" style="margin-right:0;"> <a href="#" class="item-grid text-center">
          <div class="image"><img src="<?php echo DOCBASE."templates/".TEMPLATE;?>/images/5_11.png"></div>
          <div class="v-align">
            <div class="v-align-middle">
              <h3 class="title">东京专车私导服务</h3>
              <h5 class="category">东京 | <span>244人</span>预约</h5>
            </div>
          </div>
          </a> </div>
      <div class="clear"></div>
      </div>
      <div class="row">
        <div class="col-md-6s col-md-offset-3 text-center mbottom60 animate-box">
          <h2>机场接送</h2>
        </div>
      </div>
      <div class="row">
        <div class="midd_4 animate-box"> <a href="#" class="item-grid text-center">
          <div class="image"><img src="<?php echo DOCBASE."templates/".TEMPLATE;?>/images/5_11.png"></div>
          <div class="v-align">
            <div class="v-align-middle">
              <h3 class="title">成田机场 - 东京市内</h3>
              <h5 class="category">东京 | <span>244人</span>预约</h5>
            </div>
          </div>
          </a> </div>
        <div class="midd_4 animate-box"> <a href="#" class="item-grid text-center">
          <div class="image"><img src="<?php echo DOCBASE."templates/".TEMPLATE;?>/images/5_11.png"></div>
          <div class="v-align">
            <div class="v-align-middle">
              <h3 class="title">成田机场 - 东京市内</h3>
              <h5 class="category">东京 | <span>244人</span>预约</h5>
            </div>
          </div>
          </a> </div>
        <div class="midd_4 animate-box"> <a href="#" class="item-grid text-center">
          <div class="image"><img src="<?php echo DOCBASE."templates/".TEMPLATE;?>/images/5_11.png"></div>
          <div class="v-align">
            <div class="v-align-middle">
              <h3 class="title">成田机场 - 东京市内</h3>
              <h5 class="category">东京 | <span>244人</span>预约</h5>
            </div>
          </div>
          </a> </div>
        <div class="midd_4 animate-box" style="margin-right:0;"> <a href="#" class="item-grid text-center">
          <div class="image"><img src="<?php echo DOCBASE."templates/".TEMPLATE;?>/images/5_11.png"></div>
          <div class="v-align">
            <div class="v-align-middle">
              <h3 class="title">成田机场 - 东京市内</h3>
              <h5 class="category">东京 | <span>244人</span>预约</h5>
            </div>
          </div>
          </a> </div>
      </div>
    </div>
  </div>
<div class="midd_5">
    <div class="midd_6">加盟商家</div>
    <div class="midd_7">美溪車友倶楽部所加盟的商家都是日本最大，正规审核通过的免税商家，日本全国400多家商家加盟中</div>
  </div>
<div id="fh5co-blog-section" class="fh5co-light-grey-section">
    <div class="container">
      <div class="row">
        <div class="col-md-6s col-md-offset-3 text-center mbottom80 animate-box">
          <h2>旅游图库</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 col-sm-6 animate-box"> <a href="galleryxx.html" class="item-grid">
          <div class="image"><img src="<?php echo DOCBASE."templates/".TEMPLATE;?>/images/6_09.png"></div>
          <div class="v-align">
            <div class="v-align-middle">
              <h3 class="title">东京后花园轻井泽奢华</h3>
              <h5 class="date">发布日期2016-10-26 17:12</h5>
              <p>石之教堂又名内村鉴三纪念堂，是建造在宁静森林中的一座独一无二的建筑。将20世纪初的思想家内村鉴三的思想“只有在大自然中才是真正的祈祷的地方”作为基础，把“石、光、水、绿色、树木”——自然界的五大基本要素全部融入到设计中，体现了“天然的教堂”的设计理念。教堂有<span>[查看详情]</span></p>
            </div>
          </div>
          </a> </div>
        <div class="col-md-6 col-sm-6 animate-box"> <a href="galleryxx.html" class="item-grid">
          <div class="image"><img src="<?php echo DOCBASE."templates/".TEMPLATE;?>/images/6_09.png"></div>
          <div class="v-align">
            <div class="v-align-middle">
              <h3 class="title">冲绳亲子享受5日游</h3>
              <h5 class="date">发布日期2016-10-26 17:12</h5>
              <p>国际通又称为“奇迹的一哩”，全长达1.6公里。冲绳经历了第二次世界大战后，变成一座废墟。然而当地人以强烈的求生意志，在这块土地上建立了市集，并在极短的时间内恢复了元气。从此，这里就成为象征冲绳的主要大街，一直保持着当日的风貌，街道两旁林立着各大百货公<span>[查看详情]</span></p>
            </div>
          </div>
          </a> </div>
          <div class="col-md-6 col-sm-6 animate-box"> <a href="galleryxx.html" class="item-grid">
          <div class="image"><img src="<?php echo DOCBASE."templates/".TEMPLATE;?>/images/6_09.png"></div>
          <div class="v-align">
            <div class="v-align-middle">
              <h3 class="title">东京后花园轻井泽奢华</h3>
              <h5 class="date">发布日期2016-10-26 17:12</h5>
              <p>石之教堂又名内村鉴三纪念堂，是建造在宁静森林中的一座独一无二初的思想家内村鉴三的思想“只有在大自然中才是真正的祈祷的地方”作为基础，把“石、光、水、绿色、树木”——自然界的五大基本要素全部融入到设计中，体现了“天然的教堂”的设计理念。教堂的设计师是有<span>[查看详情]</span></p>
            </div>
          </div>
          </a> </div>
        <div class="col-md-6 col-sm-6 animate-box"> <a href="galleryxx.html" class="item-grid">
          <div class="image"><img src="<?php echo DOCBASE."templates/".TEMPLATE;?>/images/6_09.png"></div>
          <div class="v-align">
            <div class="v-align-middle">
              <h3 class="title">冲绳亲子享受5日游</h3>
              <h5 class="date">发布日期2016-10-26 17:12</h5>
              <p>国际通又称为“奇迹的一哩”，全长达1.6公里。冲绳经历了第二次世界大战后，变成一座废墟。然而当地人以强烈的求生意志，在这块土地上建立了市集，并在极短的时间内恢复了元气。从此，这里就成为象征冲绳的主要大街，一直保持着当日的风貌，街道两旁林立着各大百货公<span>[查看详情]</span></p>
            </div>
          </div>
          </a> </div>
        <div class="col-md-12 text-center animate-box">
          <p><a href="gallery.html" class="btn btn-primary with-arrow">了解更多</a></p>
        </div>
      </div>
    </div>
  </div>
<div id="fh5co-pricing-section">
    <div class="container">
      <div class="row">
        <div class="col-md-6s col-md-offset-3 text-center mbottom90 animate-box">
          <h2>数据统计</h2>
          <p style="font-size:14px; margin-top:25px;">世界的な広がりを見せる「個人宅宿泊」であり、「交流や生活文化体験」を求める観光客のための宿泊施設。<br>“走过走廊时木质的地板嘎吱作响” 这是旅客们对Toco这家老式民宿唯一印象。<br>隐藏于高楼林立的东京市区的古老民宿Toco，虽然有着老式的日本庭院以及怀旧的木质家具，但是这家青年旅馆绝对只老不旧。</p>
        </div>
      </div>
      <div class="row">
        <div class="pricing">
          <div class="col-md-3 animate-box">
            <div class="price-box midd_8">
              <h2 class="pricing-plan">民宿房间数</h2>
              <div class="price">750<sup class="currency">+</sup></div>
              <p class="midd_9">石之教堂又名内村鉴三纪念堂，是建造在宁静森林中的一座独一无二这里文字自己填入，暂时用别的文字顶替一下</p>
              <a href="list_list.html" class="btn btn-select-plan btn-sm">了解民宿</a> </div>
          </div>
          <div class="col-md-3 animate-box">
            <div class="price-box midd_8">
              <h2 class="pricing-plan">各地租车数</h2>
              <div class="price">11000<sup class="currency">+</sup></div>
              <p class="midd_9">石之教堂又名内村鉴三纪念堂，是建造在宁静森林中的一座独一无二这里文字自己填入，暂时用别的文字顶替一下</p>
              <a href="guide.html" class="btn btn-select-plan btn-sm">车导服务</a> </div>
          </div>
          <div class="col-md-3 animate-box">
            <div class="price-box popular midd_8">
              <h2 class="pricing-plan">免税商家数</h2>
              <div class="price">5000<sup class="currency">+</sup></div>
              <p class="midd_9">石之教堂又名内村鉴三纪念堂，是建造在宁静森林中的一座独一无二这里文字自己填入，暂时用别的文字顶替一下</p>
              <a href="realestate.html" class="btn btn-select-plan btn-sm">不动产服务</a> </div>
          </div>
          <div class="col-md-3 animate-box">
            <div class="price-box midd_8">
              <h2 class="pricing-plan">每日情报数</h2>
              <div class="price">300<sup class="currency">+</sup></div>
              <p class="midd_9">石之教堂又名内村鉴三纪念堂，是建造在宁静森林中的一座独一无二这里文字自己填入，暂时用别的文字顶替一下</p>
              <a href="about.html" class="btn btn-select-plan btn-sm">了解我们</a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>


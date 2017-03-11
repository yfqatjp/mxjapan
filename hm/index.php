<?php require_once 'coon.php';
$navid = 1;
$_SESSION['formcode'] = rfc_encode(mt_rand(0, 1000000));
$rs = $pdo->query("SELECT * FROM `pm_page` WHERE `lang` = '2' AND id = " . $navid);
$row = $rs->fetch();

$rs2 = $pdo->query("SELECT * FROM pm_article_file WHERE checked = 1 AND lang = 2 AND type = 'image' AND file != '' ORDER BY rank LIMIT 1");
$row2 = $rs2->fetch();

//
require_once $_SERVER['DOCUMENT_ROOT'] . '/common/HmWeb.php';
// 首页显示的包车
$arrHomeCharters = $hmWeb->findHomeCharterList();
?><!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<head>
    <?php require_once 'top.php'; ?>
</head>
<body>
<div class="sehun"></div>

<?php require_once 'head.php'; ?>

<aside id="fh5co-hero" class="js-fullheight yincang">
    <div class="flexslider js-fullheight">
        <ul class="slides">
            <?php
            $rs = $pdo->query("SELECT * FROM pm_slide WHERE lang = 2");
            $i = 1;
            while ($row = $rs->fetch()) {
                ?>
                <li><img src="<?php
                    $rs1 = $pdo->query("SELECT * FROM pm_slide_file WHERE id_item = " . $row['id'] . " ORDER BY id ASC");
                    $row1 = $rs1->fetch();
                    if (is_file($_SERVER['DOCUMENT_ROOT'] . "/images/" . $row1['file'])) {
                        echo "/images/" . $row1['file'];
                    } else {
                        echo "/medias/slide/big/" . $row1['id'] . "/" . $row1['file'];
                    } ?>">
                    <div<?php if ($i == 1) { ?> class="midd_77"<?php } ?>>
                        <div class="container">
                            <div class="col-md-10 col-md-offset-1 text-center js-fullheight slider-text">
                                <div class="slider-text-inner">
                                    <h2><?php echo $row['legend'] ?></h2>
                                    <p><a href="<?php echo $row['more'] ?>" class="btn btn-primary btn-lg">了解更多</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <?php $i++;
            } ?>
        </ul>
    </div>
</aside>

<aside id="fh5co-hero" class="js-fullheight yin">
    <div class="flexslider js-fullheight">
        <ul class="slides">
            <?php
            $rs = $pdo->query("SELECT * FROM pm_slide WHERE lang = 2");
            $i = 1;
            while ($row = $rs->fetch()) {
                ?>
                <li><img src="<?php
                    $rs1 = $pdo->query("SELECT * FROM pm_slide_file WHERE id_item = " . $row['id'] . " ORDER BY id DESC");
                    $row1 = $rs1->fetch();
                    if (is_file($_SERVER['DOCUMENT_ROOT'] . "/images/" . $row1['file'])) {
                        echo "/images/" . $row1['file'];
                    } else {
                        echo "/medias/slide/big/" . $row1['id'] . "/" . $row1['file'];
                    } ?>">
                    <div class="overlay-gradient"></div>
                    <div<?php if ($i == 1) { ?> class="midd_77"<?php } ?>>
                        <div class="container">
                            <div class="col-md-10 col-md-offset-1 text-center js-fullheight slider-text">
                                <div class="slider-text-inner">
                                    <h2><?php echo $row['legend'] ?></h2>
                                    <p><a href="<?php echo $row['more'] ?>" class="btn btn-primary btn-lg">了解更多</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <?php $i++;
            } ?>
        </ul>
    </div>
</aside>


<div id="fh5co-services-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6s col-md-offset-3 text-center fh5co-heading animate-box">
                <h2 style="padding-top: 15px;">日本旅行総合服務</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 animate-box yincang">
                <div class="services">
                    <div class="midd"><img src="images/1_03.jpg"></div>
                    <div class="desc">
                        <h3><a href="list2.html">民宿 体験</a></h3>
                        <p class="midd_1"><a href="list2.html">世界的な広がりを見せる「個人宅宿泊」であり、「交流や生活文化体験」を求める観光客のための宿泊施設。</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 animate-box yincang">
                <div class="services">
                    <div class="midd"><img src="images/1_04.jpg"></div>
                    <div class="desc">
                        <h3><a href="guide.html">租車 自驾</a></h3>
                        <p class="midd_1"><a href="guide.html">家用車で近場から遠隔地まで自分たちのペースで動きやすく、公共の交通機関で行くのが難しい場所にも寄れる。</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 animate-box yincang">
                <div class="services">
                    <div class="midd"><img src="images/1_05.jpg"></div>
                    <div class="desc">
                        <h3><a href="#">免税 购物</a></h3>
                        <p class="midd_1"><a href="#">海外でのショッピングと言えば、免税店。日本でのお買い物をお楽しみに。認定店舗数400店！</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 animate-box yincang">
                <div class="services">
                    <div class="midd"><img src="images/1_12.jpg"></div>
                    <div class="desc">
                        <h3><a href="medical.html">医疗 技术</a></h3>
                        <p><a href="medical.html">世界的な広がりを見せる「個人宅宿泊」であり、「交流や生活文化体験」を求める観光客のための宿泊施設。</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 animate-box yincang">
                <div class="services">
                    <div class="midd"><img src="images/1_14.jpg"></div>
                    <div class="desc">
                        <h3><a href="gallery.html">旅游 图库</a></h3>
                        <p><a href="gallery.html">家用車で近場から遠隔地まで自分たちのペースで動きやすく、公共の交通機関で行くのが難しい場所にも寄れる。</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 animate-box yincang">
                <div class="services">
                    <div class="midd"><img src="images/1_13.jpg"></div>
                    <div class="desc">
                        <h3><a href="realestate.html">不动产 服务</a></h3>
                        <p><a href="realestate.html">海外でのショッピングと言えば、免税店。日本でのお買い物をお楽しみに。認定店舗数400店！</a></p>
                    </div>
                </div>
            </div>
            <div class="sehun_1 yin">
                <li><a href="list2.html"><img src="images/user_4_09.png"><span>民宿 体験</span></a></li>
                <li><a href="guide.html"><img src="images/user_4_06.png"><span>租車 自驾</span></a></li>
                <li><a href="#"><img src="images/user_4_03.png"><span>免税 购物</span></a></li>
                <li><a href="medical.html"><img src="images/user_4_15.png"><span>医疗 技术</span></a></li>
                <li><a href="gallery.html"><img src="images/user_4_17.png"><span>旅游 图库</span></a></li>
                <li><a href="realestate.html"><img src="images/user_4_20.png"><span>不动产 服务</span></a></li>
            </div>
        </div>
    </div>
</div>

<div id="fh5co-work-section" class="fh5co-light-grey-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6s col-md-offset-3 text-center mbottom80 animate-box">
                <h2 style="padding-top: 15px;">特色民宿 ＆ 星级酒店</h2>
            </div>
        </div>
        <!-- 
        <form name="search_form" method="post" action="do?ss=list">
            <input type="hidden" name="formcode" value="<?php echo $_SESSION['formcode'] ?>">
            <div class="midd_2">
                <div id="pt1" class="select">
                    <a class="midd-sj-4" id="s0">请选择地区</a>
                    <div id="pt2" class="part">
                        <a id="s1" href="javascript:void(0);">全部</a>
                        <?php
                        $i = 2;
                        $rs = $pdo->query("SELECT * FROM pm_destination WHERE `checked` = 1");
                        while ($row = $rs->fetch()) {
                            ?>
                            <a id="s<?php echo $i ?>" href="javascript:void(0);"><?php echo $row['name'] ?></a>
                            <?php $i++;
                        } ?>
                    </div>
                </div>
                <input name="lid" class="lid" type="hidden" value="1">
                <div class="midd_66">
                    <input name="ont" class="rendezvous-input-date" id="start" readonly
                           value="<?php if (@$_GET['ont'] == "") { ?>入住日期<?php } else {
                               echo @$_GET['ont'];
                           } ?>">
                    <input name="offt" class="rendezvous-input-date" id="end" readonly
                           value="<?php if (@$_GET['offt'] == "") { ?>退房日期<?php } else {
                               echo @$_GET['ont'];
                           } ?>">
                </div> -->
                <!-- 选择日期 --><!--
                <script src="js/jquery.min.js"></script>
                <script type="text/javascript" src="js/laydate.js"></script>
                <script type="text/javascript">
                    !function () {
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
                        choose: function (datas) {
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
                        choose: function (datas) {
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
                        choose: function (datas) { //选择日期完毕的回调
                            alert('得到：' + datas);
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
        </form>-->
        <div class="row">
            <?php
            $rs = $pdo->query("SELECT * FROM pm_hotel WHERE lang = 2 AND checked = 1 AND home = 1 ORDER BY id DESC LIMIT 0,6");
            while ($row = $rs->fetch()) {
                ?>
                <div class="col-md-4 animate-box"><a href="list_x<?php echo $row['id'] ?>.html"
                                                     class="item-grid text-center">
                        <div class="image" style="height: 240px;overflow: hidden;"><img
                                src="<?php $rs1 = $pdo->query("SELECT * FROM pm_hotel_file WHERE id_item = " . $row['id']);
                                $row1 = $rs1->fetch();
                                echo "/medias/hotel/medium/" . $row1['id'] . "/" . $row1['file'] ?>"
                                style="height:240px;"></div>
                        <div class="v-align">
                            <div class="v-align-middle">
                                <h3 class="title"><?php echo $row['title'] ?></h3>
                                <h5 class="category"><?php echo $row['subtitle'] ?></h5>
                            </div>
                        </div>
                    </a></div>
            <?php } ?>
            <div class="clear"></div>
            <div class="col-md-12 text-center animate-box">
                <p><a href="list2.html" class="btn btn-primary">了解更多</a></p>
            </div>
        </div>
    </div>
</div>

<?php 
if (count($arrHomeCharters) > 0) {
?>
<div id="fh5co-testimony-section" style="background:#fcfcfc;">
    <div class="container">
    	<?php 
    	foreach($arrHomeCharters as $arrCharterType) {
    	?>
        <div class="row">
            <div class="col-md-6s col-md-offset-3 text-center mbottom80 animate-box">
                <h2><?php echo $arrCharterType["name"];?></h2>
            </div>
        </div>
        <div class="row mbottom70">
        	<?php 
        	$charterIndex = 0;
        	foreach($arrCharterType["data"] as $arrCharter) {
        		$charterIndex++;
        	?>
            <div class="midd_4 animate-box" <?php if ($charterIndex%4 == 0) {echo 'style="margin-right:0;"';} ?>>
            	<a href="guidexx.html?id=<?php echo $arrCharter["id"];?>" class="item-grid text-center">
                    <div class="image" style="height: 240px;overflow: hidden;">
                    	<?php 
                    	if (!empty($arrCharter["image_url"])) {
                    	?>
                    	<img src="<?php echo $arrCharter["image_url"];?>" style="height:240px;">
                    	<?php 
                    	} else {
                    	?>
                    	<img src="images/5_11.png">
                    	<?php
						 } 
						 ?>
                    </div>
                    <div class="v-align">
                        <div class="v-align-middle">
                            <h3 class="title" style="overflow:hidden;white-space:nowrap;text-overflow:ellipsis;"><?php echo $arrCharter["title"];?></h3>
                            <h5 class="category"><?php echo $arrCharter["city_name"];?> | <span><?php echo $arrCharter["book_count"];?>人</span>预约</h5>
                        </div>
                    </div>
                </a>
            </div>
            <?php 
            	if ($charterIndex%4 == 0) {
            ?>
            	<div class="clear"></div>
            </div>
            <div class="row" >
             <?php 
				}
			}
			?>
        </div>
		<?php 
		}
		?>
    </div>
</div>
<?php 
}
?>

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
            <div class="col-md-6 col-sm-6 animate-box"><a href="galleryxx.html" class="item-grid">
                    <div class="image"><img src="images/6_09.png"></div>
                    <div class="v-align">
                        <div class="v-align-middle">
                            <h3 class="title">东京后花园轻井泽奢华</h3>
                            <h5 class="date">发布日期2016-10-26 17:12</h5>
                            <p>
                                石之教堂又名内村鉴三纪念堂，是建造在宁静森林中的一座独一无二的建筑。将20世纪初的思想家内村鉴三的思想“只有在大自然中才是真正的祈祷的地方”作为基础，把“石、光、水、绿色、树木”——自然界的五大基本要素全部融入到设计中，体现了“天然的教堂”的设计理念。教堂的设计师是有<span>[查看详情]</span>
                            </p>
                        </div>
                    </div>
                </a></div>
            <div class="col-md-6 col-sm-6 animate-box"><a href="galleryxx.html" class="item-grid">
                    <div class="image"><img src="images/6_09.png"></div>
                    <div class="v-align">
                        <div class="v-align-middle">
                            <h3 class="title">冲绳亲子享受5日游</h3>
                            <h5 class="date">发布日期2016-10-26 17:12</h5>
                            <p>
                                国际通又称为“奇迹的一哩”，全长达1.6公里。冲绳经历了第二次世界大战后，变成一座废墟。然而当地人以强烈的求生意志，在这块土地上建立了市集，并在极短的时间内恢复了元气。从此，这里就成为象征冲绳的主要大街，一直保持着当日的风貌，街道两旁林立着各大百货公<span>[查看详情]</span>
                            </p>
                        </div>
                    </div>
                </a></div>
            <div class="col-md-6 col-sm-6 animate-box"><a href="galleryxx.html" class="item-grid">
                    <div class="image"><img src="images/6_09.png"></div>
                    <div class="v-align">
                        <div class="v-align-middle">
                            <h3 class="title">东京后花园轻井泽奢华</h3>
                            <h5 class="date">发布日期2016-10-26 17:12</h5>
                            <p>
                                石之教堂又名内村鉴三纪念堂，是建造在宁静森林中的一座独一无二的建筑。将20世纪初的思想家内村鉴三的思想“只有在大自然中才是真正的祈祷的地方”作为基础，把“石、光、水、绿色、树木”——自然界的五大基本要素全部融入到设计中，体现了“天然的教堂”的设计理念。教堂的设计师是有<span>[查看详情]</span>
                            </p>
                        </div>
                    </div>
                </a></div>
            <div class="col-md-6 col-sm-6 animate-box"><a href="galleryxx.html" class="item-grid">
                    <div class="image"><img src="images/6_09.png"></div>
                    <div class="v-align">
                        <div class="v-align-middle">
                            <h3 class="title">冲绳亲子享受5日游</h3>
                            <h5 class="date">发布日期2016-10-26 17:12</h5>
                            <p>
                                国际通又称为“奇迹的一哩”，全长达1.6公里。冲绳经历了第二次世界大战后，变成一座废墟。然而当地人以强烈的求生意志，在这块土地上建立了市集，并在极短的时间内恢复了元气。从此，这里就成为象征冲绳的主要大街，一直保持着当日的风貌，街道两旁林立着各大百货公<span>[查看详情]</span>
                            </p>
                        </div>
                    </div>
                </a></div>
            <div class="col-md-12 text-center animate-box">
                <p><a href="gallery.html" class="btn btn-primary">了解更多</a></p>
            </div>
        </div>
    </div>
</div>
<!-- 
<div id="fh5co-pricing-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6s col-md-offset-3 text-center mbottom90 animate-box">
                <h2>数据统计</h2>
                <p style="font-size:14px; margin-top:25px;">世界的な広がりを見せる「個人宅宿泊」であり、「交流や生活文化体験」を求める観光客のための宿泊施設。<br>“走过走廊时木质的地板嘎吱作响”
                    这是旅客们对Toco这家老式民宿唯一印象。<br>隐藏于高楼林立的东京市区的古老民宿Toco，虽然有着老式的日本庭院以及怀旧的木质家具，但是这家青年旅馆绝对只老不旧。</p>
            </div>
        </div>
        <div class="row">
            <div class="pricing">
                <div class="col-md-3 animate-box">
                    <div class="price-box midd_8">
                        <h2 class="pricing-plan">民宿房间数</h2>
                        <div class="price">750<sup class="currency">+</sup></div>
                        <p class="midd_9">石之教堂又名内村鉴三纪念堂，是建造在宁静森林中的一座独一无二这里文字自己填入，暂时用别的文字顶替一下</p>
                        <a href="list2.html" class="btn btn-select-plan btn-sm">了解民宿</a></div>
                </div>
                <div class="col-md-3 animate-box">
                    <div class="price-box midd_8">
                        <h2 class="pricing-plan">各地租车数</h2>
                        <div class="price">11000<sup class="currency">+</sup></div>
                        <p class="midd_9">石之教堂又名内村鉴三纪念堂，是建造在宁静森林中的一座独一无二这里文字自己填入，暂时用别的文字顶替一下</p>
                        <a href="guide.html" class="btn btn-select-plan btn-sm">车导服务</a></div>
                </div>
                <div class="col-md-3 animate-box">
                    <div class="price-box popular midd_8">
                        <h2 class="pricing-plan">免税商家数</h2>
                        <div class="price">5000<sup class="currency">+</sup></div>
                        <p class="midd_9">石之教堂又名内村鉴三纪念堂，是建造在宁静森林中的一座独一无二这里文字自己填入，暂时用别的文字顶替一下</p>
                        <a href="realestate.html" class="btn btn-select-plan btn-sm">不动产服务</a></div>
                </div>
                <div class="col-md-3 animate-box">
                    <div class="price-box midd_8">
                        <h2 class="pricing-plan">每日情报数</h2>
                        <div class="price">300<sup class="currency">+</sup></div>
                        <p class="midd_9">石之教堂又名内村鉴三纪念堂，是建造在宁静森林中的一座独一无二这里文字自己填入，暂时用别的文字顶替一下</p>
                        <a href="about.html" class="btn btn-select-plan btn-sm">了解我们</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
 -->
<?php require_once 'foot.php'; ?>
<!-- jQuery -->

<!-- jQuery Easing -->
<script src="js/jquery.easing.1.3.js"></script>
<!-- Bootstrap -->
<script src="js/bootstrap.min.js"></script>
<!-- Waypoints -->
<script src="js/jquery.waypoints.min.js"></script>
<!-- Owl Carousel -->
<script src="js/owl.carousel.min.js"></script>
<!-- Flexslider -->
<script src="js/jquery.flexslider-min.js"></script>

<!-- MAIN JS -->
<script src="js/main.js"></script>

<!-- 导航 -->
<script>
    $(function () {
        $(".sehun").click(function () {
            $(".navshow").slideToggle();
        });
    });
    // search
    //获得Cookie解码后的值
    function GetCookieVal(offset) {
        var endstr = document.cookie.indexOf(";", offset);
        if (endstr == -1) endstr = document.cookie.length;
        return unescape(document.cookie.substring(offset, endstr));
    }
    //设定Cookie值-将值保存在Cookie中
    function SetCookie(name, value) {
        var expdate = new Date(); //获取当前日期
        var argv = SetCookie.arguments; //获取cookie的参数
        var argc = SetCookie.arguments.length; //cookie的长度
        var expires = (argc > 2) ? argv[2] : null; //cookie有效期
        var path = (argc > 3) ? argv[3] : null; //cookie路径
        var domain = (argc > 4) ? argv[4] : null; //cookie所在的应用程序域
        var secure = (argc > 5) ? argv[5] : false; //cookie的加密安全设置
        if (expires != null) expdate.setTime(expdate.getTime() + (expires * 1000));
        document.cookie = name + "=" + escape(value) + ((expires == null) ? "" : ("; expires=" + expdate.toGMTString())) + ((path == null) ? "" : ("; path=" + path)) + ((domain == null) ? "" : ("; domain=" + domain)) + ((secure == true) ? "; secure" : "");
    }
    //删除指定的Cookie
    function DelCookie(name) {
        var exp = new Date();
        exp.setTime(exp.getTime() - 1);
        var cval = GetCookie(name); //获取当前cookie的值
        document.cookie = name + "=" + cval + "; expires=" + exp.toGMTString(); //将日期设置为过期时间
    }
    //获得Cookie的值-name用来搜索Cookie的名字
    function GetCookie(name) {
        var arg = name + "=";
        var argLen = arg.length; //指定Cookie名的长度
        var cookieLen = document.cookie.length; //获取cookie的长度
        var i = 0;
        while (i < cookieLen) {
            var j = i + argLen;
            if (document.cookie.substring(i, j) == arg) //依次查找对应cookie名的值
                return GetCookieVal(j);
            i = document.cookie.indexOf(" ", i) + 1;
            if (i == 0) break;
        }
        return null;
    }

    function $$(id) {
        if (document.getElementById) {
            return document.getElementById(id);
        } else if (document.layers) {
            return document.layers[id];
        } else {
            return false;
        }
    }
    (function () {
        function initHead() {
            setTimeout(showSubSearch, 0)
        };
        function showSubSearch() {
            $$("s0").onclick = function () {
                $$("pt2").style.display = "block";
                $$("pt1").className = "select"
            };
            $$("pt2").onclick = function () {
                $$("pt2").style.display = "none";
                $$("pt1").className = "select select_hover"
            };
            $$("s1").onclick = function () {
                selSubSearch(1);
            }
            <?php
            $i = 2;
            $rs = $pdo->query("SELECT * FROM pm_destination WHERE `checked` = 1");
            while ($row = $rs->fetch()) {
            ?>
            $$("s<?php echo $i?>").onclick = function () {
                selSubSearch(<?php echo $i?>);
            };
            <?php $i++;}?>
        };

        function selSubSearch(iType) {
            hbb = [];
            hbb = {
                1: ["全部", "1"],

            <?php
            $i = 2;
            $rs = $pdo->query("SELECT * FROM pm_destination WHERE `checked` = 1");
            while ($row = $rs->fetch()) {
            ?>
            <?php echo $i?> :
            ["<?php echo $row['name']?>", "<?php echo $i?>"],

            <?php $i++;}?>
        }
            ;
            $$("s0").innerHTML = hbb[iType][0];
            $$("pt2").style.display = "none";
            SetCookie('sousuosss', iType);
        };
        initHead();
    })();

    hbb = [];
    hbb = {
        1: ["全部", "1"],
    <?php
    $i = 2;
    $rs = $pdo->query("SELECT * FROM pm_destination WHERE `checked` = 1");
    while ($row = $rs->fetch()) {
    ?>
    <?php echo $i?> :
    ["<?php echo $row['name']?>", "<?php echo $i?>"],

    <?php $i++;}?>
    }
    ;
</script>
</body>
</html>

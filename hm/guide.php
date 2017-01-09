<?
?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>美溪民宿</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Free HTML5 Website Template by FreeHTML5.co" />
<meta name="keywords" content="free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />

<!-- Facebook and Twitter integration -->
<meta property="og:title" content=""/>
<meta property="og:image" content=""/>
<meta property="og:url" content=""/>
<meta property="og:site_name" content=""/>
<meta property="og:description" content=""/>
<meta name="twitter:title" content="" />
<meta name="twitter:image" content="" />
<meta name="twitter:url" content="" />
<meta name="twitter:card" content="" />

<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
<link rel="shortcut icon" href="favicon.ico">
<link href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,700" rel="stylesheet">

<!-- Animate.css -->
<link rel="stylesheet" href="css/animate.css">
<!-- Icomoon Icon Fonts-->
<link rel="stylesheet" href="css/icomoon.css">
<!-- Bootstrap  -->
<link rel="stylesheet" href="css/bootstrap.css">
<!-- Flexslider  -->
<link rel="stylesheet" href="css/flexslider.css">
<!-- Owl Carousel  -->
<link rel="stylesheet" href="css/owl.carousel.min.css">
<link rel="stylesheet" href="css/owl.theme.default.min.css">
<!-- Theme style  -->
<link rel="stylesheet" href="css/style.css">

<!-- Modernizr JS -->
<script src="js/modernizr-2.6.2.min.js"></script>
<!-- FOR IE9 below -->
<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->
<script src="js/jquery.min.js"></script>
<style>
body{ background:#f7f7f7;}
</style>
</head>
<body>
<div class="sehun"></div>
<header id="fh5co-header" role="banner">
    <div class="container">
        <div class="header-inner">
            <div class="logo"><a href="index.html"><img src="images/logo.png"></a></div>
            <nav role="navigation" class="navshow">
                <ul>
                    <?php
                    $rs = $pdo->query("SELECT * FROM `pm_page` WHERE `lang` = '2' AND `main` = 1 AND `id_parent` IS NULL ORDER BY rank");
                    while ($row = $rs->fetch()) {
                        ?>
                        <li<?php if ($navid == $row['id']) { ?> class="navs"<?php } ?>><a
                                href="<?php echo $row['url'] ?>"><?php echo $row['name'] ?></a></li>
                    <?php } ?>
                    <li class="cta"><a href="signin.html">登录</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>
<div class="container"> </div>
<aside id="fh5co-hero" class="js-fullheight">
  <div class="flexslider js-fullheight">
    <ul class="slides">
      <li style="background: url(images/guide.jpg) no-repeat; background-position:center center;">
        <div class="overlay-gradient"></div>
        <div class="container">
          <div class="col-md-10 col-md-offset-1 text-center js-fullheight slider-text">
            <div class="slider-text-inner midd_230ss">
              <h2>美溪车友平台</h2>
              <p><span>租车随时随地，自驾自由自在</span></p>
            </div>
          </div>
        </div>
      </li>
    </ul>
  </div>
</aside>

<!-- 内容 -->
<div class="midd_auto midd_fff midd_top20">
  <div class="midd_78" id="midd_78">
    <span>地区：</span>
    <ul>
      <li class="active">全部</li>
      <li>东京</li>
      <li>大板</li>
      <li>京都</li>
      <li>神户</li>
      <li>札幌</li>
      <li>名古屋</li>
      <li>福冈</li>
      <li>横滨</li>
      <li>神奈川县</li>
      <li>奈良</li>
      <li>那霸</li>
      <li>金泽</li>
      <li>长野县</li>
      <li>神奈川县</li>
      <li>奈良</li>
      <li>那霸</li>
      <li>金泽</li>
      <li>长野县</li>
      <li>冲绳</li>
    </ul>
  <div class="clear"></div>
  </div>
  <div class="midd_78" id="midd_79">
    <span>类型 ：</span>
    <ul>
      <li class="active">全部</li>
      <li>包车畅游</li>
      <li>机场接送</li>
    </ul>
  <div class="clear"></div>
  </div>
  <div class="midd_79">
    <div class="left"> <a href="javascript:void(0);"><span>人气</span><img src="images/9_08.png"></a> <a href="javascript:void(0);">价格<img src="images/9_10.png"></a> <a href="javascript:void(0);">销量<img src="images/9_10.png"></a> </div>
    <div class="right"> <a href="guide.html"><img src="images/10_03.png"><br>
      <span>列表</span></a> <a href="guide_grid.html"><img src="images/7_07.png"><br>
      网格</a> </div>
    <div class="clear"></div>
  </div>
<script type="text/javascript">
jQuery(function(){
	var list = jQuery('#midd_78 ul li');
	list.click(function(){
		list.removeClass('active');
		jQuery(this).addClass('active');
	});
});
</script>
<script type="text/javascript">
jQuery(function(){
	var list = jQuery('#midd_79 ul li');
	list.click(function(){
		list.removeClass('active');
		jQuery(this).addClass('active');
	});
});
</script>
<div class="clear"></div>
</div>

<div class="midd_auto midd_fff midd_top20 midd_80">
  <div class="midd_81"><a href="guidexx.html"><img src="images/guide_1_03.jpg"></a></div>
  <div class="midd_82">
    <div class="midd_83"><a href="guidexx.html">
      <h2>东京转车私导服务</h2>
      <div class="right">
        东京 | <span>244</span>人预约
      </div>
    <div class="clear"></div>
    </a></div>
    <div class="midd_83">
      <div class="left"><span><h4>￥</h4><h1>1560</h1></span> / 车</div>
      <div class="right">
        <img src="images/guide_1_06.jpg">123456/人点赞
      </div>
    <div class="clear"></div>
    </div>
    <ul>
      <li>舒适5座</li>
      <li>舒适5座</li>
      <li>舒适5座</li>
      <li>舒适5座</li>
      <li>舒适5座</li>
    <div class="clear"></div>
    </ul>
    <div class="midd_84">东京安缦是东京这座传统与现代化首都一座具有里程碑意义的酒店，既散发都市活力气息，又不乏宁静。酒店坐落在大手町金融区，可轻松往返东京车站与热闹繁华的日本桥区。</div>
  </div>
<div class="clear"></div>
</div>

<div class="midd_auto midd_fff midd_top20 midd_80">
  <div class="midd_81"><a href="guidexx.html"><img src="images/guide_1_03.jpg"></a></div>
  <div class="midd_82">
    <div class="midd_83"><a href="guidexx.html">
      <h2>东京转车私导服务</h2>
      <div class="right">
        东京 | <span>244</span>人预约
      </div>
    <div class="clear"></div>
    </a></div>
    <div class="midd_83">
      <div class="left"><span><h4>￥</h4><h1>1560</h1></span> / 车</div>
      <div class="right">
        <img src="images/guide_1_06.jpg">123456/人点赞
      </div>
    <div class="clear"></div>
    </div>
    <ul>
      <li>舒适5座</li>
      <li>舒适5座</li>
      <li>舒适5座</li>
      <li>舒适5座</li>
      <li>舒适5座</li>
    <div class="clear"></div>
    </ul>
    <div class="midd_84">东京安缦是东京这座传统与现代化首都一座具有里程碑意义的酒店，既散发都市活力气息，又不乏宁静。酒店坐落在大手町金融区，可轻松往返东京车站与热闹繁华的日本桥区。</div>
  </div>
<div class="clear"></div>
</div>

<div class="midd_auto midd_fff midd_top20 midd_80">
  <div class="midd_81"><a href="guidexx.html"><img src="images/guide_1_03.jpg"></a></div>
  <div class="midd_82">
    <div class="midd_83"><a href="guidexx.html">
      <h2>东京转车私导服务</h2>
      <div class="right">
        东京 | <span>244</span>人预约
      </div>
    <div class="clear"></div>
    </a></div>
    <div class="midd_83">
      <div class="left"><span><h4>￥</h4><h1>1560</h1></span> / 车</div>
      <div class="right">
        <img src="images/guide_1_06.jpg">123456/人点赞
      </div>
    <div class="clear"></div>
    </div>
    <ul>
      <li>舒适5座</li>
      <li>舒适5座</li>
      <li>舒适5座</li>
      <li>舒适5座</li>
      <li>舒适5座</li>
    <div class="clear"></div>
    </ul>
    <div class="midd_84">东京安缦是东京这座传统与现代化首都一座具有里程碑意义的酒店，既散发都市活力气息，又不乏宁静。酒店坐落在大手町金融区，可轻松往返东京车站与热闹繁华的日本桥区。</div>
  </div>
<div class="clear"></div>
</div>

<div class="midd_auto midd_fff midd_top20 midd_80">
  <div class="midd_81"><a href="guidexx.html"><img src="images/guide_1_03.jpg"></a></div>
  <div class="midd_82">
    <div class="midd_83"><a href="guidexx.html">
      <h2>东京转车私导服务</h2>
      <div class="right">
        东京 | <span>244</span>人预约
      </div>
    <div class="clear"></div>
    </a></div>
    <div class="midd_83">
      <div class="left"><span><h4>￥</h4><h1>1560</h1></span> / 车</div>
      <div class="right">
        <img src="images/guide_1_06.jpg">123456/人点赞
      </div>
    <div class="clear"></div>
    </div>
    <ul>
      <li>舒适5座</li>
      <li>舒适5座</li>
      <li>舒适5座</li>
      <li>舒适5座</li>
      <li>舒适5座</li>
    <div class="clear"></div>
    </ul>
    <div class="midd_84">东京安缦是东京这座传统与现代化首都一座具有里程碑意义的酒店，既散发都市活力气息，又不乏宁静。酒店坐落在大手町金融区，可轻松往返东京车站与热闹繁华的日本桥区。</div>
  </div>
<div class="clear"></div>
</div>

<div class="midd_auto midd_fff midd_top20 midd_80">
  <div class="midd_81"><a href="guidexx.html"><img src="images/guide_1_03.jpg"></a></div>
  <div class="midd_82">
    <div class="midd_83"><a href="guidexx.html">
      <h2>东京转车私导服务</h2>
      <div class="right">
        东京 | <span>244</span>人预约
      </div>
    <div class="clear"></div>
    </a></div>
    <div class="midd_83">
      <div class="left"><span><h4>￥</h4><h1>1560</h1></span> / 车</div>
      <div class="right">
        <img src="images/guide_1_06.jpg">123456/人点赞
      </div>
    <div class="clear"></div>
    </div>
    <ul>
      <li>舒适5座</li>
      <li>舒适5座</li>
      <li>舒适5座</li>
      <li>舒适5座</li>
      <li>舒适5座</li>
    <div class="clear"></div>
    </ul>
    <div class="midd_84">东京安缦是东京这座传统与现代化首都一座具有里程碑意义的酒店，既散发都市活力气息，又不乏宁静。酒店坐落在大手町金融区，可轻松往返东京车站与热闹繁华的日本桥区。</div>
  </div>
<div class="clear"></div>
</div>

<div id='pagina'>
    <a href='?tab=0&page=1'>上一页</a>
    <a href='?tab=0&page=1' class='number'>1</a>
    <a href='?tab=0&page=2' >2</a>
    <a href='?tab=0&page=3' >3</a>
    <a href='?tab=0&page=4' >4</a>
    <a href='?tab=0&page=5' >5</a>
    <a href='?tab=0&page=6' >6</a> &nbsp;
    ... <a href='?tab=0&page=22' >22</a>
    <a href='?tab=0&page=2'>下一页</a>
</div>

<!-- 底部 -->
<footer id="fh5co-footer" role="contentinfo">
    <div class="container">
      <div class="midd_10 col-sm-push-0 col-xs-push-0">
        <h3>关于我们</h3>
        <p>美溪传媒車友倶楽部成立于2016年8月1日，是在日本东京投资注册的独立法人公司。<br>公司专致于提供日本境内旅游业务，为外国游客提供餐饮和娱乐服务，</p>
        <p><a href="#" class="btn btn-primary btn-outline with-arrow btn-sm">联系我们<i class="icon-arrow-right"></i></a></p>
      </div>
      <div class="col-md-6 col-md-push-1 col-sm-12 col-sm-push-0 col-xs-12 col-xs-push-0">
        <ul class="float">
        <h3>联系方式</h3>
        <span>美溪车友传媒俱乐部</span>
          <li><a href="#"><img src="images/6_03.png">東京都世田谷区玉川2-15-12</a></li>
          <li><a href="#"><img src="images/6_07.png">090-0000-0000</a></li>
          <li><a href="#"><img src="images/6_10.png">090-0000-0000</a></li>
          <li><a href="#"><img src="images/6_13.png">090-0000-0000</a></li>
          <li><a href="#"><img src="images/6_17.png">contact@meixinpo.com</a></li>
        </ul>
        <div class="midd_65"><h3>微信公众号</h3><img src="images/17_03.jpg"></div>
      </div>
      <div class="clear"></div>
      <div class="midd_11">
        © 2016 美溪车友传媒俱乐部 All rights reserved
      </div>
    </div>
  </footer>

<!-- 返回顶部 -->
<div id="top"><img src="images/top.png"></div>
<script>
$('#top').click(function(){$('html,body').animate({scrollTop: '0px'}, 800);return false;});
</script>
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
$(function(){
  $(".sehun").click(function(){
	$(".navshow").slideToggle();
  });
});
</script>
</body>
</html>

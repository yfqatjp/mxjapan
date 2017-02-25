<?php require_once 'coon.php';
$navid = 2;
$rs = $pdo->query("SELECT * FROM `pm_page` WHERE `lang` = '2' AND id = " . $navid);
$row = $rs->fetch();

$rs2 = $pdo->query("SELECT * FROM pm_article_file WHERE checked = 1 AND lang = 2 AND type = 'image' AND file != '' ORDER BY rank LIMIT 1");
$row2 = $rs2->fetch();
?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<head>
    <?php require_once 'top.php'; ?>
    <style>
        body{ background:#f7f7f7;}
    </style>
</head>
<body>
<div class="sehun"></div>
<?php require_once 'head.php'; ?>
<div class="container"> </div>
<aside id="fh5co-hero" class="js-fullheight">
  <div class="flexslider js-fullheight">
    <ul class="slides">
      <li style="background: url(images/about.jpg) no-repeat; background-position:center center;">
        <div class="overlay-gradient"></div>
        <div class="container">
          <div class="col-md-10 col-md-offset-1 text-center js-fullheight slider-text">
            <div class="slider-text-inner midd_230ss">
              <h2>关于我们</h2>
              <p><span>带给您无尽享受与便捷</span></p>
            </div>
          </div>
        </div>
      </li>
    </ul>
  </div>
</aside>

<div class="midd_25">
  <div class="midd_26"><img src="images/11_03.png"><a href="index.html">首页</a> > <a href="#">关于我们</a> > <a href="about.html">联系我们</a></div>
</div>

<div class="midd_auto midd_top20 midd_fff" style="padding-bottom:20px;">
  <div class="midd_99">
    <a href="about.html" class="midd_100" style="margin-left:0;">关于我们</a>
    <a href="#">联系我们</a>
    <a href="#">用户协议</a>
    <a href="#" style="margin-left:0;">免责声明</a>
    <a href="#">隐私保护</a>
    <a href="#">常见问题</a>
  <div class="clear"></div>
  </div>
  <div class="midd_101">关于我们</div>
  <div class="midd_center"><img src="images/about_1.jpg"></div>
  <p class="midd_31 midd_88">美溪传媒車友倶楽部成立于2016年8月1日，是在日本东京投资注册的独立法人公司。公司专致于提供日本境内旅游业务，为外国游客提供餐饮和娱乐服务，建设集购物、住宿、交通、娱乐为一体的综合平台。</p>
  <p class="midd_31 midd_88">美溪传媒車友倶楽部是专业的海外自由行在线旅游服务平台，总部位于日本东京。美溪传媒車友倶楽部致力于建立一个为整个出境旅游业价值链服务的生态系统，并通过互联网来改变人们的旅行方式，落地一站式服务是布偶喵喵强力打造的新模式。美溪传媒車友倶楽部通过其自有技术平台有效匹配旅游业的供需，满足旅游服务供应商和中国旅行者的需求。对旅游服务供应商而言，我们通过在线平台为其提供技术支持；对旅行者而言，美溪传媒車友倶楽部通过网站及移动端的全平台覆盖，随时随地为用户提供出境旅游酒店预订，旅程线路私人定制，休闲度假、医疗体检、高端商务、境外投资等主题特色游咨询及服务，旅游视频攻略、图文攻略搜索，海外自由行接送机、专车畅游预订等产品及服务，帮助旅行者找到真正适合自己的产品。布偶喵喵自由行，用心做好每一段旅行。	【自定义区域】</p>
<div class="clear"></div>
</div>
<!-- 底部 -->
<footer id="fh5co-footer" role="contentinfo" class="midd_top20">
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

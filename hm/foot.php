<footer id="fh5co-footer" role="contentinfo">
    <div class="container">
        <div class="midd_10 col-sm-push-0 col-xs-push-0">
            <h3>关于我们</h3>
            <p>美溪传媒車友倶楽部成立于2016年8月1日，是在日本东京投资注册的独立法人公司。<br>公司专致于提供日本境内旅游业务，为外国游客提供餐饮和娱乐服务，</p>
            <p><a href="about.html" class="btn btn-primary btn-outline btn-sm">查看更多</a></p>
        </div>
        <div class="col-md-6 col-md-push-1 col-sm-12 col-sm-push-0 col-xs-12 col-xs-push-0">
            <ul class="float">
                <h3>联系方式</h3>
                <span><?php echo constant("SITE_TITLE");?></span>
                <li><a href="#"><img src="/images/6_03.png"><?php echo constant("ADDRESS");?></a></li>
                <li><a href="#"><img src="/images/6_07.png"><?php echo constant("PHONE");?></a></li>
                <li><a href="#"><img src="/images/6_10.png"><?php echo constant("MOBILE");?></a></li>
                <li><a href="#"><img src="/images/6_13.png"><?php echo constant("FAX");?></a></li>
                <li><a href="#"><img src="/images/6_17.png"><?php echo constant("EMAIL");?></a></li>
            </ul>
            <div class="midd_65"><h3>微信公众号</h3><img src="<?php echo constant("WECHAT_QR");?>"></div>
        </div>
        <div class="clear"></div>
        <div class="midd_11">
            © <?php echo date('Y');?> <?php echo constant("SITE_TITLE");?> All rights reserved
        </div>
    </div>
</footer>
<div class="kf repair_bar">
	<div class="n1">
		<div class="title">客服</div>
		<a class="icon help" href="/about.html" target="_blank"></a>
		<div class="icon qq" id="open-support">
			<div class="qq_hover"></div>
		</div>
	</div>
	<div class="n2">
		<div class="qrcode_hover"></div>
		<div class="icon qrcode"></div>
	</div>
	<!--<div class="n3" id="gotop" style="visibility: visible; display: block;">
		<div class="icon up"></div>
	</div>-->
</div>
<style>
@media screen and (min-width: 768px) {
.kf {position:fixed;top:130px;width:72px;right:10px;border-radius:5px;z-index:999;}
.kf .n1,.kf .n2,.kf .n3{background:#444;border-radius:5px;cursor:pointer}
.kf .n1{height:185px}
.kf .n2,.kf .n3{padding:1px 0;margin-top:1px}
.kf .n3{visibility: hidden; }
.kf .title{text-align:center;height:53px;line-height:72px;color:#fff;font-size:14px}
.kf .icon{background-color:#555;border-radius:47px;width:70px;height:61px; display:inline-block;}
.kf .qq{background:url(../images/kefu_hover_s.png) no-repeat -270px -74px}
.kf .help{background:url(../images/kefu_hover_s.png) no-repeat -270px -14px;}
.kf .qrcode{background:url(../images/kefu_hover_s.png) no-repeat -269px -150px}
.kf .up{background:url(../images/kefu_hover_s.png) no-repeat -269px -212px}
.kf .qrcode_hover{
    display:none;position:absolute;float:left;
    background:url(../images/17_03.jpg);
    right:75px;width:164px;height:164px;top:89px
}
.kf .qq_hover{
    display:none;position:absolute;float:left;
    /*background:url(../images/kefu_hover_s.png) no-repeat -10px -114px;*/
    right:72px;width:142px;height:62px
}
.kf .qq_hover:before /*div:after*/{
  content:"";
  position:absolute;
  top:22px;
  left:132px;
  width:0px;
  height:0px;
  border:10px solid transparent;
  border-left-color:#fff;
}
.kf .qq_hover:after{
  content:"090-1111-0000";
  position:absolute;
  top:1px;
  left:0px;
  width:132px;
  height:60px;
  background-color: #fff;
  line-height: 62px;
  padding-left: 5px;
}
}
p img{
    max-width: 100%;
    height: auto !important;
}
</style>

<!-- 返回顶部 -->
<div id="top"><img src="/images/top.png"></div>
<script>
    $('#top').click(function () {
        $('html,body').animate({scrollTop: '0px'}, 800);
        return false;
    });
    $(".qq").mouseover(function(){
		$(".qq_hover").show();
	}).mouseout(function(){
		$(".qq_hover").hide();
	});
    $(".qrcode").mouseover(function(){
		$(".qrcode_hover").show();
	}).mouseout(function(){
		$(".qrcode_hover").hide();
	});
</script>
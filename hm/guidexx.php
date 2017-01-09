<!DOCTYPE html>
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
body {
	background: #f7f7f7;
}
</style>

<!-- 评价 -->
<script type="text/javascript">
function rate(obj,oEvent){
var imgSrc = 'images/11_135.png';
var imgSrc_2 = 'images/11_10.png';
if(obj.rateFlag) return;
var e = oEvent || window.event;
var target = e.target || e.srcElement;
var imgArray = obj.getElementsByTagName("img");
for(var i=0;i<imgArray.length;i++){
   imgArray[i]._num = i;
   imgArray[i].onclick=function(){
    if(obj.rateFlag) return;
    alert//加个, 就没有弹窗了//(this._num+1);
	var inputid=this.parentNode.previousSibling
	inputid.value=this._num+1;
   }
}//欢迎来到站长 特效网，我们的网址是www.zzjs.net，很好记，zz站长，js就是js特效，本站收集大量高质量js代码，还有许多广告代码下载。
if(target.tagName=="IMG"){
   for(var j=0;j<imgArray.length;j++){
    if(j<=target._num){
     imgArray[j].src=imgSrc_2;
    } else {
     imgArray[j].src=imgSrc;
    }
	target.parentNode.onmouseout=function(){
	var imgnum=parseInt(target.parentNode.previousSibling.value);
		for(n=0;n<imgArray.length;n++){
			imgArray[n].src=imgSrc;
		}
		for(n=0;n<imgnum;n++){
			imgArray[n].src=imgSrc_2;
		}
	}
   }
} else {
	 return false;
}
}
</script>
</head>
<body>
<div class="sehun"></div>
<header id="fh5co-header" role="banner">
  <div class="container">
    <div class="header-inner">
      <div class="logo"><a href="index.html"><img src="images/logo.png"></a></div>
      <nav role="navigation" class="navshow">
        <ul>
          <li><a href="index.html">首页</a></li>
          <li class="navs"><a href="guide.html">车导服务</a></li>
          <li><a href="list_list.html">民宿</a></li>
          <li><a href="medical.html">医疗</a></li>
          <li><a href="gallery.html">旅游图库</a></li>
          <li><a href="realestate.html">不动产服务</a></li>
          <li><a href="about.html">关于我们</a></li>
          <li class="cta"><a href="signin.html">登录</a></li>
        </ul>
      </nav>
    </div>
  </div>
</header>
<div class="container"> </div>
<aside id="fh5co-hero">
  <div style="background: url(images/guide.jpg) no-repeat; background-position:center center; height:222px;">
    <div class="overlay-gradient"></div>
    <div class="container" style="height:222px;">
      <div class="col-md-offset-1 text-center js-fullheight slider-text">
        <div class="slider-text-inner midd_230s">
          <h2>美溪车友平台</h2>
          <p><span>租车随时随地，自驾自由自在</span></p>
        </div>
      </div>
    </div>
    <div class="clear"></div>
  </div>
</aside>

<div class="midd_25">
  <div class="midd_26"><img src="images/11_03.png"><a href="index.html">首页</a> > <a href="guide.html">车导服务 </a> > <a href="guidexx.html">京都专车私导服务</a></div>
</div>

<div id="fh5co-work-section" class="fh5co-light-grey-section" style="padding:0;">
  <div class="container">
    <div class="midd_27">
      <div class="left midd_52">
        <div id="originalpic">
          <li><a href="javascript:;"><img src="images/guide_4_03.png" style="display: inline;"></a></li>
          <li><a href="javascript:;"><img src="images/guide_4_03.png"></a></li>
          <li><a href="javascript:;"><img src="images/guide_4_03.png"></a></li>
          <li><a href="javascript:;"><img src="images/guide_4_03.png"></a></li>
          <li><a href="javascript:;"><img src="images/guide_4_03.png"></a></li>
          <a id="aPrev" style="cursor: url(http://img.suofeiya.com.cn/themes/default/images/prev.cur), auto; height: 600px;"></a> <a id="aNext" style="cursor: url(http://img.suofeiya.com.cn/themes/default/images/next.cur), auto; height: 600px;"></a> </div>
        <div class="thumbpic"> <a href="javascript:;" class="bntprev"></a>
          <div id="piclist">
            <ul>
              <li class="hover"><a href="javascript:;"><img src="images/guide_4_07.png"></a></li>
              <li><a href="javascript:;"><img src="images/guide_4_07.png"></a></li>
              <li><a href="javascript:;"><img src="images/guide_4_07.png"></a></li>
              <li><a href="javascript:;"><img src="images/guide_4_07.png"></a></li>
              <li><a href="javascript:;"><img src="images/guide_4_07.png"></a></li>
            </ul>
          </div>
          <a href="javascript:;" class="bntnext"></a> </div>
      </div>
      <div class="midd_28">
        <div class="midd_29">京都专车私导服务</div>
        <div class="midd_48"> <span class="midd_102">东京安缦是东京这座传统与现代化首都一座具有里程碑意义的酒店，既散发都市活力气息，又不乏宁静。酒店坐落在大手町金融区，可轻松往返东京车站与热闹繁华的日本桥区。</span> </div>
        <div class="midd_103"><span>￥</span><h1>1560</h1> / 车<div class="clear"></div></div>
        <div class="midd_104">
          <a href="javascript:void(0);" class="active">舒适5座</a>
          <a href="javascript:void(0);">舒适7座</a>
          <a href="javascript:void(0);">商务10座</a>
          <a href="javascript:void(0);">豪华5座</a>
          <a href="javascript:void(0);">豪华7座</a>
        <div class="clear"></div>
        </div>
        <div class="midd_127"><div class="rendezvous-input-date" id="start">选择预定日期</div></div>
        <div class="midd_115">
          <select name="select" class="input_11">
          <option>成人/人</option></select>
          <select name="select" class="input_11" style="margin-right:0;"><option>儿童（0~5岁）/人</option></select>
        <div class="clear"></div>
        </div>
        <input type="submit" name="button" class="input_12" value="立即预约" onclick="window.location='payment.html';">
        <div class="midd_128">
          <span style="color:#e83744;">244</span>人预约 | <img src="images/guide_1_06.jpg"><span style="color:#e83744;">244</span>/人点赞 | 顾客评分：<span style="color:#104787;">5.0</span>分 | 评论数：<span style="color:#104787;">156</span>次
        </div>
        <!-- 选择日期 --> 
        <script type="text/javascript" src="js/laydate.js"></script> 
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
        <script type="text/javascript">
jQuery(function(){
	var list = jQuery('.midd_104 a');
	list.click(function(){
		list.removeClass('active');
		jQuery(this).addClass('active');
	});
});
</script>
      </div>
      <div class="clear"></div>
    </div>
    
      <div class="midd_105">
      <a href="#q1" class="midd_106">线路详细</a>
      <a href="#q2">服务流程</a>
      <a href="#q3">车辆信息</a>
      <a href="#q4">服务标准</a>
      <a href="#q5">注意事项</a>
      <a href="#q6">用户评价</a>
    </div>
    <div class="midd_27" style="margin-top:0;">
      <a name="q1"></a>
      <div class="midd_107">线路详细</div>
      <div class="midd_108 midd_top20">
        <img src="images/guide_4_11.png">
        <div class="midd_109">第一天：浅草到横滨  吃遍美食</div>
      <div class="clear"></div>
      </div>
      <div class="midd_110">
        <p>【大阪城公园】：丰臣秀吉于公元1583年在石山本愿寺遗址上初建，至今已有400多年历史，为当时日本名城，也是日本前所未有的大城堡（不登城）。
        <br>【心斋桥】百货商店与各式专门店等为大阪代表性的中心商务区。
        <br>【圆山公园】+【祗园艺伎街】+【八坂神社】(约60分钟)是位在京都府京都市东山区的公园。被指定为国之名胜。公园邻接东山、八坂神社、高台寺、知恩院等。是京都香火较旺的神社之一。这里每年7月都会举行热闹非凡的祇园祭，与东京的神田祭、大阪的天神祭并称为“日本三大祭”。</p>
        <img src="images/guide_4_15.png">
        <img src="images/guide_4_15.png">
      <div class="clear"></div>
      </div>
      <div class="midd_108">
        <img src="images/guide_4_11.png">
        <div class="midd_109">第二天：东京到大板，看遍日本名胜古迹</div>
      <div class="clear"></div>
      </div>
      <div class="midd_110">
        <p>【富士山五合目】富士山由山脚至山顶共分为十合，半山腰称为五合目。★特别报告：如天气不好五合目封山, 将更改为一合目代替, 敬请理解!
        <br>【忍野八海】忍野八海的平均水温约摄氏13度，水质清冽甘甜，被誉为“日本九寨沟”，是忍野地区指定的国家自然风景区，1985年入选“日本名水百选”。为国家指定天然记念物、名水百选、新富岳百景之一。
        <br>【御殿场奥特莱斯】坐落于风景优美的自然环境中，可眺望富士山，拥有欧风式的建筑外观。自开业以来，这里就聚集了许多日本国内外著名品牌专营店，加上距离富士山、箱根等度假地距离很近的优越条件，所以是很多海外游客日本之旅的必经之地。</p>
        <img src="images/guide_4_15.png">
        <img src="images/guide_4_15.png">
      <div class="clear"></div>
      </div>
      <div class="midd_108">
        <img src="images/guide_4_11.png">
        <div class="midd_109">第三天：浅草雷门观音寺</div>
      <div class="clear"></div>
      </div>
      <div class="midd_111">
        <p>【富士山五合目】富士山由山脚至山顶共分为十合，半山腰称为五合目。★特别报告：如天气不好五合目封山, 将更改为一合目代替, 敬请理解!
        <br>【忍野八海】忍野八海的平均水温约摄氏13度，水质清冽甘甜，被誉为“日本九寨沟”，是忍野地区指定的国家自然风景区，1985年入选“日本名水百选”。为国家指定天然记念物、名水百选、新富岳百景之一。
        <br>【御殿场奥特莱斯】坐落于风景优美的自然环境中，可眺望富士山，拥有欧风式的建筑外观。自开业以来，这里就聚集了许多日本国内外著名品牌专营店，加上距离富士山、箱根等度假地距离很近的优越条件，所以是很多海外游客日本之旅的必经之地。</p>
        <img src="images/guide_4_15.png">
        <img src="images/guide_4_15.png">
      <div class="clear"></div>
      </div>
      <a name="q2"></a>
      <div class="midd_107 midd_top20">服务流程</div>
      <div class="midd_115">
        <div class="midd_112"><img src="images/guide_4_22.png"><span>选择旅行日期</span></div>
        <div class="midd_112"><img src="images/guide_4_25.png"><span>完成支付订单</span></div>
        <div class="midd_112"><img src="images/guide_4_28.png"><span>等待客服联系</span></div>
        <div class="midd_112"><img src="images/guide_4_30.png"><span>核实订单信息</span></div>
        <div class="midd_113"><img src="images/guide_4_32.png"><span>体验精彩旅程</span></div>
        <div class="midd_114"><h1>服<br>务<br>提<br>醒</h1><span>我们会提前1-2天按照订单上的联系方式跟您取得联系并确认集合时间和地点，凭预定时预留姓名与订单手机号与司机核实使用。</span></div>
      <div class="clear"></div>
      </div>
      <a name="q3"></a>
      <div class="midd_107 midd_top20">车辆信息</div>
      <div class="midd_115">
        <div class="midd_116">
          <img src="images/guide_5_03.jpg">
          <span><h1>舒适5座</h1><h2>丰田普锐斯或同级</h2></span>
          <div class="midd_117">
            <div class="left"><div class="midd_117">建 议<br>乘 坐</div><div class="midd_118"><i><b>4</b> /人</i></div></div>
            <div class="right">
              <div class="midd_119"><div class="midd_120">建议大行李箱</div><div class="midd_121"><i><b>1</b> /件</i></div></div>
              <div class="midd_119"><div class="midd_120">建议小行李箱</div><div class="midd_121"><i><b>1</b> /件</i></div></div>
            </div>
          </div>
        </div>
        <div class="midd_116" style="margin-right:0;">
          <img src="images/guide_5_05.jpg">
          <span><h1>舒适7座</h1><h2>丰田埃尔法或同级</h2></span>
          <div class="midd_117">
            <div class="left"><div class="midd_117">建 议<br>乘 坐</div><div class="midd_118"><i><b>6</b> /人</i></div></div>
            <div class="right">
              <div class="midd_119"><div class="midd_120">建议大行李箱</div><div class="midd_121"><i><b>4</b> /件</i></div></div>
              <div class="midd_119"><div class="midd_120">建议小行李箱</div><div class="midd_121"><i><b>2</b> /件</i></div></div>
            </div>
          </div>
        </div>
        <div class="midd_116">
          <img src="images/guide_5_10.jpg">
          <span><h1>商务10座</h1><h2>丰田海狮或同级</h2></span>
          <div class="midd_117">
            <div class="left"><div class="midd_117">建 议<br>乘 坐</div><div class="midd_118"><i><b>10</b> /人</i></div></div>
            <div class="right">
              <div class="midd_119"><div class="midd_120">建议大行李箱</div><div class="midd_121"><i><b>6</b> /件</i></div></div>
              <div class="midd_119"><div class="midd_120">建议小行李箱</div><div class="midd_121"><i><b>4</b> /件</i></div></div>
            </div>
          </div>
        </div>
        <div class="midd_116" style="margin-right:0;">
          <img src="images/guide_5_12.jpg">
          <span><h1>豪华5座</h1><h2>宾利欧陆或同级</h2></span>
          <div class="midd_117">
            <div class="left"><div class="midd_117">建 议<br>乘 坐</div><div class="midd_118"><i><b>3</b> /人</i></div></div>
            <div class="right">
              <div class="midd_119"><div class="midd_120">建议大行李箱</div><div class="midd_121"><i><b>1</b> /件</i></div></div>
              <div class="midd_119"><div class="midd_120">建议小行李箱</div><div class="midd_121"><i><b>1</b> /件</i></div></div>
            </div>
          </div>
        </div>
        <div class="midd_116">
          <img src="images/guide_5_17.jpg">
          <span><h1>豪华7座</h1><h2>丰田埃尔法豪华版或者同等</h2></span>
          <div class="midd_117">
            <div class="left"><div class="midd_117">建 议<br>乘 坐</div><div class="midd_118"><i><b>10</b> /人</i></div></div>
            <div class="right">
              <div class="midd_119"><div class="midd_120">建议大行李箱</div><div class="midd_121"><i><b>6</b> /件</i></div></div>
              <div class="midd_119"><div class="midd_120">建议小行李箱</div><div class="midd_121"><i><b>4</b> /件</i></div></div>
            </div>
          </div>
        </div>
        <div class="midd_116" style="margin-right:0;">
          <div class="midd_122">预约前请注意</div>
          <div class="midd_123">建议乘坐人数中成人与儿童同样占座<br>每减少1位乘客即可增加1件行李</div>
        </div>
      <div class="clear"></div>
      </div>
      <a name="q4"></a>
      <div class="midd_107 midd_top20">服务标准</div>
      <div class="midd_115">
        <p class="midd_124">自定义区域<br>来到拜伦湾，你当然不能错过全澳最早的日出。</p>
        <p class="midd_124">在湾区东边的山顶的那座白色灯塔下，俯瞰这片蔚蓝海岸被涂上金黄，只有凝神屏气，才不会辜负这份绝美的景观。</p>
        <div class="midd_125"><img src="images/guide_4_42.jpg"><img src="images/guide_4_45.jpg" style="margin-right:0;"></div>
      <div class="clear"></div>
      </div>
      <a name="q5"></a>
      <div class="midd_107 midd_top20">注意事项</div>
      <div class="midd_126">
        自定义区域<br>
        1. 一经预定不得取消和修改日期；<br>
        2. 此款特卖产品数量有限，因此需要您至少提前5天预订车辆；<br>
        3. 请注意，这个产品是同店取还车；<br>
        4. 主驾驶员要求持有驾照时间至少满一年；<br>
        5. 驾驶员请在预约租车后准备相应的驾照翻译件，可联系租租车协助完成；<br>
        6. 主驾驶人本人必须持有Visa或者Mastercard标志的国际信用卡；<br>
        7. 提交订单后，租租车将在3个工作日内为您确认订单，如遇周末或法定节假日将顺延至工作日处理。
      </div>
      <a name="q6"></a>
      <div class="midd_107 midd_top20">用户评价</div>
      <div class="midd_40">
        <div class="left">整体评分：<span>4.7</span>/分</div>
        <img src="images/11_10.png"><img src="images/11_10.png"><img src="images/11_10.png"><img src="images/11_10.png"><img src="images/11_10.png"></div>
      <div class="midd_115">
        <div class="midd_41">
          <div class="midd_42"><img src="images/13.jpg"><span>小鱼儿</span></div>
          <div class="left">
            <div class="midd_43"><img src="images/10_10.png"><img src="images/10_10.png"><img src="images/guide_6_07.jpg"><img src="images/guide_6_07.jpg"><img src="images/guide_6_07.jpg"><span>2016-10-25</span>
              <div class="clear"></div>
            </div>
            <div class="midd_44">环境不错 性价比高 房间不错 这家酒店位置特别好找就在总统大厦旁边 房间设施也很好 特别是前台的服务很好 每次路过前台都是微笑的打招呼 对客人提出的要求也都尽最大的努力满足 跟前台经理张毅已经成了很熟的朋友 非常有家的感觉 强烈推荐</div>
          </div>
          <div class="clear"></div>
        </div>
        <div class="midd_41">
          <div class="midd_42"><img src="images/13.jpg"><span>小鱼儿</span></div>
          <div class="left">
            <div class="midd_43"><img src="images/10_10.png"><img src="images/10_10.png"><img src="images/10_10.png"><img src="images/10_10.png"><img src="images/guide_6_07.jpg"><span>2016-10-25</span>
              <div class="clear"></div>
            </div>
            <div class="midd_44">环境不错 性价比高 房间不错 这家酒店位置特别好找就在总统大厦旁边 房间设施也很好 特别是前台的服务很好 每次路过前台都是微笑的打招呼 对客人提出的要求也都尽最大的努力满足 跟前台经理张毅已经成了很熟的朋友 非常有家的感觉 强烈推荐</div>
          </div>
          <div class="clear"></div>
        </div>
        <div class="midd_41">
          <div class="midd_42"><img src="images/13.jpg"><span>小鱼儿</span></div>
          <div class="left">
            <div class="midd_43"><img src="images/10_10.png"><img src="images/10_10.png"><img src="images/10_10.png"><img src="images/10_10.png"><img src="images/10_10.png"><span>2016-10-25</span>
              <div class="clear"></div>
            </div>
            <div class="midd_44">环境不错 性价比高 房间不错 这家酒店位置特别好找就在总统大厦旁边 房间设施也很好 特别是前台的服务很好 每次路过前台都是微笑的打招呼 对客人提出的要求也都尽最大的努力满足 跟前台经理张毅已经成了很熟的朋友 非常有家的感觉 强烈推荐</div>
          </div>
          <div class="clear"></div>
        </div>
        <div class="midd_41">
          <div class="midd_42"><img src="images/13.jpg"><span>小鱼儿</span></div>
          <div class="left">
            <div class="midd_43"><img src="images/10_10.png"><img src="images/10_10.png"><img src="images/10_10.png"><img src="images/10_10.png"><img src="images/10_10.png"><span>2016-10-25</span>
              <div class="clear"></div>
            </div>
            <div class="midd_44">环境不错 性价比高 房间不错 这家酒店位置特别好找就在总统大厦旁边 房间设施也很好 特别是前台的服务很好 每次路过前台都是微笑的打招呼 对客人提出的要求也都尽最大的努力满足 跟前台经理张毅已经成了很熟的朋友 非常有家的感觉 强烈推荐</div>
          </div>
          <div class="clear"></div>
        </div>
        <div class="midd_41">
          <div class="midd_42"><img src="images/13.jpg"><span>小鱼儿</span></div>
          <div class="left">
            <div class="midd_43"><img src="images/10_10.png"><img src="images/10_10.png"><img src="images/10_10.png"><img src="images/guide_6_07.jpg"><img src="images/guide_6_07.jpg"><span>2016-10-25</span>
              <div class="clear"></div>
            </div>
            <div class="midd_44">环境不错 性价比高 房间不错 这家酒店位置特别好找就在总统大厦旁边 房间设施也很好 特别是前台的服务很好 每次路过前台都是微笑的打招呼 对客人提出的要求也都尽最大的努力满足 跟前台经理张毅已经成了很熟的朋友 非常有家的感觉 强烈推荐</div>
          </div>
          <div class="clear"></div>
        </div>
        <div class="midd_41">
          <div class="midd_42"><img src="images/13.jpg"><span>小鱼儿</span></div>
          <div class="left">
            <div class="midd_43"><img src="images/10_10.png"><img src="images/10_10.png"><img src="images/10_10.png"><img src="images/guide_6_07.jpg"><img src="images/guide_6_07.jpg"><span>2016-10-25</span>
              <div class="clear"></div>
            </div>
            <div class="midd_44">环境不错 性价比高 房间不错 这家酒店位置特别好找就在总统大厦旁边 房间设施也很好 特别是前台的服务很好 每次路过前台都是微笑的打招呼 对客人提出的要求也都尽最大的努力满足 跟前台经理张毅已经成了很熟的朋友 非常有家的感觉 强烈推荐</div>
          </div>
          <div class="clear"></div>
        </div>
      <div class="clear"></div>
      </div>
      <!-- 翻页 -->
      <div id='pagina'> <a href='?tab=0&page=1'>上一页</a> <a href='?tab=0&page=1' class='number'>1</a> <a href='?tab=0&page=2' >2</a> <a href='?tab=0&page=3' >3</a> <a href='?tab=0&page=4' >4</a> <a href='?tab=0&page=5' >5</a> <a href='?tab=0&page=6' >6</a> &nbsp;
        ... <a href='?tab=0&page=22' >22</a> <a href='?tab=0&page=2'>下一页</a> </div>
      <textarea name="textarea" class="input_1" placeholder="输入你的留言..."></textarea>
        <div class="midd_45">
        <div class="left" onmouseover="rate(this,event)"><span>评价：</span><img src="images/11_135.png"><img src="images/11_135.png"><img src="images/11_135.png"><img src="images/11_135.png"><img src="images/11_135.png"></div>
        <div class="right">
            <input type="submit" name="button" class="midd_39s" style="margin-top:0;" value="确认评价">
          </div>
        <div class="clear"></div>
      </div>
    <div class="clear"></div>
    </div>
    
    <div class="midd_27">
      <div class="midd_46">推荐车导服务</div>
      <div class="midd_47"><a href="list.html"><img src="images/11_138.png"><span>东京专车私导服务</span></a></div>
      <div class="midd_47"><a href="list.html"><img src="images/11_138.png"><span>东京专车私导服务</span></a></div>
      <div class="midd_47"><a href="list.html"><img src="images/11_138.png"><span>东京专车私导服务</span></a></div>
      <div class="midd_47"><a href="list.html"><img src="images/11_138.png"><span>东京专车私导服务</span></a></div>
      <div class="midd_47" style="margin-right:0;"><a href="list.html"><img src="images/11_138.png"><span>东京专车私导服务</span></a></div>
      <div class="clear"></div>
    </div>
  </div>
<div class="clear"></div>
</div>


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

<!-- 产品图片 --> 
<script src="js/slider.photo.js"></script>
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

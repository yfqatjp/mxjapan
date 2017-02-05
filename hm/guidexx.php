<?php 

require_once 'coon.php';

$navid = 5;

$rs = $pdo->query("SELECT * FROM `pm_page` WHERE `lang` = '2' AND id = " . $navid);
$row = $rs->fetch();

$rs2 = $pdo->query("SELECT * FROM pm_article_file WHERE checked = 1 AND lang = 2 AND type = 'image' AND file != '' ORDER BY rank LIMIT 1");
$row2 = $rs2->fetch();

//
require_once $_SERVER['DOCUMENT_ROOT'] . '/common/HmWeb.php';

// 车导ID
$charterId = $hmWeb->query("id", 0);

// 车导情报
$charterSql = "SELECT * FROM `pm_charter` WHERE `lang` = '2' AND id = ? ";

// 取得车导情报
$arrCharter = $hmWeb->findOne($charterSql, array($charterId));

// 车导情报取不到的时候，跳转到一览画面
if ($arrCharter == null || count($arrCharter) == 0) {
	// 非法请求
	header("Location: guide.html");
	exit();
}

// 图片的sql
$charterFileSql = "SELECT * FROM pm_charter_file WHERE id_item = ? AND checked = 1 AND lang = ".$hmWeb->defaultLang." AND type = 'image' AND file != '' ORDER BY rank ";

$arrCharterImages = array();
// 一览的图片设定
$arrCharterFileResult = $hmWeb->findAll($charterFileSql, array($charterId));
if ($arrCharterFileResult != null && count($arrCharterFileResult) > 0) {
	foreach($arrCharterFileResult as $arrImageResult) {
		$arrImages = array();
		$file_id = $arrImageResult['id'];
		$filename = $arrImageResult['file'];
		$realpath = $_SERVER['DOCUMENT_ROOT']."/medias/charter/small/".$file_id."/".$filename;
		$thumbpath = "/medias/charter/small/".$file_id."/".$filename;
		if (is_file($realpath)) {
			$arrImages["small_image"] = $thumbpath;
		} else {
			$arrImages["small_image"] = "";
		}
		
		$realpath = $_SERVER['DOCUMENT_ROOT']."/medias/charter/big/".$file_id."/".$filename;
		$thumbpath = "/medias/charter/big/".$file_id."/".$filename;
		if (is_file($realpath)) {
			$arrImages["big_image"] = $thumbpath;
		} else {
			$arrImages["big_image"] = "";
		}
		$arrImages["image_label"] = $arrImageResult["label"];
		$arrCharterImages[] = $arrImages;
	}
}

// 设定的座位
$charterClassesSql = "SELECT T1.price, T1.class_id, T2.title
    				FROM pm_charter_classes T1
    				INNER JOIN pm_charter_class T2 ON ( T1.class_id = T2.id and T2.lang = ".$hmWeb->defaultLang." )
    				WHERE T1.charter_id = ? ORDER BY T1.price DESC ";
// 取得包车规格
$arrCharterClassResult = $hmWeb->findAll($charterClassesSql, array($charterId));
if ($arrCharterClassResult != null) {
	$arrCharter["classes"] = $arrCharterClassResult;
} else {
	$arrCharter["classes"] = array();
}

$arrOptions = $hmWeb->getSelectOptions();

$choiceClassId = 0;
$choiceClassPrice = 0;
if (count($arrCharter["classes"]) > 0) {
	$choiceClassId = $arrCharter["classes"][0]["class_id"];
	$choiceClassPrice = $arrCharter["classes"][0]["price"];
}

// 设置
$arrSetting = $hmWeb->findCharterSetting();

$settingIndex = 4;

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

<!--  -->
<?php require_once 'head.php';?>

<div class="container"> </div>
<aside id="fh5co-hero">
  <div style="background: url(/images/guide.jpg) no-repeat; background-position:center center; height:222px;">
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
  <div class="midd_26"><img src="/images/11_03.png"><a href="index.html">首页</a> > 
  <a href="guide.html">车导服务 </a> > 
  <a href="guidexx.html?id=<?php echo $charterId;?>"><?php echo $hmWeb->t("title", $arrCharter);?></a></div>
</div>


<div id="fh5co-work-section" class="fh5co-light-grey-section" style="padding:0;">
  <div class="container">
    <div class="midd_27">
    
      <div class="left midd_52">
      	<?php 
      	if (count($arrCharterImages) > 0) {
      		
      	?>
        <div id="originalpic">
        	<?php 
	      	foreach($arrCharterImages as $index => $arrImageData) {
	      		
	      	?>
	          <li><a href="javascript:;"><img src="<?php echo $arrImageData["big_image"];?>" <?php if ($index == 0) { echo 'style="display: inline;"';}?> ></a></li>
			<?php 
	      	}
	      	?>
          <a id="aPrev" style="cursor: url(http://img.suofeiya.com.cn/themes/default/images/prev.cur), auto; height: 600px;"></a> 
          <a id="aNext" style="cursor: url(http://img.suofeiya.com.cn/themes/default/images/next.cur), auto; height: 600px;"></a> 
        </div>
        <div class="thumbpic"> <a href="javascript:;" class="bntprev"></a>
          <div id="piclist">
            <ul>
			<?php 
	      	foreach($arrCharterImages as $index => $arrImageData) {
	      		
	      	?>
	          <li <?php if ($index == 0) { echo 'class="hover"';}?> >
	          <a href="javascript:;"><img src="<?php echo $arrImageData["small_image"];?>"  ></a>
	          </li>
			<?php 
	      	}
	      	?>
            </ul>
          </div>
          <a href="javascript:;" class="bntnext"></a> 
      	</div>
      	
		<?php 
      	} else {
      	?>
      	
		<div id="originalpic">
          <li><a href="javascript:;"><img src="images/guide_4_03.png" style="display: inline;"></a></li>
          <a id="aPrev" style="cursor: url(http://img.suofeiya.com.cn/themes/default/images/prev.cur), auto; height: 600px;"></a> 
          <a id="aNext" style="cursor: url(http://img.suofeiya.com.cn/themes/default/images/next.cur), auto; height: 600px;"></a> 
        </div>
        <div class="thumbpic"> <a href="javascript:;" class="bntprev"></a>
          <div id="piclist">
            <ul>
              <li class="hover"><a href="javascript:;"><img src="images/guide_4_07.png"></a></li>
            </ul>
          </div>
          <a href="javascript:;" class="bntnext"></a> 
      	</div>
		<?php 
      	}
      	?>
      	
      </div>
      
      <div class="midd_28">
        <div class="midd_29"><?php echo $hmWeb->t("title", $arrCharter);?></div>
        <div class="midd_48">
        <span class="midd_102"><?php echo $hmWeb->t("descr", $arrCharter);?></span> </div>
        <div class="midd_103"><span>￥</span><h1 id="choice_class_price"><?php echo $choiceClassPrice;?></h1> / 车<div class="clear"></div></div>
        <div class="midd_104">
        
         <?php foreach($arrCharter['classes'] as $classesList) {?>
	     <a href="javascript:void(0);" <?php if ($classesList["class_id"] == $choiceClassId) {echo 'class="active"';} ?> 
	      data-price="<?php echo $classesList["price"];?>" 
	      data-classId="<?php echo $classesList["class_id"];?>">
	      <?php echo $classesList["title"];?>
	      </a>
	     <?php } ?>
        <div class="clear"></div>
        </div>
        <div class="midd_127"><div class="rendezvous-input-date" id="start">选择预定日期</div></div>
        <div class="midd_115">
          <select name="select" class="input_11">
          <option value="0">成人/人</option>
          <?php 
          foreach($arrOptions as $k => $v) {
          ?>
          <option value="<?php echo $k;?>"><?php echo $v;?></option>
          <?php 
          }
          ?>
          </select>
          <select name="select" class="input_11" style="margin-right:0;">
          <option value="0">儿童（0~5岁）/人</option>
          <?php 
          foreach($arrOptions as $k => $v) {
          ?>
          <option value="<?php echo $k;?>"><?php echo $v;?></option>
          <?php 
          }
          ?>
          </select>
        <div class="clear"></div>
        </div>
        <input type="submit" name="button" class="input_12" value="立即预约" onclick="window.location='payment.html';">
        
        <div class="midd_128">
          <span style="color:#e83744;"><?php echo $arrCharter['book_count'];?></span>人预约 | 
          <img src="images/guide_1_06.jpg"><span style="color:#e83744;"><?php echo $arrCharter['like_count'];?></span>/人点赞 | 顾客评分：
          <span style="color:#104787;"><?php echo $arrCharter['score_count'];?></span>分 | 评论数：
          <span style="color:#104787;"><?php echo $arrCharter['comment_count'];?></span>次
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

		var price = jQuery(this).data("price");
		$("#choice_class_price").html(price);
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
      <?php foreach($arrSetting as $index => $setting) {
      	echo '<a href="#q'.($settingIndex + $index).'">'.$setting["name"].'</a>';
      }?>
      <a href="#q<?php echo $settingIndex + count($arrSetting);?>">用户评价</a>
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
      
      <!-- 服务流程 -->
      <a name="q2"></a>
	  <?php require_once 'include/services_rules.php';?>
	  
	  <!-- 车辆信息 -->
      <a name="q3"></a>
      <?php require_once 'include/car_info.php';?>


	  <!-- 服务标准/注意事项 -->
      <?php 
      foreach($arrSetting as $index => $setting) {
      	echo '<a name="q'.($settingIndex + $index).'"></a>';
      	echo '<div class="midd_107 midd_top20">'.$setting["name"].'</div>';
      ?>
      <div class="midd_126">
        <?php echo $setting["content"];?>
        
        <?php 
        if (count($setting["images"]) > 0) {
        ?>
        <div class="midd_125">
        	<?php 
		      foreach($setting["images"] as $images) {
		      ?>
        	<img src="<?php echo $images;?>">
	        <?php 
		      }
		      ?>
        </div>
         <?php 
	      }
	      ?>
      <div class="clear"></div>
      </div>
      
      <?php 
      }
      ?>
      
      
      <a name="q<?php echo $settingIndex + count($arrSetting);?>"></a>
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

<!-- 底部 -->
<?php require_once 'foot.php';?>


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

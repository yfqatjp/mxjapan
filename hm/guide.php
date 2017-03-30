<?php 

require_once 'coon.php';

$navid = 5;

$rs = $pdo->query("SELECT * FROM `pm_page` WHERE `lang` = '2' AND id = " . $navid);
$row = $rs->fetch();

$rs2 = $pdo->query("SELECT * FROM pm_article_file WHERE checked = 1 AND lang = 2 AND type = 'image' AND file != '' ORDER BY rank LIMIT 1");
$row2 = $rs2->fetch();

//
require_once $_SERVER['DOCUMENT_ROOT'] . '/common/HmWeb.php';

// 城市
$citySql = "SELECT * FROM `pm_charter_city` WHERE `lang` = '2' AND checked = 1 ORDER BY rank ASC ";
$arrCity = $hmWeb->findAll($citySql);

// 包车种类
$typeSql = "SELECT * FROM `pm_charter_type` WHERE `lang` = '2' ORDER BY rank ASC ";
$arrType = $hmWeb->findAll($typeSql);

// 画面请求的参数
$arrParams = array();
$arrParams["city"] = $hmWeb->query("city", "");
$cityIdVal = $hmWeb->t("city", $arrParams);
$arrParams["charter_type"] = $hmWeb->query("charter_type", "");
$charter_typeVal = $hmWeb->t("charter_type", $arrParams);

$arrParams["order_by"] = $hmWeb->query("order_by", "");

// 当前页码
$arrParams["page"] = $hmWeb->query("page", 1);
$pageNum = $arrParams["page"];
// 每页显示的件数
$arrParams["limit"] = $hmWeb->perPageCount;
// 总的件数
$total = $hmWeb->findCharterList($arrParams, true);

// 页码
$arrPager = $hmWeb->getPager($total, $arrParams["page"], $arrParams["limit"]);

// 包车数据检索
$charterList = $hmWeb->findCharterList($arrParams, false);

//
$token = $hmWeb->getToken();

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

<!--  -->
<?php require_once 'head.php';?>

<div class="container"> </div>

<?php require_once 'include/slide.php';?>

<form id="searchForm" name="searchForm" action="?" method="get">
	<input type="hidden" name="city" id="city" value="<?php echo $hmWeb->t("city", $arrParams); ?>" />
	<input type="hidden" name="charter_type" id="charter_type" value="<?php echo $hmWeb->t("charter_type", $arrParams); ?>" />
	
	<input type="hidden" name="order_by" id="order_by" value="<?php echo $hmWeb->t("order_by", $arrParams); ?>" />
	<input type="hidden" name="page" id="page" value="<?php echo $hmWeb->t("page", $arrParams); ?>" />
</form>
<!-- 内容 -->
<div class="midd_auto midd_fff midd_top20">
  <div class="midd_78" id="midd_78">
    <span>地区：</span>
    <ul>
      <li <?php if (empty($cityIdVal)) {echo 'class="active"';} ?>  onclick="searchFun('city', '');" >全部</li>
      <?php 
      	if ($arrCity != null && count($arrCity) > 0) {
      		foreach($arrCity as $cityArr) {
      			$cityId = $cityArr["id"];
      			if ($cityIdVal == $cityId) {
      				echo "<li class=\"active\" onclick=\"searchFun('city', '".$cityId."')\">".$cityArr["name"]."</li>";
      			} else {
      				echo "<li onclick=\"searchFun('city', '".$cityId."')\">".$cityArr["name"]."</li>";
      			}
      		}
      	}
      ?>
    </ul>
  <div class="clear"></div>
  </div>
  <div class="midd_78" id="midd_79">
    <span>类型 ：</span>
    <ul>
      <li <?php if (empty($charter_typeVal)) {echo 'class="active"';} ?> onclick="searchFun('charter_type', '');">全部</li>
      <?php 
      	if ($arrType != null && count($arrType) > 0) {
      		foreach($arrType as $typeArr) {
      			$charterTypeId = $typeArr["id"];
      			if ($charter_typeVal == $charterTypeId) {
      				echo "<li class=\"active\" onclick=\"searchFun('charter_type', '".$charterTypeId."')\">".$typeArr["name"]."</li>";
      			} else {
      				echo "<li onclick=\"searchFun('charter_type', '".$charterTypeId."')\">".$typeArr["name"]."</li>";
      			}
      		}
      	}
      ?>
    </ul>
  <div class="clear"></div>
  </div>
  <div class="midd_79">
    <div class="left"> 
    <a href="javascript:void(0);" onclick="searchFun('order_by', 'like');"><?php if ($hmWeb->t("order_by", $arrParams) == "like") {?><span>人气</span><img src="/images/9_08.png"><?php } else {?>人气<img src="/images/9_10.png"><?php }?></a> 
    <a href="javascript:void(0);" onclick="searchFun('order_by', 'price');"><?php if ($hmWeb->t("order_by", $arrParams) == "price") {?><span>价格</span><img src="/images/9_08.png"><?php } else {?>价格<img src="/images/9_10.png"><?php }?></a> 
    <a href="javascript:void(0);" onclick="searchFun('order_by', 'book');"><?php if ($hmWeb->t("order_by", $arrParams) == "book") {?><span>销量</span><img src="/images/9_08.png"><?php } else {?>销量<img src="/images/9_10.png"><?php }?></a> </div>
    <div class="right">
		<a href="javascript:void(0);" onclick="changeToGrid('guide.html');"><img src="/images/10_03.png"><br><span>列表</span></a>
		<a href="javascript:void(0);" onclick="changeToGrid('guide_grid.html');"><img src="/images/7_07.png"><br>网格</a>
	</div>
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

<?php
foreach($charterList as $i => $arrCharter){

	$charter_id = $arrCharter['id'];
	$charter_title = $arrCharter['title'];

	
?>
<div class="midd_auto midd_fff midd_top20 midd_80">
  <div class="midd_81">
  	<a href="guidexx.html?id=<?php echo $charter_id;?>">
  	<?php 
  		if (empty($arrCharter['image_url'])) {
  	?>
  		<img src="/images/guide_1_03.jpg">
  	<?php } else {?>
  		<img style="max-width: 250px;" src="<?php echo $arrCharter['image_url'];?>" alt="<?php echo $arrCharter['image_label'];?>">
  	<?php }?>
  	</a>
  </div>
  <div class="midd_82">
    <div class="midd_83">
    <a href="guidexx.html?id=<?php echo $charter_id;?>">
      <h2><?php echo $charter_title;?></h2></a>
      <div class="right"><?php echo $arrCharter['city_name'];?> | <span><?php echo $arrCharter['book_count'];?></span>人预约</div>
    <div class="clear"></div>
    </div>
    <div class="midd_83">
      <div class="left"><span><h4>￥</h4><h1><?php echo $arrCharter['max_price'];?></h1></span> / 车</div>
      <div class="right">
        <a href="javascript:void(0);" onclick="clickLike(<?php echo $charter_id;?>)"><img src="/images/guide_1_06.jpg"></a><span id="like_<?php echo $charter_id;?>"><?php echo $arrCharter['like_count'];?></span>/人点赞
      </div>
    <div class="clear"></div>
    </div>
    <?php if (count($arrCharter['classes']) > 0) {?>
    <ul id="charter_class_ul">
      <?php foreach($arrCharter['classes'] as $classesList) {?>
      <li data-price="<?php echo $classesList["price"];?>"><?php echo $classesList["title"];?></li>
      <?php } ?>
    <div class="clear"></div>
    </ul>
    <?php 
	}
	?>
    <div class="midd_84"><?php echo strtrunc(strip_tags($arrCharter['descr']), 300);?></div>
  </div>
<div class="clear"></div>
</div>
<?php 
}
?>

<?php 
if (count($arrPager) > 0) {
	
?>
<div id='pagina'>
	<?php 
		foreach($arrPager as $paper) {
	?>
    <a href='javascript:void(0);' onclick="searchFun('page', '<?php echo $paper["value"];?>');" 
    <?php if ($pageNum == $paper["text"]) { echo "class='number'";}?> ><?php echo $paper["text"];?></a>
    <?php 
	}
	?>
</div>
<?php 
}
?>
<!-- 底部 -->
<?php require_once 'foot.php';?>

<!-- jQuery --> 

<!-- jQuery Easing --> 
<script src="/js/jquery.easing.1.3.js"></script> 
<!-- Bootstrap --> 
<script src="/js/bootstrap.min.js"></script> 
<!-- Waypoints --> 
<script src="/js/jquery.waypoints.min.js"></script> 
<!-- Owl Carousel --> 
<script src="/js/owl.carousel.min.js"></script> 
<!-- Flexslider --> 
<script src="/js/jquery.flexslider-min.js"></script> 

<!-- MAIN JS --> 
<script src="/js/main.js"></script>

<!-- 导航 -->
<script>
$(function(){
  $(".sehun").click(function(){
	$(".navshow").slideToggle();
  });

  var charterClassList = jQuery('#charter_class_ul li');
  charterClassList.click(function(){
	  	charterClassList.removeClass('active');
		jQuery(this).addClass('active');
		var price = jQuery(this).data("price");
		
	});
	
});

function searchFun(id, value) {
	$("#" + id).val(value);
	$("#searchForm").submit();
}

function changeToGrid(url) {
	$("#searchForm").attr("action", url);
	$("#searchForm").submit();
}

function clickLike(charterId) {
	var data = {};
	data['<?php echo $hmWeb->token_name?>'] = '<?php echo $token?>';
	data['charter_id'] = charterId;
	$.ajax({
		type:'POST',
		url:"action.html?like=post",
		data:data,
		dataType:'json',
		success:function(data){
			if (data.result == "error") {
				alert('系统发送失败,请与客服联系。');
				return false;
			} else {
				if (data.like_result == "1") {
					$("#like_" + charterId).html(data.like_count);
				} else {
					alert('您已经点过赞了。');
					return false;
				}
				
			}
		},
		error:function(){
			alert('系统发送失败。');
		}
	});
}

</script>
</body>
</html>

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

?>
<!DOCTYPE html>
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
     <a href="javascript:void(0);" onclick="searchFun('order_by', 'book');"><?php if ($hmWeb->t("order_by", $arrParams) == "book") {?><span>销量</span><img src="/images/9_08.png"><?php } else {?>销量<img src="/images/9_10.png"><?php }?></a>
    </div>
    <div class="right">
    	<a href="javascript:void(0);" onclick="changeToGrid('guide.html');"><img src="images/7_10.png"><br>列表</a>
		<a href="javascript:void(0);" onclick="changeToGrid('guide_grid.html');"><img src="images/8_05.png"><br><span>网格</span></a>
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

<div class="midd_auto midd_top20">

<?php

$index = 0;
foreach($charterList as $i => $arrCharter){

	$charter_id = $arrCharter['id'];
	$charter_title = $arrCharter['title'];

	
	$min_price = 0;
	if ($charter_price > 0) {
		$min_price = $charter_price;
	}
	
	$index++;
?>
  <div class="midd_fff midd_87" <?php if ($index%3 == 0) {echo 'style="margin-right:0;"';}?> > <a href="guidexx.html?id=<?php echo $charter_id;?>" class="item-grid text-center" >
    <div class="image">
    	<?php 
  		if (empty($arrCharter['image_url'])) {
  		?>
  		<img src="images/guide_2_03.jpg">
  		<?php } else {?>
  		<img style="max-width: 360px;" src="<?php echo $arrCharter['image_url'];?>" alt="<?php echo $arrCharter['image_label'];?>">
  		<?php }?>
    </div>
    <div class="v-align midd_top35 midd_88">
      <div class="v-align-middle">
        <h3 class="title midd_tsize"><?php echo $charter_title;?></h3>
        <div class="midd_86">
          <div class="left"><span><?php echo $arrCharter['like_count'];?>人</span>赞 | <span><?php echo $arrCharter['book_count'];?>人</span>预约</div>
          <div class="right"><span><h2>￥</h2><h1><?php echo $arrCharter['max_price'];?></h1></span>/ 车</div>
        <div class="clear"></div>
        </div>
      </div>
    <div class="clear"></div>
    </div>
    </a>
    </div>
<?php 
}
?>
<div class="clear"></div>
</div>

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

function searchFun(id, value) {
	$("#" + id).val(value);
	$("#searchForm").submit();
}

function changeToGrid(url) {
	$("#searchForm").attr("action", url);
	$("#searchForm").submit();
}
</script>
</body>
</html>

<?php require_once 'coon.php';
$navid = 7;
$rs = $pdo->query("SELECT * FROM `pm_page` WHERE `lang` = '2' AND id = " . $navid);
$row = $rs->fetch();

$rs2 = $pdo->query("SELECT * FROM pm_article_file WHERE checked = 1 AND lang = 2 AND type = 'image' AND file != '' ORDER BY rank LIMIT 1");
$row2 = $rs2->fetch();
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
  body {
    background: #f7f7f7;
  }
  </style>
</head>
<body>
<div class="sehun"></div>
<?php require_once 'head.php'; ?>
<div class="container"> </div>
<aside id="fh5co-hero">
    <div style="background: url(images/gallery.jpg) no-repeat; background-position:center center; height:222px;">
          <div class="overlay-gradient"></div>
          <div class="container" style="height:222px;">
            <div class="col-md-offset-1 text-center js-fullheight slider-text">
              <div class="slider-text-inner midd_230s">
                <h2>旅游图库</h2>
                <p><span>春夏秋冬从南到北都，数不尽的风情</span></p>
              </div>
            </div>
          </div>
        <div class="clear"></div>
        </div>
      </aside>

<?php
$pageId = @$_GET['page'];
$rs = $pdo->query("SELECT * FROM pm_gallery where lang = 2 AND checked = 1 AND id = $pageId order by rank");
while ($row = $rs->fetch()) {
  $title = $row['title'];
  $publish_date = $row['publish_date'];
  $subtitle = $row['subtitle'];
  $text = $row['text'];
}
?>
<div class="midd_25">
  <div class="midd_26">
    <img src="images/11_03.png">
    <a href="index.html">首页</a> > 
    <a href="gallery.html">旅游图库</a> > 
    <a href="galleryxx_<?= $pageId ?>.html"><?php echo $title ?></a>
  </div>
</div>

<div class="midd_auto midd_top20 midd_fff" style="padding-bottom:20px;">
  <img src="<?php $rs1 = $pdo->query("SELECT * FROM pm_gallery_file WHERE id_item = " . $pageId . " order by rank asc");
                    $row1 = $rs1->fetch();
                    echo "/medias/gallery/medium/" . $row1['id'] . "/" . $row1['file'] ?>">
  <div class="midd_96">
    <h1><?php echo $title ?></h1>
    <span>发布时间：<?php echo date('Y/m/d', $publish_date) ?></span>
    <div class="midd_97"><?php echo $subtitle ?></div>
  </div>
  <div class="midd_center">
    <?php echo $text ?>
    <div class="clear">
  </div>
  <?php
    $rs1 = $pdo->query("SELECT * FROM pm_gallery_file WHERE id_item = " . $pageId . " order by rank asc");
    while ($row = $rs1->fetch()) {
  ?>
      <img src="<?php echo "/medias/gallery/medium/" . $row['id'] . "/" . $row['file'] ?>">
  <?php
    }
  ?>
</div>
</div>

<!-- 底部 -->
<?php require_once 'foot.php'; ?>

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

<?php require_once 'coon.php';
$navid = 25;
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
                  <h2>美溪商城</h2>
                  <p><span>享受旅行，享受购物</span></p>
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
?>
<div class="midd_25">
  <div class="midd_26"><img src="images/11_03.png"><a href="index.html">首页</a> > <a href="mail.html">美溪商城</a> > <a href="galleryxx_<?= $pageId ?>.html"><?php echo $title ?></a></div>
</div>


<div id="fh5co-work-section" class="fh5co-light-grey-section" style="padding:0;">
    <div class="container">
        <div class="midd_27">
            <div class="left midd_52">
                <div id="originalpic">
                    <?php
                    $rs1 = $pdo->query("SELECT * FROM pm_gallery_file WHERE lang = 2 and id_item = " . $row['id'] . " order by rank asc");
                    $i = 1;
                    while ($row1 = $rs1->fetch()) {
                        ?>
                        <li><a href="javascript:;"><img
                                    src="<?php echo "/medias/mall/medium/" . $row1['id'] . "/" . $row1['file'] ?>"<?php if ($i == 1){ ?>
                                    style="display: inline;"<?php } ?>></a></li>
                        <?php
                        $i++;
                    }
                    ?>
                    <a id="aPrev"
                       style="cursor: url(/images/prev.cur), auto; height: 600px;"></a>
                    <a id="aNext"
                       style="cursor: url(/images/next.cur), auto; height: 600px;"></a>
                </div>
                <div class="thumbpic"><a href="javascript:;" class="bntprev"></a>
                    <div id="piclist">
                        <ul>
                            <?php
                            $rs1 = $pdo->query("SELECT * FROM pm_gallery_file WHERE lang = 2 and id_item = " . $row['id'] . " order by rank asc");
                            $i = 1;
                            while ($row1 = $rs1->fetch()) {
                                ?>
                                <li<?php if ($i == 1){ ?> class="hover"<?php } ?>><a href="javascript:;"><img
                                            src="<?php echo "/medias/mall/medium/" . $row1['id'] . "/" . $row1['file'] ?>" width="120" height="86"></a></li>
                                <?php
                                $i++;
                            }
                            ?>
                        </ul>
                    </div>
                    <a href="javascript:;" class="bntnext"></a></div>
            </div>
            <div class="midd_28">
                <div class="midd_29"><?php echo $row['title']; ?></div>
                
                <div class="midd_37">
                  <span>￥5000</span>/每晚
                  <div class="right">
                    <span>推荐指数</span>
                    <span>
                      <?php for ($i = 1; $i <= 5; $i++) { ?>
                      <img src="images/10_10.png"><?php } ?>
                    </span>
                  </div>
                </div>
                <div class="midd_29">
                  <div class="midd_39" onclick="yd(6,3,2,'','',10)">
                        预定
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="midd_27">
            <div class="midd_30">详细</div>
            <?php echo $row['text'] ?>
        </div>
    </div>
    <div class="clear"></div>
</div>
<?php
}
?>

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
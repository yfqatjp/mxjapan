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
$rs = $pdo->query("SELECT * FROM pm_product where lang = 2 AND checked = 1 AND id = $pageId order by rank");
while ($row = $rs->fetch()) {
  $title = $row['title'];
  $publish_date = $row['publish_date'];
  $subtitle = $row['subtitle'];
?>
<div class="midd_25">
  <div class="midd_26"><img src="images/11_03.png"><a href="index.html">首页</a> > <a href="mall.html">美溪商城</a> > <a href="mallxx_<?= $pageId ?>.html"><?php echo $title ?></a></div>
</div>


<div id="fh5co-work-section" class="fh5co-light-grey-section" style="padding:0;">
    <div class="container">
        <div class="midd_27">
            <div class="left midd_52">
                <div id="originalpic">
                    <?php
                    $rs1 = $pdo->query("SELECT * FROM pm_product_file WHERE lang = 2 and id_item = " . $row['id'] . " order by rank asc");
                    $i = 1;
                    while ($row1 = $rs1->fetch()) {
                        ?>
                        <li><a href="javascript:;"><img
                                    src="<?php echo "/medias/product/medium/" . $row1['id'] . "/" . $row1['file'] ?>"<?php if ($i == 1){ ?>
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
                            $rs1 = $pdo->query("SELECT * FROM pm_product_file WHERE lang = 2 and id_item = " . $row['id'] . " order by rank asc");
                            $i = 1;
                            while ($row1 = $rs1->fetch()) {
                                ?>
                                <li<?php if ($i == 1){ ?> class="hover"<?php } ?>><a href="javascript:;"><img
                                            src="<?php echo "/medias/product/medium/" . $row1['id'] . "/" . $row1['file'] ?>" width="120" height="86"></a></li>
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
                
                <div>
                  <div style="float: left;">
                    <span style="display: flex;">
                        <span style="margin-top: 10px;">￥</span>
                        <span style="font-size: 40px;color: red;"><?php echo $row['price']; ?></span>
                        <span style="margin-top: 10px;">/万円</span>
                    </span>
                  </div>
                  <div class="right" style="margin-top: 20px;margin-bottom: 20px;">
                    <span>推荐指数</span>
                    <span>
                      <?php for ($i = 1; $i <= 5; $i++) { ?>
                      <img src="images/10_10.png"><?php } ?>
                    </span>
                  </div>
                </div>
            <div class="clear"></div>
                <div class="midd_29" style="display: flex;margin-top: 30px;">
                    <button style=" width: 180px;border-radius: 3px;margin: 0 auto;" type="button" class="btn btn-primary btn" data-toggle="modal" data-target="#myModal">
                      预定
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">确认订单</h4>
                          </div>
                          <div class="modal-body">
                            <form class="form-horizontal">
                              <div class="form-group">
                                <label for="telno" class="col-sm-3 control-label">手机号</label>
                                <div class="col-sm-7">
                                  <input type="telno" class="form-control" id="inputEmail3" placeholder="手机号">
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="weChatId" class="col-sm-3 control-label">微信号</label>
                                <div class="col-sm-7">
                                  <input type="wechatid" class="form-control" id="inputPassword3" placeholder="微信号">
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="name1" class="col-sm-3 control-label">尊称</label>
                                <div class="col-sm-7">
                                  <input type="name1" class="form-control" id="inputPassword3" placeholder="尊称">
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="number1" class="col-sm-3 control-label">数量</label>
                                <div class="col-sm-7">
                                  <input type="number1" class="form-control" id="inputPassword3" placeholder="数量">
                                </div>
                              </div>
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" style=" border-radius: 3px;" class="btn btn-default" data-dismiss="modal">关闭</button>
                            <button type="button" style=" border-radius: 3px;" class="btn btn-primary">确认提交</button>
                          </div>
                        </div>
                      </div>
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

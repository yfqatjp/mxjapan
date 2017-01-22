<?php require_once 'coon.php';
$navid = 10;
$rs = $pdo->query("SELECT * FROM `pm_page` WHERE `lang` = '2' AND id = " . $navid);
$row = $rs->fetch();

$rs2 = $pdo->query("SELECT * FROM pm_article_file WHERE checked = 1 AND lang = 2 AND type = 'image' AND file != '' ORDER BY rank LIMIT 1");
$row2 = $rs2->fetch();
?><!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
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
<?php require_once 'head.php';
$rs = $pdo->query("SELECT * FROM pm_realestate WHERE lang = 2 AND id = " . $_GET['id']);
$row = $rs->fetch(); ?>
<aside id="fh5co-hero">
    <div style="background: url(images/realestate.jpg) no-repeat; background-position:center center; height:222px;">
        <div class="overlay-gradient"></div>
        <div class="container" style="height:222px;">
            <div class="col-md-offset-1 text-center js-fullheight slider-text">
                <div class="slider-text-inner midd_230s">
                    <h2>不动产服务</h2>
                    <p><span>城市中心养生名宅</span></p>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</aside>

<div class="midd_25">
    <div class="midd_26"><img src="images/11_03.png"><a href="/index.html">首页</a> > <a href="/realestate.html">不动产服务</a> >
        <a href="realestatexx_x<?php echo $_GET['id'] ?>.html"><?php echo $row['title']; ?></a></div>
</div>

<div id="fh5co-work-section" class="fh5co-light-grey-section" style="padding:0;">
    <div class="container">
        <div class="midd_27">
            <div class="left midd_52">
                <div id="originalpic">
                    <?php
                    $rs1 = $pdo->query("SELECT * FROM pm_realestate_file WHERE lang = 2 and id_item = " . $row['id'] . " ");
                    $i = 1;
                    while ($row1 = $rs1->fetch()) {
                        ?>
                        <li><a href="javascript:;"><img
                                    src="<?php echo "/medias/realestate/medium/" . $row1['id'] . "/" . $row1['file'] ?>"<?php if ($i == 1){ ?>
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
                            $rs1 = $pdo->query("SELECT * FROM pm_realestate_file WHERE lang = 2 and id_item = " . $row['id'] . " ");
                            $i = 1;
                            while ($row1 = $rs1->fetch()) {
                                ?>
                                <li<?php if ($i == 1){ ?> class="hover"<?php } ?>"><a href="javascript:;"><img
                                            src="<?php echo "/medias/realestate/medium/" . $row1['id'] . "/" . $row1['file'] ?>" width="120" height="86"></a></li>
                                <?php
                                $i++;
                            }
                            ?>
                        </ul>
                    </div>
                    <a href="javascript:;" class="bntnext"></a></div>
            </div>
            <div class="midd_28">
                <div class="midd_29"><?php echo $row['title'] ?></div>
                <div class="midd_48">
                    <div class="left">
                        <div style="color:#e83744;">￥</div>
                        <h1><?php echo $row['jiage'] ?></h1>/ 万日元
                    </div>
                    <div class="right"><span style="float:left;
        font-size:14px; margin-right:5px;">推荐指数</span> <span><?php for ($i = 1; $i <= $row['num']; $i++) { ?><img
                        src="images/10_10.png"><?php } ?></span></div>
                    <div class="clear"></div>
                </div>
                <ul class="midd_49s">
                    <li><span>房龄：</span>
                        <div class="right"><?php echo $row['age'] ?></div>
                    </li>
                    <li><span>面积：</span>
                        <div class="right"><?php echo $row['dimension'] ?></div>
                    </li>
                    <li><span>所在层：</span>
                        <div class="right"><?php echo $row['level'] ?></div>
                    </li>
                    <li><span>交通：</span>
                        <div class="right"><?php echo $row['transportation'] ?></div>
                    </li>
                    <li><span>建筑结构：</span>
                        <div class="right"><?php echo $row['construction'] ?></div>
                    </li>
                    <li><span>管理费：</span>
                        <div class="right"><?php echo $row['managementcost'] ?></div>
                    </li>
                    <li><span>维护费：</span>
                        <div class="right"><?php echo $row['maintenancecost'] ?></div>
                    </li>
                    <li><span>设备：</span>
                        <div class="right">
                           <?php
                            $facility = explode("|", $row['facility']);
                            for ($i = 0; $i < count($facility); $i++) {
                                ?>
                                <div class="midd_132"><?php echo $facility[$i] ?></div>
                            <?php } ?>
                        </div>
                    </li>
                    <div class="clear"></div>
                </ul>
                <ul class="midd_49">
                    <li><a href="#"><img src="images/11_14.png"><?php echo $row['adress'] ?></a></li>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
        <div class="midd_27">
            <div class="midd_30">物件介绍</div>
            <p class="midd_93">
                <?php echo $row['text'] ?>
        </div>
    </div>
    <div class="clear"></div>
</div>

<?php require_once 'foot.php'; ?>

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
    $(function () {
        $(".sehun").click(function () {
            $(".navshow").slideToggle();
        });
    });
</script>
</body>
</html>

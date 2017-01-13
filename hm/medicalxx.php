<?php require_once 'coon.php';
$navid = 16;
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
</head>
<body>
<?php require_once 'head.php';
$rs = $pdo->query("SELECT * FROM pm_hospital WHERE lang = 2 AND id = " . $_GET['id']);
$row = $rs->fetch(); ?>

<aside id="fh5co-hero">
    <div style="background: url(images/medical.jpg) no-repeat; background-position:center center; height:222px;">
        <div class="overlay-gradient"></div>
        <div class="container" style="height:222px;">
            <div class="col-md-offset-1 text-center js-fullheight slider-text">
                <div class="slider-text-inner midd_230s">
                    <h2>海外医疗</h2>
                    <p><span>先进设备，为您健康保驾护航</span></p>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</aside>
<div class="midd_25">
    <div class="midd_26"><img src="images/11_03.png"><a href="index.html">首页</a> > <a href="medical.html">医疗</a> > <a
            href="medicalxx_x<?php echo $_GET['id'] ?>.html"><?php echo $row['title']; ?></a></div>
</div>

<div id="fh5co-work-section" class="fh5co-light-grey-section" style="padding:0;">
    <div class="container">
        <div class="midd_27">
            <div class="left midd_52">
                <div id="originalpic">
                    <?php
                    $rs1 = $pdo->query("SELECT * FROM pm_hospital_file WHERE lang = 2 and id_item = " . $row['id'] . " ");
                    $i = 1;
                    while ($row1 = $rs1->fetch()) {
                        ?>
                        <li><a href="javascript:;"><img
                                    src="<?php echo "/medias/hospital/medium/" . $row1['id'] . "/" . $row1['file'] ?>"<?php if ($i == 1){ ?>
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
                            $rs1 = $pdo->query("SELECT * FROM pm_hospital_file WHERE lang = 2 and id_item = " . $row['id'] . " ");
                            $i = 1;
                            while ($row1 = $rs1->fetch()) {
                                ?>
                                <li<?php if ($i == 1){ ?> class="hover"<?php } ?>"><a href="javascript:;"><img
                                            src="<?php echo "/medias/hospital/medium/" . $row1['id'] . "/" . $row1['file'] ?>" width="120" height="86"></a></li>
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
                <div class="midd_48"> <span style="float:left;
        font-size:14px; margin-right:5px;">推荐指数</span> <span><?php for ($i = 1; $i <= $row['num']; $i++) { ?><img
                            src="images/10_10.png"><?php } ?></span>
                    <div class="clear"></div>
                </div>
                <ul class="midd_49">
                    <li><span>诊疗科目：</span>
                        <div class="right"><?php echo $row['departments']; ?></div>
                    </li>
                    <li><span>病床数：</span>
                        <div class="right"><?php echo $row['beds']; ?></div>
                    </li>
                    <li><span>成立日：</span>
                        <div class="right"><?php echo $row['establishmentday']; ?></div>
                    </li>
                    <li><span>院长：</span>
                        <div class="right"><?php echo $row['yuan']; ?></div>
                    </li>
                </ul>
                <ul class="midd_49">
                    <li><a href="#"><img src="images/11_14.png"><?php echo $row['addres']; ?></a></li>
                    <li><a href="#"><img src="images/11_17.png"><?php echo $row['phone']; ?></a></li>
                    <li><a href="#"><img src="images/11_19.png"><?php echo $row['mail']; ?></a></li>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
        <div class="midd_27">
            <div class="midd_30">医院介绍</div>
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

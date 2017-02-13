<?php require_once 'coon.php';
$navid = 7;
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
<?php require_once 'head.php'; ?>
<div class="container"></div>
<aside id="fh5co-hero" class="js-fullheight">
    <div class="flexslider js-fullheight">
        <ul class="slides">
            <li style="background: url(images/gallery.jpg) no-repeat; background-position:center center;">
                <div class="overlay-gradient"></div>
                <div class="container">
                    <div class="col-md-10 col-md-offset-1 text-center js-fullheight slider-text">
                        <div class="slider-text-inner midd_230ss">
                            <h2>旅游图库</h2>
                            <p><span>春夏秋冬从南到北都，数不尽的风情</span></p>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</aside>

<!-- 内容 -->
<div class="midd_auto midd_top20">
<?php
$perNumber = 6;
$page = @$_GET['page'];
$count = $pdo->query("SELECT * FROM pm_hospital WHERE lang = 2 AND checked = 1 ORDER by rank");
$totalNumber = $count->rowCount();
$totalPage = ceil($totalNumber / $perNumber);
if (!isset($page)) {
    $page = 1;
}
$startCount = ($page - 1) * $perNumber;
$rs = $pdo->query("SELECT * FROM pm_hospital where lang = 2 AND checked = 1 order by rank limit $startCount,$perNumber");
while ($row = $rs->fetch()) {
    ?>
    <div class="midd_95"><a href="galleryxx.html" class="item-grid text-center">
            <div class="image"><img src="images/gallery_1_03.jpg"></div>
            <div class="v-align midd_top35 midd_88">
                <div class="v-align-middle">
                    <h3 class="title midd_tsize">最美富士山</h3>
                    <div class="midd_94">富士山，是日本国内最高峰，日本重要国家象征之一。横跨静冈县和山梨县的活火山…….</div>
                </div>
                <div class="clear"></div>
            </div>
        </a></div>
<?php } ?>

    <div class="clear"></div>
</div>
<div id='pagina'>
    <?php
    if ($page - 1 > 0) {
        ?>
        <a href="medical_<?php echo $page - 1 ?>.html">上一页</a>
        <?php
    }
    if ($page == $totalPage&& $page == 1) {
        echo "<a class='number'>1</a>";
    } else {
        if ($page - 2 > 0) {
            ?>
            <a href="medical_<?php echo $page - 2 ?>.html"><?php echo $page - 2 ?></a>
            <?php
        }
        if ($page - 1 > 0) {
            ?>
            <a href="medical_<?php echo $page - 1 ?>.html"><?php echo $page - 1 ?></a>
            <?php
        }

        if ($totalPage > 5) {
            if ($totalPage - 2 >= $page) {
                $total = $page + 2;
            } else {
                $total = $totalPage;
            }
        } else {
            $total = $totalPage;
        }
        for ($i = $page; $i <= @$total; $i++) {
            if ($page == $i) {
                echo '<a class="number">' . $i . '</a>';
            } else { ?>
                <a href="medical_<?= $i ?>.html"><?= $i ?></a>
                <?php
            }
        }
    }
    if ($page + 1 <= $totalPage) {
        ?>
        <a href="medical_<?= $page + 1 ?>.html">下一页</a>
    <?php } ?>
</div>

<?php require_once 'foot.php'; ?>
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
    $(function () {
        $(".sehun").click(function () {
            $(".navshow").slideToggle();
        });
    });
</script>
</body>
</html>

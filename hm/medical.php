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
    <style>
        body {
            background: #f7f7f7;
        }
    </style>
</head>
<body>
<?php require_once 'head.php'; ?>

<aside id="fh5co-hero" class="js-fullheight">
    <div class="flexslider js-fullheight">
        <ul class="slides">
            <li style="background: url(images/medical.jpg) no-repeat; background-position:center center;">
                <div class="overlay-gradient"></div>
                <div class="container">
                    <div class="col-md-10 col-md-offset-1 text-center js-fullheight slider-text">
                        <div class="slider-text-inner midd_230ss">
                            <h2>海外医疗</h2>
                            <p><span>先进设备，为您健康保驾护航</span></p>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</aside>

<!-- 内容 -->
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
    <div class="midd_auto midd_fff midd_top20 midd_91"><a href="medicalxx_x<?= $row['id'] ?>.html">
            <div class="image"><img
                    src="<?php $rs1 = $pdo->query("SELECT * FROM pm_hospital_file WHERE id_item = " . $row['id'] . " order by rank asc");
                    $row1 = $rs1->fetch();
                    echo "/medias/hospital/medium/" . $row1['id'] . "/" . $row1['file'] ?>" width="100%"></div>
            <div class="midd_92">
                <div class="midd_20"><?php echo $row['title'] ?></div>
                <div class="midd_21"><span>推荐指数</span><?php for ($i = 1; $i <= $row['num']; $i++) { ?><img
                        src="images/10_10.png"><?php } ?></div>
                <div class="clear"></div>
                <div class="midd_22">
                    <?php echo strtrunc(strip_tags($row['text']), 550)  ?>
                </div>
                <div class="midd_21"><img src="images/10_14.png"><span
                        class="midd_23"><?php echo $row['addres'] ?></span>
                </div>
                <div class="midd_21"><img src="images/medical_1_06.jpg"><span
                        class="midd_23"><?php echo $row['phone'] ?></span></div>
            </div>
            <div class="clear"></div>
        </a></div>
<?php } ?>

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

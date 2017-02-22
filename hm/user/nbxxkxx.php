<?php require_once '../coon.php';
if (@$_SESSION['userid'] == "") {
    header("Location: /signin.html");
    exit;
}
$_SESSION['formcode'] = rfc_encode(mt_rand(0, 1000000));
$txt = "内部信息库";
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
    <script src="../js/lrzj1.js"></script>
    <script src="../js/jquery.flexslider-min.js"></script>
    <script>
        $(function () {
            $('.flexslider131').flexslider({
                directionNav: true,
                pauseOnAction: false
            });
        });
    </script>
</head>
<body>
<div class="sehun"></div>
<?php require_once '../head.php';
$rs = $pdo->query("SELECT * FROM pm_notice WHERE lang = 2 AND id = " . $_GET['id']);
$row = $rs->fetch();
?>

<div class="midd_26"><img src="../images/11_03.png"><a href="/index.html">首页</a> > <a href="index.html">个人中心</a> > <a
        href="nbxxk.html">内部信息库</a> > <a href="nbxxkxx_x<?php $_GET['id'] ?>.html"><?php echo $row['title']; ?></a>
</div>

<div class="midd_auto user">
    <!-- 左侧导航 -->
    <?php $nleft = 6;
    require_once 'left.php';
    ?>
    <!-- 右侧 -->
    <div class="user_4">
        <div class="midd_68"><span>内部信息库</span></div>
        <div class="user_18">
            <h1><?php echo $row['title'] ?></h1>
            <span>类别：<?php
                $rs1 = $pdo->query("SELECT * FROM pm_category WHERE id = " . $row['category']);
                $row1 = $rs1->fetch();
                echo $row1['category'];
                ?> &nbsp;&nbsp;&nbsp;&nbsp;发布日期：<?php echo date("Y-m-d", $row['add_date']); ?></span>
        </div>
        <?php
            $rs1 = $pdo->query("SELECT * FROM pm_notice_file WHERE lang = 2 AND id_item = " . $row['id'] . " ORDER BY rank ASC");
            if ($rs1->rowCount() >= 1) {?>
        <div class="flexslider131">
            <ul class="slides">
                <?php
                    $i = 1;
                    while ($row1 = $rs1->fetch()) {
                        ?>
                        <li><img src="<?php echo "/medias/notice/medium/" . $row1['id'] . "/" . $row1['file'] ?>"></li>
                        <?php
                        $i++;
                    }
                    ?>
            </ul>
        </div>
        <?php }?>
        <div class="user_19 midd_top20">
            <?php echo $row['text']; ?>
        </div>
    </div>
    <div class="clear"></div>
</div>

<div class="midd_top20"></div>
<?php require_once '../foot.php'; ?>

<!-- jQuery Easing -->
<script src="../js/jquery.easing.1.3.js"></script>
<!-- Bootstrap -->
<script src="../js/bootstrap.min.js"></script>
<!-- Waypoints -->
<script src="../js/jquery.waypoints.min.js"></script>
<!-- Owl Carousel -->
<script src="../js/owl.carousel.min.js"></script>
<!-- Flexslider -->
<script src="../js/jquery.flexslider-min.js"></script>

<!-- MAIN JS -->
<script src="../js/main.js"></script>

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

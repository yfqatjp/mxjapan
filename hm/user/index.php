<?php require_once '../coon.php';
if (@$_SESSION['userid'] == "") {
    header("Location: /signin.html");
    exit;
}
$txt = "用户中心";
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
<div class="sehun"></div>
<?php require_once '../head.php';
?>

<div class="midd_26"><img src="../images/11_03.png"><a href="/index.html">首页</a> > <a href="index.html">个人中心</a></div>

<div class="midd_auto user">
    <!-- 左侧导航 -->
    <?php require_once 'left.php'; ?>
    <!-- 右侧 -->
    <div class="user_4">
        <div class="user_5">
            <a href="jddd.html" class="user_6" style="margin-left:0;">酒店订单</a>
            <a href="bcdd.html" class="user_7">包车订单</a>
            <a href="grxx.html" class="user_8" style="margin-left:0;">个人信息</a>
            <a href="txsz.html" class="user_9">头像设置</a>
            <div class="clear"></div>
        </div>
        <div class="midd_107 midd_top20">
            <div class="left">内部信息库</div>
            <div class="right"><a href="nbxxk.html">查看更多>></a></div>
        </div>
        <?php $rs = $pdo->query("SELECT * FROM pm_notice WHERE lang = 2 AND checked = 1 ORDER BY id DESC LIMIT 0,6");
        while ($row = $rs->fetch()) {
            ?>
            <div class="user_10"><a href="nbxxkxx_x<?php echo $row['id']?>.html">
                    <div class="left" style="width: 25%; height: 100px;overflow: hidden;"><img
                            src="<?php $rs1 = $pdo->query("SELECT * FROM pm_notice_file WHERE id_item = " . $row['id'] . " ORDER BY rank DESC");
                            $row1 = $rs1->fetch();
                            echo "/medias/notice/medium/" . $row1['id'] . "/" . $row1['file'] ?>" width="100%"></div>
                    <div class="user_11" style="width: 72%;margin-left:3%">
                        <h2><?php echo $row['title'] ?></h2>
                        <h3>
                            <?php echo strtrunc(strip_tags($row['text']),370); ?></h3>
                        <span>类别：<?php
                            $rs1 = $pdo->query("SELECT * FROM pm_category WHERE id = " . $row['category']);
                            $row1 = $rs1->fetch();
                            echo $row1['category'];
                            ?>&nbsp; |&nbsp; 发布日期：<?php echo date("Y-m-d",$row['add_date']);?></span>
                    </div>
                    <div class="clear"></div>
                </a></div>

        <?php } ?>
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

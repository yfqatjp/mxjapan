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

<div class="midd_26"><img src="../images/11_03.png"><a href="/index.html">首页</a> > <a href="user.html">个人中心</a></div>

<div class="midd_auto user">
    <!-- 左侧导航 -->
    <?php require_once 'left.php';?>
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
            <div class="right"><a href="3-1nbxxk.html">查看更多>></a></div>
        </div>
        <div class="user_10"><a href="3-1nbxxkxx.html">
                <div class="left"><img src="../images/user_20.jpg"></div>
                <div class="user_11">
                    <h2>一路向北 “十面霾伏”的城市都是一个样</h2>
                    <h3>
                        面对今年冬天以来最为严重的区域性重污染天气，北京、天津、河北等地的数十个城市拉响了“警报”，142万平方公里国土遭“十面霾伏”。面对今年冬天以来最为严重的区域性重污染天气，北京、天津、河北等地的数十个城市拉响了“警报”，142万平方公里国土遭“十面霾伏”。</h3>
                    <span>类别：旅游&nbsp; |&nbsp; 发布日期：2016-02-03</span>
                </div>
                <div class="clear"></div>
            </a></div>
        <div class="user_10"><a href="3-1nbxxkxx.html">
                <div class="left"><img src="../images/user_20.jpg"></div>
                <div class="user_11">
                    <h2>一路向北 “十面霾伏”的城市都是一个样</h2>
                    <h3>
                        面对今年冬天以来最为严重的区域性重污染天气，北京、天津、河北等地的数十个城市拉响了“警报”，142万平方公里国土遭“十面霾伏”。面对今年冬天以来最为严重的区域性重污染天气，北京、天津、河北等地的数十个城市拉响了“警报”，142万平方公里国土遭“十面霾伏”。</h3>
                    <span>类别：旅游&nbsp; |&nbsp; 发布日期：2016-02-03</span>
                </div>
                <div class="clear"></div>
            </a></div>
        <div class="user_10"><a href="3-1nbxxkxx.html">
                <div class="left"><img src="../images/user_20.jpg"></div>
                <div class="user_11">
                    <h2>一路向北 “十面霾伏”的城市都是一个样</h2>
                    <h3>
                        面对今年冬天以来最为严重的区域性重污染天气，北京、天津、河北等地的数十个城市拉响了“警报”，142万平方公里国土遭“十面霾伏”。面对今年冬天以来最为严重的区域性重污染天气，北京、天津、河北等地的数十个城市拉响了“警报”，142万平方公里国土遭“十面霾伏”。</h3>
                    <span>类别：旅游&nbsp; |&nbsp; 发布日期：2016-02-03</span>
                </div>
                <div class="clear"></div>
            </a></div>
    </div>
    <div class="clear"></div>
</div>

<div class="midd_top20"></div>
<?php require_once '../foot.php'; ?>
<!-- jQuery -->

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

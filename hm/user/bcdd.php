<?php require_once '../coon.php';
if (@$_SESSION['userid'] == "") {
    header("Location: /signin.html");
    exit;
}
$txt = "包车订单";
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
    <script src="../js/common3.js"></script>
</head>
<body>
<div class="sehun"></div>
<?php require_once '../head.php';
?>

<div class="midd_26"><img src="../images/11_03.png"><a href="/index.html">首页</a> > <a href="/user">个人中心</a> > <a
        href="bcdd.html">包车订单</a></div>

<div class="midd_auto user">
    <!-- 左侧导航 -->
    <?php $nleft = 2;
    require_once 'left.php';
    ?>
    <!-- 右侧 -->
    <div class="user_4">
        <div class="midd_68"><span>包车订单</span></div>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="user_13">
            <tr class="user_14">
                <td width="34%" style="padding-left:10px;">商品</td>
                <td width="15%" align="center">订单价格</td>
                <td width="18%" align="center">订单日期</td>
                <td width="15%" align="center">订单状态</td>
                <td width="18%" align="center">订单操作</td>
            </tr>
            <tr>
                <td><img src="../images/user_20.jpg" width="80" height="67"><span class="user_16">大阪丽思卡尔顿 大床房</span>
                </td>
                <td align="center" class="user_15">1595元</td>
                <td align="center">2016-10-10 15:23</td>
                <td align="center" class="user_15">等待付款</td>
                <td align="center"><a href="payment.html">立即付款</a></td>
            </tr>
            <tr>
                <td><img src="../images/user_20.jpg" width="80" height="67"><span class="user_16">大阪丽思卡尔顿 大床房</span>
                </td>
                <td align="center" class="user_15">1595元</td>
                <td align="center">2016-10-10 15:23</td>
                <td align="center">已完成</td>
                <td align="center">&nbsp;</td>
            </tr>
            <tr>
                <td><img src="../images/user_20.jpg" width="80" height="67"><span class="user_16">大阪丽思卡尔顿 大床房</span>
                </td>
                <td align="center" class="user_15">1595元</td>
                <td align="center">2016-10-10 15:23</td>
                <td align="center">已取消</td>
                <td align="center">&nbsp;</td>
            </tr>
            <tr>
                <td><img src="../images/user_20.jpg" width="80" height="67"><span class="user_16">大阪丽思卡尔顿 大床房</span>
                </td>
                <td align="center" class="user_15">1595元</td>
                <td align="center">2016-10-10 15:23</td>
                <td align="center" class="user_15">等待付款</td>
                <td align="center"><a href="payment.html">立即付款</a></td>
            </tr>
            <tr>
                <td><img src="../images/user_20.jpg" width="80" height="67"><span class="user_16">大阪丽思卡尔顿 大床房</span>
                </td>
                <td align="center" class="user_15">1595元</td>
                <td align="center">2016-10-10 15:23</td>
                <td align="center">已完成</td>
                <td align="center">&nbsp;</td>
            </tr>
            <tr>
                <td><img src="../images/user_20.jpg" width="80" height="67"><span class="user_16">大阪丽思卡尔顿 大床房</span>
                </td>
                <td align="center" class="user_15">1595元</td>
                <td align="center">2016-10-10 15:23</td>
                <td align="center">已取消</td>
                <td align="center">&nbsp;</td>
            </tr>
        </table>
        <div class="sehun_6">
            <img src="../images/user_20.jpg">
            <div class="sehun_7">
                <h1>大阪丽思卡尔顿 大床房</h1>
                <span class="sehun_8">1595元</span>
                <span class="sehun_9">2016-10-10 15:23</span>
                <span class="sehun_8">等待付款</span>
                <a href="payment.html">立即付款</a>
            </div>
            <div class="clear"></div>
        </div>
        <div class="sehun_6">
            <img src="../images/user_20.jpg">
            <div class="sehun_7">
                <h1>大阪丽思卡尔顿 大床房</h1>
                <span class="sehun_8">1595元</span>
                <span class="sehun_9">2016-10-10 15:23</span>
                <span class="sehun_9">已完成</span>
            </div>
            <div class="clear"></div>
        </div>
        <div class="sehun_6">
            <img src="../images/user_20.jpg">
            <div class="sehun_7">
                <h1>大阪丽思卡尔顿 大床房</h1>
                <span class="sehun_8">1595元</span>
                <span class="sehun_9">2016-10-10 15:23</span>
                <span class="sehun_9">已取消</span>
            </div>
            <div class="clear"></div>
        </div>
        <div class="sehun_6">
            <img src="../images/user_20.jpg">
            <div class="sehun_7">
                <h1>大阪丽思卡尔顿 大床房</h1>
                <span class="sehun_8">1595元</span>
                <span class="sehun_9">2016-10-10 15:23</span>
                <span class="sehun_8">等待付款</span>
                <a href="payment.html">立即付款</a>
            </div>
            <div class="clear"></div>
        </div>
        <div class="sehun_6">
            <img src="../images/user_20.jpg">
            <div class="sehun_7">
                <h1>大阪丽思卡尔顿 大床房</h1>
                <span class="sehun_8">1595元</span>
                <span class="sehun_9">2016-10-10 15:23</span>
                <span class="sehun_9">已完成</span>
            </div>
            <div class="clear"></div>
        </div>
        <div class="sehun_6">
            <img src="../images/user_20.jpg">
            <div class="sehun_7">
                <h1>大阪丽思卡尔顿 大床房</h1>
                <span class="sehun_8">1595元</span>
                <span class="sehun_9">2016-10-10 15:23</span>
                <span class="sehun_9">已取消</span>
            </div>
            <div class="clear"></div>
        </div>
        <div id='pagina'>
            <a href='?tab=0&page=1'>上一页</a>
            <a href='?tab=0&page=1' class='number'>1</a>
            <a href='?tab=0&page=2'>2</a>
            <a href='?tab=0&page=3'>3</a>
            <a href='?tab=0&page=4'>4</a>
            <a href='?tab=0&page=5'>5</a>
            <a href='?tab=0&page=6'>6</a> &nbsp;
            ... <a href='?tab=0&page=22'>22</a>
            <a href='?tab=0&page=2'>下一页</a>
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

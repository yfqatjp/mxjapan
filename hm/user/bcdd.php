<?php require_once '../coon.php';
if (@$_SESSION['userid'] == "") {
    header("Location: /signin.html");
    exit;
}
$_SESSION['formcode'] = rfc_encode(mt_rand(0, 1000000));
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

<!-- 底部 -->
<footer id="fh5co-footer" role="contentinfo" class="midd_top20">
    <div class="container">
        <div class="midd_10 col-sm-push-0 col-xs-push-0">
            <h3>关于我们</h3>
            <p>美溪传媒車友倶楽部成立于2016年8月1日，是在日本东京投资注册的独立法人公司。<br>公司专致于提供日本境内旅游业务，为外国游客提供餐饮和娱乐服务，</p>
            <p><a href="#" class="btn btn-primary btn-outline with-arrow btn-sm">联系我们<i
                        class="icon-arrow-right"></i></a></p>
        </div>
        <div class="col-md-6 col-md-push-1 col-sm-12 col-sm-push-0 col-xs-12 col-xs-push-0">
            <ul class="float">
                <h3>联系方式</h3>
                <span>美溪车友传媒俱乐部</span>
                <li><a href="#"><img src="../images/6_03.png">東京都世田谷区玉川2-15-12</a></li>
                <li><a href="#"><img src="../images/6_07.png">090-0000-0000</a></li>
                <li><a href="#"><img src="../images/6_10.png">090-0000-0000</a></li>
                <li><a href="#"><img src="../images/6_13.png">090-0000-0000</a></li>
                <li><a href="#"><img src="../images/6_17.png">contact@meixinpo.com</a></li>
            </ul>
            <div class="midd_65"><h3>微信公众号</h3><img src="../images/17_03.jpg"></div>
        </div>
        <div class="clear"></div>
        <div class="midd_11">
            © 2016 美溪车友传媒俱乐部 All rights reserved
        </div>
    </div>
</footer>

<!-- 返回顶部 -->
<div id="top"><img src="../images/top.png"></div>
<script>
    $('#top').click(function () {
        $('html,body').animate({scrollTop: '0px'}, 800);
        return false;
    });
</script>
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

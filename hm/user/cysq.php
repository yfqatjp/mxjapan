<?php require_once '../coon.php';
if (@$_SESSION['userid'] == "") {
    header("Location: /signin.html");
    exit;
}
$_SESSION['formcode'] = rfc_encode(mt_rand(0, 1000000));
$txt = "酒店订单";
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

<div class="midd_26"><img src="../images/11_03.png"><a href="/index.html">首页</a> > <a href="/user">个人中心</a> > <a
        href="cysq.html">车友申请</a></div>

<div class="midd_auto user">
    <!-- 左侧导航 -->
    <?php $nleft = 7;
    require_once 'left.php';
    ?>
    <!-- 右侧 -->
    <div class="user_4">
        <div class="midd_68"><span>车友申请</span></div>
        <div class="user_21">您申请车友成功！</div>
        <div class="user_22">美溪车友申请</div>
        <div class="user_20 midd_top45">
            <span>*姓名：</span>
            <div class="left">
                <input type="text" name="textfield" class="input_13">
            </div>
            <div class="clear"></div>
        </div>
        <div class="user_20">
            <span>*在当地年限：</span>
            <div class="left">
                <input type="text" name="textfield" class="input_13">
                <i>年</i>
            </div>
            <div class="clear"></div>
        </div>
        <div class="user_20">
            <span>*手机号码：</span>
            <div class="left">
                <input type="text" name="textfield" class="input_13">
            </div>
            <div class="clear"></div>
        </div>
        <div class="user_20">
            <span>支付宝帐号：</span>
            <div class="left">
                <input type="text" name="textfield" class="input_13">
            </div>
            <div class="clear"></div>
        </div>
        <div class="user_20">
            <span>*身份证号：</span>
            <div class="left">
                <input type="text" name="textfield" class="input_13">
            </div>
            <div class="clear"></div>
        </div>
        <div class="user_20">
            <span>*驾驶证：</span>
            <div class="left">
                <input type="submit" name="button" class="input_18" value="选择文件">
            </div>
            <div class="clear"></div>
        </div>
        <div class="user_20">
            <span>证件照：</span>
            <div class="left">
                <input type="submit" name="button" class="input_18" value="选择文件">
                <i>护照、中国身份证、居住证、学生证、领队证或者导游证</i>
            </div>
            <div class="clear"></div>
        </div>
        <div class="user_20">
            <span>个人照、风景、美食、游客合影：</span>
            <div class="left">
                <input type="submit" name="button" class="input_18" value="选择文件">
                <i>至少有一张是车前与车合影</i>
            </div>
            <div class="clear"></div>
        </div>
        <div class="user_20">
            <span>*介绍自己：</span>
            <div class="left">
                <textarea name="textarea" class="input_19"></textarea>
            </div>
            <div class="clear"></div>
        </div>
        <div class="user_20">
            <span>*朋友对您的评价：</span>
            <div class="left">
                <textarea name="textarea" class="input_19"></textarea>
            </div>
            <div class="clear"></div>
        </div>
        <div class="user_20">
            <span>为什么来到这座城市：</span>
            <div class="left">
                <textarea name="textarea" class="input_19"></textarea>
            </div>
            <div class="clear"></div>
        </div>
        <input type="submit" name="button" class="input_14" value="确认">
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

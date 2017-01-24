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

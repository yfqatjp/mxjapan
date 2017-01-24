<?php require_once '../coon.php';
if (@$_SESSION['userid'] == "") {
    header("Location: /signin.html");
    exit;
}
$_SESSION['formcode'] = rfc_encode(mt_rand(0, 1000000));
$txt = "个人信息";
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

    <script src="/js/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/js/validationEngine.jquery.css"/>
    <script type="text/javascript" src="/js/jquery.validationEngine-zh_CN.js"></script>
    <script type="text/javascript" src="/js/jquery.validationEngine.js"></script>
    <script>
        $(function () {
            if ($('#form').size() > 0) {
                jQuery('#form').validationEngine({
                    showOneMessage: true,
                    addPromptClass: "formError-white",
                    promptPosition: 'topLeft'
                })
            }
        })
    </script>
</head>
<body>
<div class="sehun"></div>
<?php require_once '../head.php';
?>

<div class="midd_26"><img src="../images/11_03.png"><a href="/index.html">首页</a> > <a href="/user">个人中心</a> > <a
        href="grxx.html">个人信息</a></div>

<div class="midd_auto user">
    <!-- 左侧导航 -->
    <?php $nleft = 3;
    require_once 'left.php';
    ?>
    <!-- 右侧 -->
    <form action="/do?id=xg" method="post" name="form" id="form">
        <input type="hidden" name="formcode" value="<?php echo $_SESSION['formcode'] ?>">
        <div class="user_4">
            <div class="midd_68"><span>个人信息</span></div>
            <div class="user_17 midd_top55">
                <span>用户名：</span><?php echo $rou['email'] ?>
                <div class="clear"></div>
            </div>
            <div class="user_17">
                <span>昵称：</span>
                <input type="text" name="xname" value="<?php echo $rou['xname'] ?>" class="input_13">
                <div class="clear"></div>
            </div>
            <div class="user_17">
                <span>真实姓名：</span>
                <input type="text" name="name" data-validation-engine="validate[required]"
                       value="<?php echo $rou['name'] ?>" class="input_13">
                <div class="clear"></div>
            </div>
            <div class="user_17">
                <span>手机号：</span>
                <input type="text" name="phone" data-validation-engine="validate[required]"
                       value="<?php echo $rou['phone'] ?>" class="input_13">
                <div class="clear"></div>
            </div>
            <input type="submit" name="button" class="input_14" value="确认">
        </div>
        <div class="clear"></div>
    </form>
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

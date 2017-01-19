<?php require_once 'coon.php';
$_SESSION['formcode'] = rfc_encode(mt_rand(0, 1000000));
if (@$_SESSION['userid'] == "") {
    header("Location: /signin.html");
    exit;
}
$rs = $pdo->query("SELECT * FROM pm_gwc WHERE uid = " . $_SESSION['userid'] . " AND onum IS NULL and tai = 0");
if ($rs->rowCount() == 0) {
    header("Location: /user/jddd.html");
    exit;
}

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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>支付确认 <?php echo constant("SITE_TITLE"); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="支付确认"/>
    <meta itemprop="name" content="支付确认">
    <meta itemprop="description" content="支付确认">

    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content="支付确认"/>
    <meta property="og:url" content="<?php echo url(1) ?>"/>
    <meta property="og:site_name" content="<?php echo constant("SITE_TITLE"); ?>"/>
    <meta property="og:description" content="支付确认"/>

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="支付确认">
    <meta name="twitter:description" content="支付确认">
    <meta name="twitter:creator" content="@author_handle">

    <link rel="icon" type="image/png" href="/templates/default/images/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,700" rel="stylesheet">

    <!-- Animate.css -->
    <link rel="stylesheet" href="/css/animate.css">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="/css/icomoon.css">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="/css/bootstrap.css">
    <!-- Flexslider  -->
    <link rel="stylesheet" href="/css/flexslider.css">
    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/css/owl.theme.default.min.css">
    <!-- Theme style  -->
    <link rel="stylesheet" href="/css/style.css">

    <!-- Modernizr JS -->
    <script src="/js/modernizr-2.6.2.min.js"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="/js/respond.min.js"></script>
    <![endif]-->
    <script src="/js/jquery.min.js"></script>
    <style>
        body {
            background: #f7f7f7;
        }
    </style>
</head>
<body>
<div class="sehun"></div>

<?php require_once 'head.php'; ?>

<div class="midd_26"><img src="images/11_03.png"><a href="index.html">首页</a> > <a href="/user">个人中心</a> > <a
        href="payment.html">确认订单</a></div>
<div class="midd_67">
    <div class="midd_68"><span>预定信息</span></div>
    <form name="form" id="form" method="post" action="do?pay=post">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="midd_69">
            <tr class="midd_70">
                <td width="32%" style="padding-left:10px;">商品</td>
                <td width="14%" align="center">成人</td>
                <td width="14%" align="center">儿童</td>
                <td width="20%" align="center">备注</td>
                <td width="20%" align="center">小计</td>
            </tr>
            <?php
            $jia = 0;
            $id = 0;
            $rs = $pdo->query("SELECT * FROM pm_gwc WHERE uid = " . $_SESSION['userid'] . " AND onum IS NULL");
            while ($row = $rs->fetch()) {
                $rs1 = $pdo->query("SELECT * FROM pm_hotel WHERE id = " . $row['hotels'] . " AND lang = 2");
                $row1 = $rs1->fetch();
                $rs2 = $pdo->query("SELECT * FROM pm_room WHERE id = " . $row['room'] . " AND lang = 2");
                $row2 = $rs2->fetch();
                $jia = $jia + $row2['price']; ?>
                <tr>
                    <td style="padding-left:10px;"><img
                            src="<?php $rs3 = $pdo->query("SELECT * FROM pm_hotel_file WHERE id_item = " . $row1['id']);
                            $row3 = $rs3->fetch();
                            echo "/medias/hotel/medium/" . $row3['id'] . "/" . $row3['file'] ?>" width="80" height="67">
                        <p><span><?php echo $row1['title'] ?></span><br><?php echo $row2['title'] ?></p></td>
                    <td align="center"><?php echo $row['adults'] ?>人</td>
                    <td align="center"><?php echo $row['children'] ?>人</td>
                    <td align="center"><?php echo $row['text'] ?></td>
                    <td align="center"><span><?php echo $row2['price'] ?>元</span></td>
                </tr>
                <?php
                $id = $row['id'];
            }
            $_SESSION['wxjia'] = $jia;
            $_SESSION['wxid'] = $id;
            $rs = $pdo->query("SELECT * FROM pm_user WHERE id = " . $_SESSION['userid']);
            $row = $rs->fetch(); ?>
        </table>
        <div class="midd_68"><span>支付方式</span></div>
        <div class="midd_73">
            <div class="midd_71 active" onclick="$('.pay').html('客服致电确认预约信息').val(0);$('.zf').hide();$('.zf2').show();">
                <h1>只预约</h1>
                <span>客服致电确认预约信息</span></div>
            <div class="midd_71 sehun_2"
                 onclick="$('.pay').html('支付方式：支付宝支付').val(1);$('.zf').hide();$('.zf2').show();"><img
                    src="images/18_07.png">
            </div>
            <div class="midd_71" onclick="$('.pay').html('支付方式：微信支付').val(2);$('.zf').show();$('.zf2').hide();"><img
                    src="images/18_09.png"></div>
            <div class="midd_71 sehun_2"
                 onclick="$('.pay').html('支付方式：PayPal支付').val(3);$('.zf').hide();$('.zf2').show();"><img
                    src="images/18_11.png">
            </div>
            <div class="clear"></div>
        </div>
        <script type="text/javascript">
            jQuery(function () {
                var list = jQuery('.midd_71');
                list.click(function () {
                    list.removeClass('active');
                    jQuery(this).addClass('active');
                });
            });
        </script>
        <div class="midd_74">
            <ul>
                <li>客户姓名：<?php echo $row['name'] ?></li>
                <li>客户电话：<?php echo $row['phone'] ?></li>
                <li class="pay">客服致电确认预约信息</li>
            </ul>
            <div class="midd_75">订单金额：<span>￥<?php echo $jia ?></span></div>
            <div class="clear"></div>
        </div>
        <input type="hidden" name="pay" class="pay" value="0">
        <input type="hidden" name="lid" value="<?php echo $id ?>">
        <input type="hidden" name="price" value="<?php echo $jia ?>">
        <div class="zf2">
            <input type="submit" name="button" class="midd_76" value="确认订单">
        </div>
        <iframe src="/pay/WxpayAPI_php_v3/example/native.php" name="ad" marginwidth="1" width="200" height="200"
                marginheight="1" align="middle" scrolling="No" frameborder="0" id="ad" class="zf"
                style="display: none;float: right;"></iframe>
        <div class="clear"></div>
    </form>
</div>

<?php require_once 'foot.php'; ?>

<!-- 产品图片 -->
<script src="js/slider.photo.js"></script>

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

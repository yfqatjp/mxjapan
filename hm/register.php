<?php require_once 'coon.php';
$_SESSION['formcode'] = rfc_encode(mt_rand(0, 1000000));
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
    <title>注册 <?php echo constant("SITE_TITLE"); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="注册"/>
    <meta itemprop="name" content="注册">
    <meta itemprop="description" content="注册">

    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content="注册"/>
    <meta property="og:url" content="<?php echo url(1) ?>"/>
    <meta property="og:site_name" content="<?php echo constant("SITE_TITLE"); ?>"/>
    <meta property="og:description" content="注册"/>

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="注册">
    <meta name="twitter:description" content="注册">
    <meta name="twitter:creator" content="@author_handle">

    <link rel="icon" type="image/png" href="/templates/default/images/favicon.png">

    <!-- Animate.css -->
    <link rel="stylesheet" href="/css/animate.css">
    <style>
        body {
            width: 100%;
            height: 100%;
            background: url(images/register.jpg) no-repeat;
            background-position: center 0;
        }
    </style>
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
<div class="midd_r">
    <div class="midd_89">
        <form action="do?id=reg" method="post" name="form" id="form">
            <input type="hidden" name="formcode" value="<?php echo $_SESSION['formcode'] ?>">
            <div class="midd_62"><img src="images/guide_3_03.png"><span>用户注册</span></div>
            <input type="text" name="mail" data-validation-engine="validate[required],custom[email]" class="input_6" placeholder="您的邮箱*">
            <input type="password" name="pass" data-validation-engine="validate[required]" id="pass" class="input_7" placeholder="请输入密码*">
            <input type="password" name="rpass" data-validation-engine="validate[required,equals[pass]]" class="input_7" placeholder="请确认密码*">
            <input type="text" name="phone" data-validation-engine="validate[required]" class="input_9" placeholder="请确认手机号码*">
            <input type="text" name="name" data-validation-engine="validate[required]" class="input_10" placeholder="真实姓名*">
            <input type="submit" name="button" class="input_8" value="注册">
            <div class="midd_63"><img src="images/signin_2_07.png"><a href="https://open.weixin.qq.com/connect/qrconnect?appid= &redirect_uri=/login/wx&response_type=code&scope=snsapi_login&state=STATE#wechat_redirect" onmousemove="$('.wx').show()" onmouseout="$('.wx').hide();"><img src="images/signin_1_17.png"></a><a
                    href="/login/qq"><img src="images/signin_1_19.png"></a></div>
            <div class="midd_64"><a href="index.html">返回首页</a><span>|</span><a href="signin.html">立即登录</a></div>
            <div class="clear"></div>
        </form>
    </div>
    <div class="midd_90"> © <?php echo date('Y');?> <?php echo constant("SITE_TITLE");?> All rights reserved</div>
</div>
</body>
</html>

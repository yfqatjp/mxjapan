<?php require_once '../coon.php';
if (@$_SESSION['userid'] == "") {
    header("Location: /signin.html");
    exit;
}
$_SESSION['formcode'] = rfc_encode(mt_rand(0, 1000000));
$txt = "车友申请";
//
require_once $_SERVER['DOCUMENT_ROOT'] . '/common/HmWeb.php';
//
$token = $hmWeb->getToken();
$userId = $_SESSION['userid'];
//
$existSql = "select * from pm_charter_user where user_id = ? ";
$arrExistsUser = $hmWeb->findOne($existSql, array($userId));
$flag = "0";
if ($arrExistsUser == null || count($arrExistsUser) == 0) {
	$flag = "0";
} else {
	// 0:待定  1：公开  2：不公开
	if ($arrExistsUser["checked"] == "1") {
		$flag = "1";
	}
	if ($arrExistsUser["checked"] == "2") {
		$flag = "2";
	}
	if ($arrExistsUser["checked"] == "0") {
		$flag = "3";
	}
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
        <?php if ($flag == "0") {?>
        <div class="user_21">您还没有申请！</div>
        <?php } else if ($flag == "1") {?>
        <div class="user_21">您申请车友成功！</div>
        <?php } else if ($flag == "2") {?>
        <div class="user_21">您申请被驳回，可能因为您的信息不完成，请与我们联系！</div>
        <?php } else if ($flag == "3") {?>
        <div class="user_21">请耐心等待，正在审批中！</div>
        <?php }?>
        <div class="user_22">美溪车友申请</div>
        
        <!-- 右侧 -->
    	<form action="/action.html?cysq=post" method="post" name="form" id="form">
        <input type="hidden" name="<?php echo $hmWeb->token_name?>" value="<?php echo $token ?>">
        
        <div class="user_20 midd_top45">
            <span>*姓名：</span>
            <div class="left">
                <input type="text" name="user_name" class="input_13" value="<?php echo $hmWeb->t("user_name", $arrExistsUser);?>" >
            </div>
            <div class="clear"></div>
        </div>
        <div class="user_20">
            <span>*在当地年限：</span>
            <div class="left">
                <input type="text" name="drive_year" class="input_13" value="<?php echo $hmWeb->t("drive_year", $arrExistsUser);?>" >
                <i>年</i>
            </div>
            <div class="clear"></div>
        </div>
        <div class="user_20">
            <span>*手机号码：</span>
            <div class="left">
                <input type="text" name="mobile" class="input_13" value="<?php echo $hmWeb->t("mobile", $arrExistsUser);?>" >
            </div>
            <div class="clear"></div>
        </div>
        <div class="user_20">
            <span>支付宝帐号：</span>
            <div class="left">
                <input type="text" name="alipay" class="input_13" value="<?php echo $hmWeb->t("alipay", $arrExistsUser);?>" >
            </div>
            <div class="clear"></div>
        </div>
        <div class="user_20">
            <span>*身份证号：</span>
            <div class="left">
                <input type="text" name="identity" class="input_13" value="<?php echo $hmWeb->t("identity", $arrExistsUser);?>" >
            </div>
            <div class="clear"></div>
        </div>
        <div class="user_20">
            <span>*介绍自己：</span>
            <div class="left">
                <textarea name="self_comment" class="input_19"><?php echo $hmWeb->t("self_comment", $arrExistsUser);?></textarea>
            </div>
            <div class="clear"></div>
        </div>
        <div class="user_20">
            <span>*朋友对您的评价：</span>
            <div class="left">
                <textarea name="friend_comment" class="input_19"><?php echo $hmWeb->t("friend_comment", $arrExistsUser);?></textarea>
            </div>
            <div class="clear"></div>
        </div>
        <div class="user_20">
            <span>为什么来到这座城市：</span>
            <div class="left">
                <textarea name="why_comment" class="input_19"><?php echo $hmWeb->t("why_comment", $arrExistsUser);?></textarea>
            </div>
            <div class="clear"></div>
        </div>
        <input type="submit" name="button" class="input_14" value="确认">
        
        </form>
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

<?php
$rsu = $pdo->query("SELECT * FROM pm_user WHERE id = " . $_SESSION['userid']);
$rou = $rsu->fetch();

$charterResult = $pdo->query("SELECT * FROM pm_charter_user WHERE user_id = " . $_SESSION['userid']);
$isCharterOwner = 0;
$charterInfo = array();
if ($charterResult->rowCount() > 0) {
	$charterInfo = $charterResult->fetch();
	$isCharterOwner = 1;
}
?>
<div class="user_1">
    <div class="user_2">个人中心</div>
    <div class="user_3"><a href="txsz.html"><img src="<?php echo $rou['ico'] ?>"
                                                 onerror="this.src='/images/default.jpg'"></a><span><a
                href="grxx.html"><?php echo $_SESSION['username'] ?></a></span></div>
    <ul>
        <li>
            <span>订单详细</span>
            <a href="jddd.html" <?php if (@$nleft == 1){ ?>class="user_12"<?php } ?>>酒店订单</a>
            <a href="bcdd.html" <?php if (@$nleft == 2) { ?>class="user_12"<?php } ?>>包车订单</a>
        </li>
        
        <?php 
        if ($isCharterOwner == 1) {
        ?>
        <li>
            <span>接单详细</span>
            <a href="acdd.html" <?php if (@$nleft == 9) { ?>class="user_12"<?php } ?>>爱车订单</a>
        </li>
        <?php 
        }
        ?>
        <li>
            <span>个人信息</span>
            <a href="grxx.html" <?php if (@$nleft == 3){ ?>class="user_12"<?php } ?>>个人信息</a>
            <a href="txsz.html" <?php if (@$nleft == 4) { ?>class="user_12"<?php } ?>>头像设置</a>
            <a href="mmxx.html" <?php if (@$nleft == 5) { ?>class="user_12"<?php } ?>>密码修改</a>
            <?php 
	        if ($isCharterOwner == 1) {
	        ?>
	        <a href="acsz.html" <?php if (@$nleft == 10) { ?>class="user_12"<?php } ?>>爱车设置</a>
	        <?php 
	        }
	        ?>
        </li>
        <li>
            <span>其他信息</span>
            <a href="nbxxk.html" <?php if (@$nleft == 6){ ?>class="user_12"<?php } ?>>内部信息库</a>
            <a href="cysq.html" <?php if (@$nleft == 7) { ?>class="user_12"<?php } ?>>车友申请</a>
            <a href="/logout.html" <?php if (@$nleft == 8) { ?>class="user_12"<?php } ?>>退出登录</a>
        </li>
    </ul>
    <div class="sehun_12">
        <div class="sehun_10"><span>个人中心</span></div>
        <div id="pt1" class="sehun_3">
            <a class="sehun_4 user2">个人中心</a>
            <div style="display:none;" id="pt2" class="sehun_5">
                <a href="/user">个人中心</a>
                <a href="jddd.html" <?php if (@$nleft == 1){ ?>class="user_12"<?php } ?>>酒店订单</a>
                <a href="bcdd.html" <?php if (@$nleft == 2) { ?>class="user_12"<?php } ?>>包车订单</a>
                <a href="grxx.html" <?php if (@$nleft == 3){ ?>class="user_12"<?php } ?>>个人信息</a>
                <a href="txsz.html" <?php if (@$nleft == 4) { ?>class="user_12"<?php } ?>>头像设置</a>
                <a href="mmxx.html" <?php if (@$nleft == 5) { ?>class="user_12"<?php } ?>>密码修改</a>
                <a href="nbxxk.html" <?php if (@$nleft == 6){ ?>class="user_12"<?php } ?>>内部信息库</a>
                <a href="cysq.html" <?php if (@$nleft == 7) { ?>class="user_12"<?php } ?>>车友申请</a>
                <?php 
		        if ($isCharterOwner == 1) {
		        ?>
		        <a href="acdd.html" <?php if (@$nleft == 9) { ?>class="user_12"<?php } ?>>爱车订单</a>
		        <a href="acsz.html" <?php if (@$nleft == 10) { ?>class="user_12"<?php } ?>>爱车设置</a>
		        <?php 
		        }
		        ?>
                <a href="/logout.html" <?php if (@$nleft == 8) { ?>class="user_12"<?php } ?>>退出登录</a>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<script>
    $(function () {
        $("#pt1").click(function () {
            $("#pt2").slideToggle();
        });
        $(".user2").html($(".user_12").html());
    });

</script>
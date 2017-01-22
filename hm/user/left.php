<?php
$rsu = $pdo->query("SELECT * FROM pm_user WHERE id = " . $_SESSION['userid']);
$rou = $rsu->fetch();
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
        <li>
            <span>个人信息</span>
            <a href="grxx.html" <?php if (@$nleft == 3){ ?>class="user_12"<?php } ?>>个人信息</a>
            <a href="txsz.html" <?php if (@$nleft == 4) { ?>class="user_12"<?php } ?>>头像设置</a>
            <a href="mmxx.html" <?php if (@$nleft == 5) { ?>class="user_12"<?php } ?>>密码修改</a>
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
            <a class="sehun_4" id="s0">个人中心</a>
            <div style="display:none;" id="pt2" class="sehun_5">
                <a id="s1" href="user.html">个人中心</a>
                <a id="s2" href="jddd.html">订单详细</a>
                <a id="s3" href="grxx.html">个人信息</a>
                <a id="s4" href="nbxxk.html">其他信息</a>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
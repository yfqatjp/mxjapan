<?php 
require_once './../coon.php';
if (@$_SESSION['userid'] == "") {
    header("Location: /signin.html");
    exit;
}
$txt = "爱车订单";

//
require_once $_SERVER['DOCUMENT_ROOT'] . '/common/HmWeb.php';
//
$token = $hmWeb->getToken();

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

<div class="midd_26">
<img src="../images/11_03.png"><a href="/index.html">首页</a> > <a href="/user">个人中心</a> > 
<a href="bcdd.html">爱车订单</a>
</div>

<div class="midd_auto user">
    <!-- 左侧导航 -->
    <?php $nleft = 9;
    require_once 'left.php';
    ?>
    <!-- 右侧 -->
    <div class="user_4">
        <div class="midd_68"><span>爱车订单</span></div>
        
        

        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="user_13">
            <tr class="user_14">
                <td width="34%" style="padding-left:10px;">商品</td>
                <td width="15%" align="center">订单价格</td>
                <td width="18%" align="center">订单日期</td>
                <td width="15%" align="center">订单状态</td>
                <td width="18%" align="center">订单操作</td>
            </tr>
            <?php
            $perNumber = 6;
            $page = @$_GET['page'];
            $count = $pdo->query("SELECT b.* FROM pm_gwc AS a INNER JOIN pm_charter_booking AS b ON a.onum = b.trans WHERE  b.charter_owner = " . $_SESSION['userid'] . " ");
            $totalNumber = $count->rowCount();
            $totalPage = ceil($totalNumber / $perNumber);
            if (!isset($page)) {
                $page = 1;
            }
            $startCount = ($page - 1) * $perNumber;
            $rs = $pdo->query("SELECT a.onum, a.dtime, b.* FROM pm_gwc AS a INNER JOIN pm_charter_booking AS b ON a.onum = b.trans WHERE  b.charter_owner = " . $_SESSION['userid'] . " limit $startCount,$perNumber");
            while ($row = $rs->fetch()) {
                    ?>
                    <tr>
                        <td>
                        	<a href="/guidexx.html?id=<?php echo $row['charter_id'];?>" style="background: none;">
                        	<img
                                    src="<?php $rs3 = $pdo->query("SELECT * FROM pm_charter_file WHERE id_item = " . $row['charter_id']);
                                    $row3 = $rs3->fetch();
                                    echo "/medias/charter/medium/" . $row3['id'] . "/" . $row3['file'] ?>" width="80"
                                    height="67"></a>
                            <h2><?php echo $row['title'] ?></h2><br>
                            <h3>预定日：<?php echo date('Y-m-d', $row['arrive_time']) ?>
                            	<br/>预定人：<?php echo $row['firstname'] ?>
                            	<br/>手机号码：<?php echo $row['mobile'] ?>
                            	<br/>大人：<?php echo $row['adults'] ?>人    / 儿童：<?php echo $row['children'] ?>人
                            </h3>
                        </td>
                        <td align="center" class="user_15"><?php echo $row['total'] ?>元</td>
                        <td align="center"><?php echo $row['dtime'] ?></td>
                        <td align="center"<?php if ($row['status'] == 0){ ?> class="user_15">
                            等待付款<?php } else if ($row['status'] == 2) { ?>>取消<?php } else if ($row['status'] == 1) { ?>>预约等待中<?php } else if ($row['status'] == 4) { ?>>已付款<?php } else if ($row['status'] == 3) { ?>>拒绝付款<?php } else if ($row['status'] == 5) { ?>>确认预约<?php } else if ($row['status'] == 6) { ?>>已接单<?php } ?></td>
                        <td align="center"><?php if ($row['status'] == 4) { ?><a
                                    href="javascript:void(0);" onclick="submitJieDanForm('<?php echo $row['onum'];?>');">接单</a><?php } ?>
                        </td>
                    </tr>
                <?php 
            } ?>
        </table>
        
        <form id="jiedanForm" name="jiedanForm" action="/action.html?jiedan=post" method="post">
			<input type="hidden" name="<?php echo $hmWeb->token_name?>" value="<?php echo $token ?>">
			<input type="hidden" name="order_no" id="order_no" value="" />
			<input type="hidden" name="page" id="page" value="<?php echo $page?>" />
		</form>
		
        <div id='pagina'>
            <?php
            if ($page - 1 > 0) {
                ?>
                <a href="acdd_<?php echo $page - 1 ?>.html">上一页</a>
                <?php
            }
            if ($page == $totalPage && $page == 1) {
                echo "<a class='number'>1</a>";
            } else {
                if ($page - 2 > 0) {
                    ?>
                    <a href="acdd_<?php echo $page - 2 ?>.html"><?php echo $page - 2 ?></a>
                    <?php
                }
                if ($page - 1 > 0) {
                    ?>
                    <a href="acdd_<?php echo $page - 1 ?>.html"><?php echo $page - 1 ?></a>
                    <?php
                }

                if ($totalPage > 5) {
                    if ($totalPage - 2 >= $page) {
                        $total = $page + 2;
                    } else {
                        $total = $totalPage;
                    }
                } else {
                    $total = $totalPage;
                }
                for ($i = $page; $i <= @$total; $i++) {
                    if ($page == $i) {
                        echo '<a class="number">' . $i . '</a>';
                    } else { ?>
                        <a href="acdd_<?php echo $i ?>.html"><?php echo $i ?></a>
                        <?php
                    }
                }
            }
            if ($page + 1 < $totalPage) {
                ?>
                <a href="acdd_<?php echo $page + 1 ?>.html">下一页</a>
            <?php } ?>
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

    function submitJieDanForm(orderNo) {
        $("#order_no").val(orderNo);
        $("#jiedanForm").submit();
    }
</script>
</body>
</html>

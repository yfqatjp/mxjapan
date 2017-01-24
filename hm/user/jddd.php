<?php require_once '../coon.php';
if (@$_SESSION['userid'] == "") {
    header("Location: /signin.html");
    exit;
}
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
        href="jddd.html">酒店订单</a></div>

<div class="midd_auto user">
    <!-- 左侧导航 -->
    <?php $nleft = 1;
    require_once 'left.php';
    ?>
    <!-- 右侧 -->
    <div class="user_4">
        <div class="midd_68"><span>酒店订单</span></div>
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
            $count = $pdo->query("SELECT * FROM pm_gwc AS a LEFT JOIN pm_booking AS b ON a.onum = b.trans WHERE b.id IS NOT NULL AND a.uid = " . $_SESSION['userid'] . " ");
            $totalNumber = $count->rowCount();
            $totalPage = ceil($totalNumber / $perNumber);
            if (!isset($page)) {
                $page = 1;
            }
            $startCount = ($page - 1) * $perNumber;
            $rs = $pdo->query("SELECT *,a.room as aroom FROM pm_gwc AS a LEFT JOIN pm_booking AS b ON a.onum = b.trans WHERE b.id IS NOT NULL AND a.uid = " . $_SESSION['userid'] . " limit $startCount,$perNumber");
            while ($row = $rs->fetch()) {
                $rs1 = $pdo->query("SELECT * FROM pm_hotel WHERE id = " . $row['hotels'] . " AND lang = 2");
                $row1 = $rs1->fetch();
                $rs2 = $pdo->query("SELECT * FROM pm_room WHERE id = " . $row['aroom'] . " AND lang = 2");
                $row2 = $rs2->fetch();
                ?>
                <tr>
                    <td><img
                            src="<?php $rs3 = $pdo->query("SELECT * FROM pm_hotel_file WHERE id_item = " . $row1['id']);
                            $row3 = $rs3->fetch();
                            echo "/medias/hotel/medium/" . $row3['id'] . "/" . $row3['file'] ?>" width="80" height="67">
                        <h2><?php echo $row1['title'] ?></h2><br>
                        <h3><?php echo $row2['title'] ?><br/>备注：<?php echo $row['text'] ?></h3></td>
                    <td align="center" class="user_15"><?php echo $row2['price'] ?>元</td>
                    <td align="center"><?php echo $row['dtime'] ?></td>
                    <td align="center"<?php if ($row['tai'] == 0){ ?> class="user_15">
                        等待付款<?php } else if ($row['tai'] == 1) { ?>>预约确认<?php } else if ($row['tai'] == 2) { ?>>预约等待中<?php } else if ($row['tai'] == 3) { ?>>已付款<?php } else if ($row['tai'] == 5) { ?>>已完成<?php } ?></td>
                    <td align="center"><?php if ($row['tai'] == 0) { ?><a href="/payment.html">立即付款</a><?php } ?></td>
                </tr>
            <?php } ?>
        </table>
        <div id='pagina'>
            <?php
            if ($page - 1 > 0) {
                ?>
                <a href="jddd_<?php echo $page - 1 ?>.html">上一页</a>
                <?php
            }
            if ($page == $totalPage && $page == 1) {
                echo "<a class='number'>1</a>";
            } else {
                if ($page - 2 > 0) {
                    ?>
                    <a href="jddd_<?php echo $page - 2 ?>.html"><?php echo $page - 2 ?></a>
                    <?php
                }
                if ($page - 1 > 0) {
                    ?>
                    <a href="jddd_<?php echo $page - 1 ?>.html"><?php echo $page - 1 ?></a>
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
                        <a href="jddd_<?php echo $i ?>.html"><?php echo $i ?></a>
                        <?php
                    }
                }
            }
            if ($page + 1 < $totalPage) {
                ?>
                <a href="jddd_<?php echo $page + 1 ?>.html">下一页</a>
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
</script>
</body>
</html>

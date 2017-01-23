<?php require_once '../coon.php';
if (@$_SESSION['userid'] == "") {
    header("Location: /signin.html");
    exit;
}
$_SESSION['formcode'] = rfc_encode(mt_rand(0, 1000000));
$txt = "内部信息库";
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


<div class="midd_26"><img src="../images/11_03.png"><a href="/index.html">首页</a> > <a href="index.html">个人中心</a> > <a
        href="nbxxk.html">内部信息库</a></div>

<div class="midd_auto user">
    <!-- 左侧导航 -->
    <?php $nleft = 6;
    require_once 'left.php';
    ?>
    <!-- 右侧 -->
    <div class="user_4">
        <div class="midd_68"><span>内部信息库</span></div>
        <form name="search_form" method="post" action="/do?gg=post">
            <input type="hidden" name="formcode" value="<?php echo $_SESSION['formcode'] ?>">
            <div class="user_18">
                <input type="submit" class="input_15" value="搜索">
                <input type="text" name="text" class="input_16" value="<?php echo @$_GET['text']?>" placeholder="输入查找关键字">
                <select name="lid" class="input_17">
                    <option value="">请选择类别</option>
                    <?php
                    $rs = $pdo->query("SELECT * FROM pm_category ORDER BY id DESC");
                    while ($row = $rs->fetch()) {
                        ?>
                        <option value="<?php echo $row['id'] ?>"<?php if($row['id']==@$_GET['lid']){?> selected="selected"<?php }?>><?php echo $row['category'] ?></option>
                    <?php } ?>
                </select>
                <div class="clear"></div>
            </div>
        </form>

        <?php
        $sql = "";
        if (@$_GET['text'] != "") {
            $sql .= " and title like '%" . $_GET['text'] . "%'";
        }
        if (@$_GET['lid'] != "") {
            $sql .= " and category = " . $_GET['lid'] . "";
        }
        $perNumber = 6;
        $page = @$_GET['page'];
        $count = $pdo->query("SELECT * FROM pm_notice WHERE lang = 2 AND checked = 1 " . $sql);
        //GROUP BY id
        $totalNumber = $count->rowCount();
        $totalPage = ceil($totalNumber / $perNumber);
        if (!isset($page)) {
            $page = 1;
        }
        $startCount = ($page - 1) * $perNumber;
        $rs = $pdo->query("SELECT * FROM pm_notice WHERE lang = 2 AND checked = 1 " . $sql . " ORDER BY id DESC limit $startCount,$perNumber");
        while ($row = $rs->fetch()) {
            ?>
            <div class="user_10"><a href="nbxxkxx_x<?php echo $row['id'] ?>.html">
                    <div class="left" style="width: 25%; height: 100px;overflow: hidden;"><img
                            src="<?php $rs1 = $pdo->query("SELECT * FROM pm_notice_file WHERE id_item = " . $row['id'] . " ORDER BY rank DESC");
                            $row1 = $rs1->fetch();
                            echo "/medias/notice/medium/" . $row1['id'] . "/" . $row1['file'] ?>" width="100%"></div>
                    <div class="user_11" style="width: 72%;margin-left:3%">
                        <h2><?php echo $row['title'] ?></h2>
                        <h3>
                            <?php echo strtrunc(strip_tags($row['text']), 370); ?></h3>
                        <span>类别：<?php
                            $rs1 = $pdo->query("SELECT * FROM pm_category WHERE id = " . $row['category']);
                            $row1 = $rs1->fetch();
                            echo $row1['category'];
                            ?>&nbsp; |&nbsp; 发布日期：<?php echo date("Y-m-d", $row['add_date']); ?></span>
                    </div>
                    <div class="clear"></div>
                </a></div>

        <?php } ?>

        <div id='pagina'>
            <?php
            if ($page - 1 > 0) {
                ?>
                <a href="/user/nbxxk_<?php echo $page - 1 ?>__.html">上一页</a>
                <?php
            }
            if ($page == $totalPage && $page == 1) {
                echo "<a class='number'>1</a>";
            } else {
                if ($page - 2 > 0) {
                    ?>
                    <a href="/user/nbxxk_<?php echo $page - 2 ?>__.html"><?php echo $page - 2 ?></a>
                    <?php
                }
                if ($page - 1 > 0) {
                    ?>
                    <a href="/user/nbxxk_<?php echo $page - 1 ?>__.html"><?php echo $page - 1 ?></a>
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
                for ($i = $page;
                     $i <= @$total;
                     $i++) {
                    if ($page == $i) {
                        echo '<a class="number">' . $i . '</a>';
                    } else { ?>
                        <a href="/user/nbxxk_<?php echo $i ?>__.html"><?php echo $i ?></a>
                        <?php
                    }
                }
            }
            if ($page + 1 < $totalPage) {
                ?>
                <a href="/user/nbxxk_<?php echo $page + 1 ?>__.html">下一页</a>
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

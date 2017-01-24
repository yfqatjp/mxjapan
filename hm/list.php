<?php require_once 'coon.php';
$navid = 9;
$_SESSION['formcode'] = rfc_encode(mt_rand(0, 1000000));
$rs = $pdo->query("SELECT * FROM `pm_page` WHERE `lang` = '2' AND id = " . $navid);
$row = $rs->fetch();

$rs2 = $pdo->query("SELECT * FROM pm_article_file WHERE checked = 1 AND lang = 2 AND type = 'image' AND file != '' ORDER BY rank LIMIT 1");
$row2 = $rs2->fetch();
?><!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" xmlns="http://www.w3.org/1999/html">
<!--<![endif]-->
<head>
    <?php require_once 'top.php'; ?>
    <script type="text/javascript"
            src="http://www.google.cn/maps/api/js?key=<?php echo constant("GMAPS_API_KEY") ?>&sensor=false"></script>
    <!-- 评价 -->
    <script type="text/javascript">
        function rate(obj, oEvent) {
            var imgSrc = 'images/11_135.png';
            var imgSrc_2 = 'images/11_10.png';
            if (obj.rateFlag) return;
            var e = oEvent || window.event;
            var target = e.target || e.srcElement;
            var imgArray = obj.getElementsByTagName("img");
            for (var i = 0; i < imgArray.length; i++) {
                imgArray[i]._num = i;
                imgArray[i].onclick = function () {
                    if (obj.rateFlag) return;
                    alert//加个, 就没有弹窗了//(this._num+1);
                    var inputid = this.parentNode.previousSibling
                    inputid.value = this._num + 1;
                    $('.plid').val(this._num + 1);
                }
            }
            if (target.tagName == "IMG") {
                for (var j = 0; j < imgArray.length; j++) {
                    if (j <= target._num) {
                        imgArray[j].src = imgSrc_2;
                    } else {
                        imgArray[j].src = imgSrc;
                    }
                    target.parentNode.onmouseout = function () {
                        var imgnum = parseInt(target.parentNode.previousSibling.value);
                        for (n = 0; n < imgArray.length; n++) {
                            imgArray[n].src = imgSrc;
                        }
                        for (n = 0; n < imgnum; n++) {
                            imgArray[n].src = imgSrc_2;
                        }
                    }
                }
            } else {
                return false;
            }
        }
    </script>
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

<?php require_once 'head.php';
$rs = $pdo->query("SELECT * FROM pm_hotel WHERE lang = 2 AND id = " . $_GET['id']);
$row = $rs->fetch(); ?>

<aside id="fh5co-hero">
    <div style="background: url(images/7_02.png) no-repeat; background-position:center center; height:222px;">
        <div class="overlay-gradient"></div>
        <div class="container" style="height:222px;">
            <div class="col-md-offset-1 text-center js-fullheight slider-text">
                <div class="slider-text-inner midd_230s">
                    <h2>日本特色民宿</h2>
                    <p><span>无论走到世界任何地方您都会觉得在家一样</span></p>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</aside>
<div class="midd_25">
    <div class="midd_26"><img src="images/11_03.png"><a href="index.html">首页</a> > <a href="/list2.html">民宿</a> > <a
            href="#"><?php echo $row['title'] ?></a></div>
</div>
<div id="fh5co-work-section" class="fh5co-light-grey-section" style="padding:0;">
    <div class="container">
        <div class="midd_27">
            <div class="left midd_52">
                <div id="originalpic">
                    <?php
                    $rs1 = $pdo->query("SELECT * FROM pm_hotel_file WHERE lang = 2 AND id_item = " . $row['id'] . " ORDER BY rank DESC");
                    $i = 1;
                    while ($row1 = $rs1->fetch()) {
                        ?>
                        <li><a href="javascript:;"><img
                                    src="/medias/hotel/medium/<?php echo $row1['id'] ?>/<?php echo $row1['file'] ?>" <?php if ($i == 1) { ?>
                                    style="display: inline;"<?php } ?>></a></li>
                        <?php
                        $i++;
                    }
                    ?>
                    <a id="aPrev"
                       style="cursor: url(/images//prev.cur), auto; height: 600px;"></a>
                    <a id="aNext"
                       style="cursor: url(/images//next.cur), auto; height: 600px;"></a>
                </div>
                <div class="thumbpic"><a href="javascript:;" class="bntprev"></a>
                    <div id="piclist">
                        <ul>
                            <?php
                            $rs1 = $pdo->query("SELECT * FROM pm_hotel_file WHERE lang = 2 AND id_item = " . $row['id'] . " ORDER BY rank DESC");
                            $i = 1;
                            while ($row1 = $rs1->fetch()) {
                                ?>
                                <li<?php if ($i == 1) {
                                    $img = "/medias/hotel/medium/" . $row1['id'] . "/" . $row1['file']; ?> class="hover"<?php } ?>>
                                    <a href="javascript:;"><img
                                            src="/medias/hotel/medium/<?php echo $row1['id'] ?>/<?php echo $row1['file'] ?>"
                                            width="120" height="86"></a></li>
                                <?php
                                $i++;
                            } ?>
                        </ul>
                    </div>
                    <a href="javascript:;" class="bntnext"></a></div>
            </div>
            <div class="midd_28">
                <div class="midd_29"><?php echo $row['title'] ?></div>
                <div class="midd_48"><span><?php echo $row['subtitle'] ?></span>
                    <span><?php for ($i = 1; $i <= $row['num']; $i++) { ?><img
                            src="images/10_10.png"><?php } ?></span></div>
                <ul class="midd_49">
                    <li><a href="#"><img src="images/11_14.png"><?php echo $row['address'] ?></a></li>
                    <li><a href="#"><img src="images/11_17.png"><?php echo $row['phone'] ?></a></li>
                    <li><a href="#"><img src="images/11_19.png"><?php echo $row['email'] ?></a></li>
                </ul>
                <div class="midd_50">
                    <div class="midd_51"><span class="midd_53"><?php
                            $rs1 = $pdo->query("SELECT avg(rank) FROM pm_hotel_pl WHERE id_item = " . $row['id']);
                            $row1 = $rs1->fetch();
                            echo round($row1[0], 1);
                            $rs1 = $pdo->query("SELECT * FROM pm_hotel_pl WHERE id_item = " . $row['id']); ?></span><span>/</span>分<br>
                        顾客评分
                    </div>
                    <div class="midd_54"><span class="midd_55"><?php echo $rs1->rowCount(); ?></span><span>/</span>次<br>
                        评论数量
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="midd_56"><span>设施：</span> <?php
                    $icon = explode(',', $row['facilities']);
                    $ico = count($icon);
                    for ($i = 0; $i < $ico; $i++) {
                        $rs1 = $pdo->query("SELECT * FROM pm_facility_file WHERE id_item = " . $icon[$i]);
                        $row1 = $rs1->fetch();
                        ?><img
                        src="/medias/facility/big/<?php echo $row1['id'] ?>/<?php echo $row1['file'] ?>"
                        style="margin-bottom: 5px;margin-right: 5px;"><?php } ?></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="midd_27">
            <div class="midd_30">酒店介绍</div>
            <p class="midd_31">
                <?php echo $row['descr'] ?></p>
            <div class="midd_30">房屋选择</div>
            <?php
            $rs2 = $pdo->query("SELECT * FROM pm_room WHERE lang = 2 AND checked = 1 AND id_hotel = " . $_GET['id']);
            while ($row2 = $rs2->fetch()) {
                ?>
                <div class="midd_32"><a>
                        <div class="midd_33"><img
                                src="<?php
                                $rs1 = $pdo->query("SELECT * FROM pm_room_file WHERE id_item = " . $row2['id']);
                                $row1 = $rs1->fetch();
                                echo "/medias/room/medium/" . $row1['id'] . "/" . $row1['file'] ?>"></div>
                        <div class="midd_34">
                            <div class="midd_35"><?php echo $row2['title'] ?></div>
                            <div class="midd_36"><?php echo $row2['subtitle'] ?></div>
                            <div class="midd_36">最大人数：大人*<?php echo $row2['max_adults'] ?>
                                、小孩*<?php echo $row2['max_children'] ?></div>
                        </div>
                        <div class="midd_37"><span
                                class="midd_38"><?php $rs3 = $pdo->query("SELECT * FROM pm_rate WHERE id_room = " . $row2['id'] . " ORDER BY id DESC");
                                if ($rs3->rowCount() > 0) {
                                    $row3 = $rs3->fetch();
                                    echo "￥" . $row3['price'] . "</span>/每晚";
                                } else {
                                    echo '预约咨询</span>';
                                } ?>
                        </div>
                    </a>
                    <div class="midd_39"
                         onclick="yd(<?php echo $row2['id'] ?>,<?php echo $row2['max_adults'] ?>,<?php echo $row2['max_children'] ?>,'<?php echo $row2['start_lock'] ?>','<?php echo $row2['end_lock'] ?>',<?php echo $_GET['id'] ?>)">
                        预定
                    </div>
                    <div class="clear"></div>
                </div>
            <?php } ?>
            <script type="text/javascript">
                function yd(a, b, c, d, e,f) {
                    $('#g_iframe').attr('src','/room_'+a+'_'+b+'_'+c+'_'+d+'_'+e+'_'+f+'.html');
                    $(".tanchuang,.tanchuang1").slideToggle();
                }
                ;
            </script>
            <div class="tanchuang">
                <iframe name="contentFrame" id="g_iframe" class="g-iframe" scrolling="auto" frameborder="0"
                        src="about:blank" style=" height: 100%;min-width: 100%"></iframe>
            </div>
            <div class="tanchuang1"></div>

            <div class="midd_30">地图</div>
            <div id="mainMap" style="width: 100%;height: 480px;"></div>
            <div class="midd_30" id="pl">网友评论</div>
            <div class="midd_40">
                <div class="left">整体评分：<span><?php
                        $rs1 = $pdo->query("SELECT avg(rank) FROM pm_hotel_pl WHERE id_item = " . $row['id']);
                        $row1 = $rs1->fetch();
                        echo round($row1[0], 1) ?></span>/分
                </div>
                <?php for ($i = 0; $i < floor($row1[0]); $i++) { ?>
                    <img src="images/11_10.png">
                <?php }
                for ($i = 0; $i < 5 - floor($row1[0]); $i++) {
                    ?>
                    <img src="images/11_135.png"><?php } ?></div>

            <?php
            $perNumber = 10;
            $page = @$_GET['page'];
            $count = $pdo->query("SELECT * FROM pm_hotel_pl WHERE id_item = " . $row['id']);
            $totalNumber = $count->rowCount();
            $totalPage = ceil($totalNumber / $perNumber);
            if (!isset($page)) {
                $page = 1;
            }
            $startCount = ($page - 1) * $perNumber;
            $rs1 = $pdo->query("SELECT * FROM pm_hotel_pl WHERE id_item = " . $row['id'] . " order by id desc limit $startCount,$perNumber");
            while ($row1 = $rs1->fetch()) {
                $rs2 = $pdo->query("SELECT * FROM pm_user WHERE id = " . $row1['uid'] . " ");
                $row2 = $rs2->fetch();
                ?>
                <div class="midd_41">
                    <div class="midd_42"><img src="<?php echo $row2['ico'] ?>" onerror="this.src='/images/default.jpg'"><span><?php
                            if ($row2['xname'] == "") {
                                echo $row2['name'];
                            } else {
                                echo $row2['xname'];
                            } ?></span>
                    </div>
                    <div class="left">
                        <div class="midd_43"><?php for ($i = 1; $i <= $row1['rank']; $i++) { ?>
                                <img src="images/10_10.png"><?php } ?>
                            <span><?php echo date("Y-m-d", strtotime($row1['dtime'])) ?></span>
                            <div class="clear"></div>
                        </div>
                        <div class="midd_44"><?php echo $row1['text'] ?>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
                <?php
            } ?>
            <div id='pagina'>
                <?php
                if ($page - 1 > 0) {
                    ?>
                    <a href="list_<?php echo @$_GET['id'] ?>_<?php echo $page - 1 ?>.html">上一页</a>
                    <?php
                }
                if ($page == $totalPage && $page == 1) {
                    echo "<a class='number'>1</a>";
                } else {
                    if ($page - 2 > 0) {
                        ?>
                        <a href="list_<?php echo @$_GET['id'] ?>_<?php echo $page - 2 ?>.html"><?php echo $page - 2 ?></a>
                        <?php
                    }
                    if ($page - 1 > 0) {
                        ?>
                        <a href="list_<?php echo @$_GET['id'] ?>_<?php echo $page - 1 ?>.html"><?php echo $page - 1 ?></a>
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
                            <a href="list_<?php echo @$_GET['id'] ?>_<?php echo $i ?>.html"><?php echo $i ?></a>
                            <?php
                        }
                    }
                }
                if ($page + 1 < $totalPage) {
                    ?>
                    <a href="list_<?php echo @$_GET['id'] ?>_<?php echo $page + 1 ?>.html">下一页</a>
                <?php } ?>
            </div>
            <form name="search_form" method="post" action="do?pl=post">
                <input type="hidden" name="formcode" value="<?php echo $_SESSION['formcode'] ?>">
                <input type="hidden" name="lid" value="<?php echo @$_GET['id'] ?>">
                <textarea name="text" class="input_1" placeholder="输入你的留言..."></textarea>
                <div class="midd_45">
                    <div class="left" onmouseover="rate(this,event)"><span>评价：</span><img src="images/11_135.png"><img
                            src="images/11_135.png"><img src="images/11_135.png"><img src="images/11_135.png"><img
                            src="images/11_135.png"></div>
                    <input type="hidden" class="plid" name="xx" value="5">
                    <div class="right">
                        <?php if (@$_SESSION['userid'] == "") { ?>
                            <a class="midd_39s" style="margin-top:0;"
                               href="/signin_<?php echo @$_GET['id'] ?>.html">登录</a>
                        <?php } else { ?>
                            <input type="submit" name="button" class="midd_39s" style="margin-top:0;" value="确认评价">
                        <?php } ?>
                    </div>
                    <div class="clear"></div>
                </div>
            </form>
            <div class="clear"></div>
        </div>
        <div class="midd_27">
            <div class="midd_46">推荐民宿</div>
            <?php
            $rs1 = $pdo->query("SELECT * FROM pm_hotel WHERE lang = 2 AND checked = 1 ORDER BY rand() LIMIT 0,4");
            $i = 0;
            while ($row1 = $rs1->fetch()) {
                ?>
                <div class="midd_47"<?php if ($i == $rs1->rowCount()) { ?> style="margin-right:0;"<?php } ?>><a
                        href="list_x<?php echo $row1['id'] ?>.html"><img
                            src="<?php $rs2 = $pdo->query("SELECT * FROM pm_hotel_file WHERE id_item = " . $row1['id']);
                            $row2 = $rs2->fetch();
                            echo "/medias/hotel/medium/" . $row2['id'] . "/" . $row2['file'] ?>"><span><?php echo $row1['title'] ?></span></a>
                </div>
                <?php $i++;
            } ?>
            <div class="clear"></div>
        </div>
    </div>
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
    var googleMapOperation = function () {
        //设置四个位置，用于展示
        var points = [
            new google.maps.LatLng(<?php echo $row['lat']?>, <?php echo $row['lng']?>)
        ];
        var myOptions = {
            zoom: 17,
            center: new google.maps.LatLng(<?php echo $row['lat']?>, <?php echo $row['lng']?>),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        //添加map
        gmap = new google.maps.Map(document.getElementById("mainMap"),
            myOptions);
        markers = [];
        for (var i = 0; i < points.length; i++) {
            var gmarker = new google.maps.Marker({
                position: points[i],
                map: gmap,
            });
            markers.push(gmarker);
            var infowindow = new google.maps.InfoWindow({
                content: "<img width='250' src='<?=$img?>'><br><b style='font-size:15px;margin-top:10px;display:block;color:#e83744;'><?=$row['title']?></b><?php echo $row['subtitle'] ?> <?php for ($i = 1; $i <= $row['num']; $i++) { ?><img src='images/10_10.png'><?php } ?>",
                pixelOffset: 0,
                position: points[i]

            });
            google.maps.event.addListener(gmarker, 'click', function () {
                infowindow.open(gmap, gmarker);
            });
        }

    };
    $(function () {
        googleMapOperation();
    });
</script>
</body>
</html>

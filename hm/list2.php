<?php require_once 'coon.php';
$navid = 9;
$_SESSION['formcode'] = rfc_encode(mt_rand(0, 1000000));
$rs = $pdo->query("SELECT * FROM `pm_page` WHERE `lang` = '2' AND id = " . $navid);
$row = $rs->fetch();

$rs2 = $pdo->query("SELECT * FROM pm_article_file WHERE checked = 1 AND lang = 2 AND type = 'image' AND file != '' ORDER BY rank LIMIT 1");
$row2 = $rs2->fetch();

if (@$_GET['page'] == "") {
    $_GET['page'] = 1;
}
if (@$_GET['ren'] == "") {
    $_GET['ren'] = 0;
}
if (@$_GET['jia'] == "") {
    $_GET['jia'] = 0;
}
if (@$_GET['sou'] == "") {
    $_GET['sou'] = 0;
}
if (@$_GET['list'] == "") {
    $_GET['list'] = 0;
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
    <script type="text/javascript"
            src="http://maps.google.cn/maps/api/js?key=<?php echo constant("GMAPS_API_KEY") ?>&sensor=false"></script>
</head>
<body>
<div class="sehun"></div>

<?php require_once 'head.php'; ?>

<div class="container"></div>
<aside id="fh5co-hero" class="js-fullheight">
    <div class="flexslider js-fullheight">
        <ul class="slides">
            <li style="background: url(images/7_02.png) no-repeat; background-position:center center;">
                <div class="overlay-gradient"></div>
                <div class="container">
                    <div class="col-md-10 col-md-offset-1 text-center js-fullheight slider-text">
                        <div class="slider-text-inner midd_230ss">
                            <h2>日本特色民宿</h2>
                            <p><span>无论走到世界任何地方您都会觉得在家一样</span></p>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</aside>
<div id="fh5co-work-section" class="fh5co-light-grey-section">
    <div class="container">
        <form name="search_form" method="post" action="do?ss=list">
            <input type="hidden" name="formcode" value="<?php echo $_SESSION['formcode'] ?>">
            <div class="midd_2" style="margin-bottom:0;">
                <input name="text" class="text" type="hidden">
                <div id="pt1" class="select">
                    <a class="midd-sj-5" id="s0"><?php if (@$_GET['text'] == "") { ?>请选择地区<?php } else {
                            echo @$_GET['text'];
                        } ?></a>
                    <div id="pt2" class="part">
                        <a id="s1" href="javascript:void(0);">全部</a>
                        <?php
                        $i = 2;
                        $rs = $pdo->query("SELECT * FROM pm_destination WHERE `checked` = 1");
                        while ($row = $rs->fetch()) {
                            ?>
                            <a id="s<?php echo $i ?>" href="javascript:void(0);"><?php echo $row['name'] ?></a>
                            <?php $i++;
                        } ?>
                    </div>
                </div>
                <input name="lid" class="lid" type="hidden" value="1">
                <div id="qt1" class="select">
                    <a class="midd-sj-6" id="q0"><?php
                        if (@$_GET['lid'] == "2") {
                            echo "酒店";
                        } elseif (@$_GET['lid'] == "1") {
                            echo "民宿";
                        } else {
                            echo "类型";
                        };
                        ?></a>
                    <div id="qt2" class="part">
                        <a id="q1" href="javascript:void(0);">全部</a>
                        <?php
                        $i = 2;
                        $rs = $pdo->query("SELECT * FROM pm_destination2 WHERE `checked` = 1");
                        while ($row = $rs->fetch()) {
                            ?>
                            <a id="q<?php echo $i ?>" href="javascript:void(0);"><?php echo $row['name'] ?></a>
                            <?php $i++;
                        } ?>
                    </div>
                </div>
                <div class="midd_12">
                    <input name="ont" class="rendezvous-input-date" id="start" readonly
                           value="<?php if (@$_GET['ont'] == "") { ?>入住日期<?php } else {
                               echo @$_GET['ont'];
                           } ?>">
                    <input name="offt" class="rendezvous-input-date" id="end" readonly
                           value="<?php if (@$_GET['offt'] == "") { ?>退房日期<?php } else {
                               echo @$_GET['offt'];
                           } ?>">
                </div>
                <!-- 选择日期 -->
                <script src="js/jquery.min.js"></script>
                <script type="text/javascript" src="js/laydate.js"></script>
                <script type="text/javascript">
                    !function () {
                        laydate.skin('dahong');//切换皮肤，请查看skins下面皮肤库
                        laydate({elem: '#demo'});//绑定元素
                    }();

                    //日期范围限制
                    var start = {
                        elem: '#start',
                        format: 'YYYY-MM-DD',
                        min: laydate.now(), //设定最小日期为当前日期
                        max: '2099-06-16', //最大日期
                        istime: true,
                        istoday: false,
                        choose: function (datas) {
                            end.min = datas; //开始日选好后，重置结束日的最小日期
                            end.start = datas //将结束日的初始值设定为开始日
                        }
                    };

                    var end = {
                        elem: '#end',
                        format: 'YYYY-MM-DD',
                        min: laydate.now(),
                        max: '2099-06-16',
                        istime: true,
                        istoday: false,
                        choose: function (datas) {
                            start.max = datas; //结束日选好后，充值开始日的最大日期
                        }
                    };
                    laydate(start);
                    laydate(end);

                </script>
                <input type="submit" name="button" class="input" value="搜索">
                <div class="clearfix"></div>
            </div>
        </form>
        <div class="midd_13">
            <div class="left">
                <a href="list2_<?php echo @$_GET['page'] ?>_<?php if (@$_GET['ren'] == 0) { ?>1<?php } elseif (@$_GET['ren'] == 1) { ?>2<?php } else { ?>0<?php } ?>_0_0_<?php echo @$_GET['list'] ?>_<?php echo @$_GET['text'] ?>_<?php echo @$_GET['lid'] ?>_<?php echo @$_GET['ont'] ?>_<?php echo @$_GET['offt'] ?>.html#fh5co-work-section"><?php if (@$_GET['ren'] != 0){ ?>
                    <span><?php } ?>人气</span><img
                        src="images/9_<?php if (@$_GET['ren'] == 1) { ?>08<?php } elseif (@$_GET['ren'] == 2) { ?>082<?php } else { ?>10<?php } ?>.png"></a>
                <a href="list2_<?php echo @$_GET['page'] ?>_0_<?php if (@$_GET['jia'] == 0) { ?>1<?php } elseif (@$_GET['jia'] == 1) { ?>2<?php } else { ?>0<?php } ?>_0_<?php echo @$_GET['list'] ?>_<?php echo @$_GET['text'] ?>_<?php echo @$_GET['lid'] ?>_<?php echo @$_GET['ont'] ?>_<?php echo @$_GET['offt'] ?>.html#fh5co-work-section"><?php if (@$_GET['jia'] != 0){ ?>
                    <span><?php } ?>价格</span><img
                        src="images/9_<?php if (@$_GET['jia'] == 1) { ?>08<?php } elseif (@$_GET['jia'] == 2) { ?>082<?php } else { ?>10<?php } ?>.png"></a>
                <a href="list2_<?php echo @$_GET['page'] ?>_0_0_<?php if (@$_GET['sou'] == 0) { ?>1<?php } elseif (@$_GET['sou'] == 1) { ?>2<?php } else { ?>0<?php } ?>_<?php echo @$_GET['list'] ?>_<?php echo @$_GET['text'] ?>_<?php echo @$_GET['lid'] ?>_<?php echo @$_GET['ont'] ?>_<?php echo @$_GET['offt'] ?>.html#fh5co-work-section"><?php if (@$_GET['sou'] != 0){ ?>
                    <span><?php } ?>销量</span><img
                        src="images/9_<?php if (@$_GET['sou'] == 1) { ?>08<?php } elseif (@$_GET['sou'] == 2) { ?>082<?php } else { ?>10<?php } ?>.png"></a>
            </div>
            <div class="right">
                <a href="list2_<?php echo @$_GET['page'] ?>_<?php echo @$_GET['ren'] ?>_<?php echo @$_GET['jia'] ?>_<?php echo @$_GET['sou'] ?>_2_<?php echo @$_GET['text'] ?>_<?php echo @$_GET['lid'] ?>_<?php echo @$_GET['ont'] ?>_<?php echo @$_GET['offt'] ?>.html#fh5co-work-section"><img
                        src="images/8_<?php if (@$_GET['list'] == "2") { ?>04<?php } else { ?>03<?php } ?>.png"><br><?php if (@$_GET['list'] == 2){ ?>
                    <span><?php } ?>地图</a>
                <a href="list2_<?php echo @$_GET['page'] ?>_<?php echo @$_GET['ren'] ?>_<?php echo @$_GET['jia'] ?>_<?php echo @$_GET['sou'] ?>_1_<?php echo @$_GET['text'] ?>_<?php echo @$_GET['lid'] ?>_<?php echo @$_GET['ont'] ?>_<?php echo @$_GET['offt'] ?>.html#fh5co-work-section"><img
                        src="images/7_<?php if (@$_GET['list'] == "1") { ?>06<?php } else { ?>07<?php } ?>.png"><br><?php if (@$_GET['list'] == 1){ ?>
                    <span><?php } ?>网格</a>
                <a href="list2_<?php echo @$_GET['page'] ?>_<?php echo @$_GET['ren'] ?>_<?php echo @$_GET['jia'] ?>_<?php echo @$_GET['sou'] ?>_0_<?php echo @$_GET['text'] ?>_<?php echo @$_GET['lid'] ?>_<?php echo @$_GET['ont'] ?>_<?php echo @$_GET['offt'] ?>.html#fh5co-work-section"><img
                        src="images/10_<?php if (@$_GET['list'] == "0") { ?>03<?php } else { ?>04<?php } ?>.png"><br><?php if (@$_GET['list'] == 0){ ?>
                    <span><?php } ?>列表</span></a>
            </div>
            <div class="clear"></div>
        </div>
        <?php
        $sql = "";
        if (@$_GET['text'] != "") {
            $sql .= " and a.address like '%" . $_GET['text'] . "%'";
        }
        if (@$_GET['lid'] != "") {
            if (@$_GET['lid'] > 0) {
                $sql .= " and a.lid = " . $_GET['lid'] . "";
            }
        }
        if (@$_GET['ont'] != "") {
            $sql .= " and (b.start_lock >= " . $_GET['ont'] . " or b.start_lock is null)";
        }
        if (@$_GET['offt'] != "") {
            $sql .= " and (b.end_lock <= " . $_GET['offt'] . " or b.end_lock is null)";
        }
        if (@$_GET['ren'] == 1) {
            $sql .= " order by a.ren asc";
        } else if (@$_GET['ren'] == 1) {
            $sql .= " order by a.ren desc";
        }
        if (@$_GET['jia'] == 1) {
            $sql .= " order by a.jia asc";
        } else if (@$_GET['jia'] == 1) {
            $sql .= " order by a.jia desc";
        }
        if (@$_GET['sou'] == 1) {
            $sql .= " order by a.sou asc";
        } else if (@$_GET['sou'] == 1) {
            $sql .= " order by a.sou desc";
        }
        $perNumber = 6;
        $page = @$_GET['page'];
        $count = $pdo->query("SELECT a.* FROM pm_hotel AS a LEFT JOIN pm_room AS b ON a.id = b.id_hotel WHERE a.lang = 2 AND a.checked = 1" . @$sql . " GROUP BY id DESC");
        //GROUP BY id 
        $totalNumber = $count->rowCount();
        $totalPage = ceil($totalNumber / $perNumber);
        if (!isset($page)) {
            $page = 1;
        }
        $startCount = ($page - 1) * $perNumber;
        if (@$_GET['ss'] == 1) { ?>
            <div class="midd_15">找到相关结果约<span><?php echo number_format($totalNumber) ?></span>个</div>
        <?php }
        $map = 0;
        $rs = $pdo->query("SELECT a.* FROM pm_hotel as a LEFT JOIN pm_room as b on a.id = b.id_hotel where a.lang = 2 AND a.checked = 1 " . @$sql . " GROUP BY id desc limit $startCount,$perNumber");
        while ($row = $rs->fetch()) {
            if (@$_GET['list'] == 0) {
                ?>
                <div class="midd_18"><a href="list_x<?php echo $row['id'] ?>.html">
                        <div class="image2"><img
                                src="<?php $rs1 = $pdo->query("SELECT * FROM pm_hotel_file WHERE id_item = " . $row['id'] . " ORDER BY rank aSC");
                                $row1 = $rs1->fetch();
                                echo "/medias/hotel/medium/" . $row1['id'] . "/" . $row1['file'] ?>">
                            <div class="midd_16s">
                                <?php if ($row['tui'] == 1) { ?><span class="midd_16">推荐</span><?php } ?>
                                <?php if ($row['zhe'] == 1) { ?><span class="midd_17">折扣</span><?php } ?>
                            </div>
                        </div>
                        <div class="midd_19">
                            <div class="midd_20"><?php echo $row['title'] ?></div>
                            <div class="midd_21">
                                <span><?php echo $row['subtitle'] ?></span><?php for ($i = 1; $i <= $row['num']; $i++) { ?>
                                    <img
                                        src="images/10_10.png"><?php } ?></div>
                            <div class="clear"></div>
                            <div class="midd_22">
                                <?php echo strtrunc(strip_tags($row['descr']), 370) ?>
                            </div>
                            <div class="midd_21"><img src="images/10_14.png"><span
                                    class="midd_23"><?php echo $row['address'] ?></span>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </a></div>
            <?php } else if (@$_GET['list'] == 1) {
                ?>
                <div class="col-md-4 animate-box"><a href="list_x<?php echo $row['id'] ?>.html"
                                                     class="item-grid text-center">
                        <div class="image1"
                             style="background-image: url(<?php $rs1 = $pdo->query("SELECT * FROM pm_hotel_file WHERE id_item = " . $row['id']);
                             $row1 = $rs1->fetch();
                             echo "/medias/hotel/medium/" . $row1['id'] . "/" . $row1['file'] ?>)">
                            <?php if ($row['tui'] == 1) { ?><span class="midd_16">推荐</span><?php } ?>
                            <?php if ($row['zhe'] == 1) { ?><span class="midd_17">折扣</span><?php } ?>
                        </div>
                        <div class="v-align">
                            <div class="v-align-middle">
                                <h3 class="title"><?php echo $row['title'] ?></h3>
                                <h5 class="category"><?php echo $row['subtitle'] ?></h5>
                            </div>
                        </div>
                    </a></div>
            <?php } else {
                $map = 1;
            }
        }
        if ($map == 1) {
            ?>
            <div id="mainMap" style="width: 1140px;height: 848px;"></div>
        <?php }else{ ?>
        <div id='pagina'>
            <?php
            if ($page - 1 > 0) {
                ?>
                <a href="list2_<?php echo $page - 1 ?>_<?php echo @$_GET['ren'] ?>_<?php echo @$_GET['jia'] ?>_<?php echo @$_GET['sou'] ?>_<?php echo @$_GET['list'] ?>_<?php echo @$_GET['text'] ?>_<?php echo @$_GET['lid'] ?>_<?php echo @$_GET['ont'] ?>_<?php echo @$_GET['offt'] ?>.html">上一页</a>
                <?php
            }
            if ($page == $totalPage && $page == 1) {
                echo "<a class='number'>1</a>";
            } else {
                if ($page - 2 > 0) {
                    ?>
                    <a href="list2_<?php echo $page - 2 ?>_<?php echo @$_GET['ren'] ?>_<?php echo @$_GET['jia'] ?>_<?php echo @$_GET['sou'] ?>_<?php echo @$_GET['list'] ?>_<?php echo @$_GET['text'] ?>_<?php echo @$_GET['lid'] ?>_<?php echo @$_GET['ont'] ?>_<?php echo @$_GET['offt'] ?>.html"><?php echo $page - 2 ?></a>
                    <?php
                }
                if ($page - 1 > 0) {
                    ?>
                    <a href="list2_<?php echo $page - 1 ?>_<?php echo @$_GET['ren'] ?>_<?php echo @$_GET['jia'] ?>_<?php echo @$_GET['sou'] ?>_<?php echo @$_GET['list'] ?>_<?php echo @$_GET['text'] ?>_<?php echo @$_GET['lid'] ?>_<?php echo @$_GET['ont'] ?>_<?php echo @$_GET['offt'] ?>.html"><?php echo $page - 1 ?></a>
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
                        <a href="list2_<?php echo $i ?>_<?php echo @$_GET['ren'] ?>_<?php echo @$_GET['jia'] ?>_<?php echo @$_GET['sou'] ?>_<?php echo @$_GET['list'] ?>_<?php echo @$_GET['text'] ?>_<?php echo @$_GET['lid'] ?>_<?php echo @$_GET['ont'] ?>_<?php echo @$_GET['offt'] ?>.html"><?php echo $i ?></a>
                        <?php
                    }
                }
            }
            if ($page + 1 < $totalPage) {
                ?>
                <a href="list2_<?php echo $page + 1 ?>_<?php echo @$_GET['ren'] ?>_<?php echo @$_GET['jia'] ?>_<?php echo @$_GET['sou'] ?>_<?php echo @$_GET['list'] ?>_<?php echo @$_GET['text'] ?>_<?php echo @$_GET['lid'] ?>_<?php echo @$_GET['ont'] ?>_<?php echo @$_GET['offt'] ?>.html">下一页</a>
            <?php } ?>
        </div>
        <?php } ?>
    </div>
</div>
<?php require_once 'foot.php'; ?>
<!-- jQuery -->

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
    // search
    //获得Cookie解码后的值
    function GetCookieVal(offset) {
        var endstr = document.cookie.indexOf(";", offset);
        if (endstr == -1) endstr = document.cookie.length;
        return unescape(document.cookie.substring(offset, endstr));
    }
    //设定Cookie值-将值保存在Cookie中
    function SetCookie(name, value) {
        var expdate = new Date(); //获取当前日期
        var argv = SetCookie.arguments; //获取cookie的参数
        var argc = SetCookie.arguments.length; //cookie的长度
        var expires = (argc > 2) ? argv[2] : null; //cookie有效期
        var path = (argc > 3) ? argv[3] : null; //cookie路径
        var domain = (argc > 4) ? argv[4] : null; //cookie所在的应用程序域
        var secure = (argc > 5) ? argv[5] : false; //cookie的加密安全设置
        if (expires != null) expdate.setTime(expdate.getTime() + (expires * 1000));
        document.cookie = name + "=" + escape(value) + ((expires == null) ? "" : ("; expires=" + expdate.toGMTString())) + ((path == null) ? "" : ("; path=" + path)) + ((domain == null) ? "" : ("; domain=" + domain)) + ((secure == true) ? "; secure" : "");
    }
    //删除指定的Cookie
    function DelCookie(name) {
        var exp = new Date();
        exp.setTime(exp.getTime() - 1);
        var cval = GetCookie(name); //获取当前cookie的值
        document.cookie = name + "=" + cval + "; expires=" + exp.toGMTString(); //将日期设置为过期时间
    }
    //获得Cookie的值-name用来搜索Cookie的名字
    function GetCookie(name) {
        var arg = name + "=";
        var argLen = arg.length; //指定Cookie名的长度
        var cookieLen = document.cookie.length; //获取cookie的长度
        var i = 0;
        while (i < cookieLen) {
            var j = i + argLen;
            if (document.cookie.substring(i, j) == arg) //依次查找对应cookie名的值
                return GetCookieVal(j);
            i = document.cookie.indexOf(" ", i) + 1;
            if (i == 0) break;
        }
        return null;
    }

    function $$(id) {
        if (document.getElementById) {
            return document.getElementById(id);
        } else if (document.layers) {
            return document.layers[id];
        } else {
            return false;
        }
    }
    (function () {
        function initHead() {
            setTimeout(showSubSearch, 0)
        };
        function showSubSearch() {
            $$("s0").onclick = function () {
                $$("pt2").style.display = "block";
                $$("pt1").className = "select"
            };
            $$("pt2").onclick = function () {
                $$("pt2").style.display = "none";
                $$("pt1").className = "select select_hover"
            };
            $$("s1").onclick = function () {
                selSubSearch(1);
            }
            <?php
            $i = 2;
            $rs = $pdo->query("SELECT * FROM pm_destination WHERE `checked` = 1");
            while ($row = $rs->fetch()) {
            ?>
            $$("s<?php echo $i?>").onclick = function () {
                selSubSearch(<?php echo $i?>);
            };
            <?php $i++;}?>
        };

        function selSubSearch(iType) {
            hbb = [];
            hbb = {
                1: ["全部", "1"],

            <?php
            $i = 2;
            $rs = $pdo->query("SELECT * FROM pm_destination WHERE `checked` = 1");
            while ($row = $rs->fetch()) {
            ?>
            <?php echo $i?> :
            ["<?php echo $row['name']?>", "<?php echo $i?>"],

            <?php $i++;}?>
        }
            ;
            $$("s0").innerHTML = hbb[iType][0];
            $$("pt2").style.display = "none";
            $(".text").val(hbb[iType][0]);
        };
        initHead();
    })();

    hbb = [];
    hbb = {
        1: ["全部", "1"],
    <?php
    $i = 2;
    $rs = $pdo->query("SELECT * FROM pm_destination WHERE `checked` = 1");
    while ($row = $rs->fetch()) {
    ?>
    <?php echo $i?> :
    ["<?php echo $row['name']?>", "<?php echo $i?>"],

    <?php $i++;}?>
    }
    ;

    (function () {
        function initHead() {
            setTimeout(showSubSearch, 0)
        };
        function showSubSearch() {
            $$("q0").onclick = function () {
                $$("qt2").style.display = "block";
                $$("pt1").className = "select"
            };
            $$("qt2").onclick = function () {
                $$("qt2").style.display = "none";
                $$("qt1").className = "select select_hover"
            };
            $$("q1").onclick = function () {
                selSubSearch(1);
            };
            <?php
            $i = 2;
            $rs = $pdo->query("SELECT * FROM pm_destination2 WHERE `checked` = 1");
            while ($row = $rs->fetch()) {
            ?>
            $$("q<?php echo $i?>").onclick = function () {
                selSubSearch(<?php echo $i?>);
            };
            <?php $i++;}?>
        };

        function selSubSearch(iType) {
            hbb = [];
            hbb = {
                1: ["全部", "1"],

            <?php
            $i = 2;
            $rs = $pdo->query("SELECT * FROM pm_destination2 WHERE `checked` = 1");
            while ($row = $rs->fetch()) {
            ?>
            <?php echo $i?> :
            ["<?php echo $row['name']?>", "<?php echo $i?>"],

            <?php $i++;}?>
        }
            ;
            $$("q0").innerHTML = hbb[iType][0];
            $$("qt2").style.display = "none";
            $(".lid").val(iType);
        };
        initHead();
    })();

    hbb = [];
    hbb = {
        1: ["全部", "1"],
    <?php
    $i = 2;
    $rs = $pdo->query("SELECT * FROM pm_destination WHERE `checked` = 1");
    while ($row = $rs->fetch()) {
    ?>
    <?php echo $i?> :
    ["<?php echo $row['name']?>", "<?php echo $i?>"],

    <?php $i++;}?>
    }
    ;

    var map = null;

    function initialize() {

        map = new google.maps.Map(document.getElementById('mainMap'), myOptions);
        <?php
        $rs = $pdo->query("SELECT a.* FROM pm_hotel as a LEFT JOIN pm_room as b on a.id = b.id_hotel " . @$sql . " GROUP BY id  limit 0,100");
        $i = 1;
        while ($row = $rs->fetch()) {
        if (@$lat == "") {
            $lat = $row['lat'];
            $lng = $row['lng'];
        }
        $rs1 = $pdo->query("SELECT * FROM pm_hotel_file WHERE id_item = " . $row['id']);
        $row1 = $rs1->fetch();?>
        addSite(map, <?php echo $row['lat']?>, <?php echo $row['lng']?>, '/medias/hotel/medium/<?php echo $row1['id']?>/<?php echo $row1['file']?>', '<?php echo $row['title']?>', '<?php echo $row['subtitle']?>', '<?php for ($i = 1; $i <= $row['num']; $i++) { ?><img src="images/10_10.png"><?php }?>', '<?php echo $row['id']?>');
        <?php $i++;}?>

        var myOptions = {
            zoom: 17,
            center: new google.maps.LatLng(<?php echo $lat?>, <?php echo $lng?>),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

    }


    var prev_infowindow = null;

    function addSite(map, lat, lng, img, title, sub, num, id) {
        var pt = new google.maps.LatLng(lat, lng);
        var marker = new google.maps.Marker({
            map: map,
            position: pt,
            title: title
        });
        var infowindow = new google.maps.InfoWindow({
            content: "<a href='list_x" + id + ".html'><img width='250' src='" + img + "'><br><b style='font-size:15px;margin-top:10px;display:block'>" + title + "</b></a>" + sub + " " + num
        });

        google.maps.event.addListener(marker, 'click', function () {
            if (prev_infowindow != null) prev_infowindow.close();
            prev_infowindow = infowindow;
            infowindow.open(map, marker);
        });


        var LatLngList = new Array(<?php
                $rs = $pdo->query("SELECT a.* FROM pm_hotel as a LEFT JOIN pm_room as b on a.id = b.id_hotel " . @$sql . " GROUP BY id limit $startCount,$perNumber");
                $i = 1;
                while ($row = $rs->fetch()) {
                ?>new google.maps.LatLng(<?php echo $row['lat']?>, <?php echo $row['lng']?>)<?php if($i != $rs->rowCount()){?>, <?php }$i++;
            }?>);

        var bounds = new google.maps.LatLngBounds();

        for (var i = 0, LtLgLen = LatLngList.length; i < LtLgLen; i++) {
            bounds.extend(LatLngList[i]);
        }

        map.fitBounds(bounds);

    }

    $(document).ready(function () {
        initialize();
    });

</script>
</body>
</html>

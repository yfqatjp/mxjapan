<?php require_once 'coon.php';
$navid = 2;
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
<html class="no-js">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $row['title'] ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo strtrunc(strip_tags($row['text']), 155) ?>"/>
    <meta itemprop="name" content="<?php echo $row['title_tag'] ?>">
    <meta itemprop="description" content="<?php echo strtrunc(strip_tags($row['text']), 155) ?>">

    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content="<?php echo $row['title_tag'] ?>"/>
    <meta property="og:url" content="<?php echo url(1) ?>"/>
    <meta property="og:site_name" content="<?php echo constant("SITE_TITLE"); ?>"/>
    <meta property="og:description" content="<?php echo strtrunc(strip_tags($row['text']), 155) ?>"/>
    <?php
    if (isset($row2['file'])) { ?>
        <meta name="og:image" content="<?php echo $row2['file'] ?>">
        <?php
    } ?>

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="<?php echo $row['title_tag'] ?>">
    <meta name="twitter:description" content="<?php echo strtrunc(strip_tags($row['text']), 155) ?>">
    <meta name="twitter:creator" content="@author_handle">
    <?php
    if (isset($row2['file'])) { ?>
        <meta name="twitter:image:src" content="<?php echo $row2['file'] ?>">
        <?php
    } ?>

    <link rel="icon" type="image/png" href="/templates/default/images/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,700" rel="stylesheet">

    <!-- Animate.css -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="css/icomoon.css">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- Flexslider  -->
    <link rel="stylesheet" href="css/flexslider.css">
    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <!-- Theme style  -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Modernizr JS -->
    <script src="js/modernizr-2.6.2.min.js"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="js/respond.min.js"></script>
    <![endif]-->

    <!-- 选择日期 -->
    <link rel="stylesheet" href="css/rendezvous.css">
</head>
<body>
<div class="sehun"></div>

<header id="fh5co-header" role="banner">
    <div class="container">
        <div class="header-inner">
            <div class="logo"><a href="index.html"><img src="images/logo.png"></a></div>
            <nav role="navigation" class="navshow">
                <ul>
                    <li><a href="index.html">首页</a></li>
                    <li><a href="guide.html">车导服务</a></li>
                    <li class="navs"><a href="list_list.html">民宿</a></li>
                    <li><a href="medical.html">医疗</a></li>
                    <li><a href="gallery.html">旅游图库</a></li>
                    <li><a href="realestate.html">不动产服务</a></li>
                    <li><a href="about.html">关于我们</a></li>
                    <li class="cta"><a href="signin.html">登录</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>

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
        <form name=search_form onSubmit="return bottomForm(this);" method="post">
            <div class="midd_2" style="margin-bottom:0;">
                <div id="pt1" class="select">
                    <a class="midd-sj-5" id="s0">请选择地区</a>
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
                <div id="qt1" class="select">
                    <a class="midd-sj-6" id="q0">类型</a>
                    <div id="qt2" class="part">
                        <a id="q1" href="javascript:void(0);">全部</a>
                        <a id="q2" href="javascript:void(0);">东京</a>
                        <a id="q3" href="javascript:void(0);">大板</a>
                        <a id="q4" href="javascript:void(0);">京都</a>
                        <a id="q5" href="javascript:void(0);">神户</a>
                        <a id="q6" href="javascript:void(0);">札幌</a>
                        <a id="q7" href="javascript:void(0);">名古屋</a>
                        <a id="q8" href="javascript:void(0);">福冈</a>
                        <a id="q9" href="javascript:void(0);">横滨</a>
                        <a id="q10" href="javascript:void(0);">神奈川县</a>
                        <a id="q11" href="javascript:void(0);">奈良</a>
                        <a id="q12" href="javascript:void(0);">那霸</a>
                        <a id="q13" href="javascript:void(0);">名古屋</a>
                        <a id="q14" href="javascript:void(0);">福冈</a>
                        <a id="q15" href="javascript:void(0);">横滨</a>
                        <a id="q16" href="javascript:void(0);">神奈川县</a>
                        <a id="q17" href="javascript:void(0);">奈良</a>
                        <a id="q18" href="javascript:void(0);">那霸</a>
                        <a id="q19" href="javascript:void(0);">横滨</a>
                        <a id="q20" href="javascript:void(0);">神奈川县</a>
                        <a id="q21" href="javascript:void(0);">奈良</a>
                        <a id="q22" href="javascript:void(0);">那霸</a>
                    </div>
                </div>
                <div class="midd_12">
                    <div class="rendezvous-input-date" id="start">入住日期</div>
                    <div class="rendezvous-input-date" id="end">退房日期</div>
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

                    //自定义日期格式
                    laydate({
                        elem: '#test1',
                        format: 'YYYY年MM月DD日',
                        festival: true, //显示节日
                        choose: function (datas) { //选择日期完毕的回调
                            alert('得到：' + datas);
                        }
                    });

                    //日期范围限定在昨天到明天
                    laydate({
                        elem: '#hello3',
                        min: laydate.now(-1), //-1代表昨天，-2代表前天，以此类推
                        max: laydate.now(+1) //+1代表明天，+2代表后天，以此类推
                    });
                </script>
                <input type="submit" name="button" class="input" value="搜索">
                <div class="clearfix"></div>
            </div>
        </form>
        <div class="midd_13">
            <div class="left">
                <a href="javascript:void(0);"><span>人气</span><img src="images/9_08.png"></a>
                <a href="javascript:void(0);">价格<img src="images/9_10.png"></a>
                <a href="javascript:void(0);">销量<img src="images/9_10.png"></a>
            </div>
            <div class="right">
                <a href="list_map.html"><img src="images/8_03.png"><br>地图</a>
                <a href="list_grid.html"><img src="images/7_07.png"><br>网格</a>
                <a href="list_list.html"><img src="images/10_03.png"><br><span>列表</span></a>
            </div>
            <div class="clear"></div>
        </div>
        <div class="midd_15">找到相关结果约<span>100,000,000</span>个</div>
        <div class="midd_18"><a href="list.html">
                <div class="image2"><img src="images/image_1.png">
                    <div class="midd_16s"><span class="midd_16">推荐</span></div>
                </div>
                <div class="midd_19">
                    <div class="midd_20">新宿民宿</div>
                    <div class="midd_21"><span>和大自然的没融为一体</span><img src="images/10_10.png"><img src="images/10_10.png"><img
                            src="images/10_10.png"><img src="images/10_10.png"><img src="images/10_10.png"></div>
                    <div class="clear"></div>
                    <div class="midd_22">
                        东京安缦是东京这座传统与现代化首都一座具有里程碑意义的酒店，既散发都市活力气息，又不乏宁静。酒店坐落在大手町金融区，可轻松往返东京车站与热闹繁华的日本桥区。
                    </div>
                    <div class="midd_21"><img src="images/10_14.png"><span class="midd_23">東京都世田谷区玉川2-15-12 205室</span>
                    </div>
                </div>
                <div class="clear"></div>
            </a></div>
        <div class="midd_18"><a href="list.html">
                <div class="image2"><img src="images/image_1.png">
                    <div class="midd_16s"><span class="midd_17">折扣</span></div>
                </div>
                <div class="midd_19">
                    <div class="midd_20">新宿民宿</div>
                    <div class="midd_21"><span>和大自然的没融为一体</span><img src="images/10_10.png"><img src="images/10_10.png"><img
                            src="images/10_10.png"><img src="images/10_10.png"><img src="images/10_10.png"></div>
                    <div class="clear"></div>
                    <div class="midd_22">
                        东京安缦是东京这座传统与现代化首都一座具有里程碑意义的酒店，既散发都市活力气息，又不乏宁静。酒店坐落在大手町金融区，可轻松往返东京车站与热闹繁华的日本桥区。
                    </div>
                    <div class="midd_21"><img src="images/10_14.png"><span class="midd_23">東京都世田谷区玉川2-15-12 205室</span>
                    </div>
                </div>
                <div class="clear"></div>
            </a></div>
        <div class="midd_18"><a href="list.html">
                <div class="image2"><img src="images/image_1.png">
                    <div class="midd_16s"><span class="midd_16">推荐</span><span class="midd_17">折扣</span></div>
                </div>
                <div class="midd_19">
                    <div class="midd_20">新宿民宿</div>
                    <div class="midd_21"><span>和大自然的没融为一体</span><img src="images/10_10.png"><img src="images/10_10.png"><img
                            src="images/10_10.png"><img src="images/10_10.png"><img src="images/10_10.png"></div>
                    <div class="clear"></div>
                    <div class="midd_22">
                        东京安缦是东京这座传统与现代化首都一座具有里程碑意义的酒店，既散发都市活力气息，又不乏宁静。酒店坐落在大手町金融区，可轻松往返东京车站与热闹繁华的日本桥区。
                    </div>
                    <div class="midd_21"><img src="images/10_14.png"><span class="midd_23">東京都世田谷区玉川2-15-12 205室</span>
                    </div>
                </div>
                <div class="clear"></div>
            </a></div>
        <div class="midd_18"><a href="list.html">
                <div class="image2"><img src="images/image_1.png">
                    <div class="midd_16s"></div>
                </div>
                <div class="midd_19">
                    <div class="midd_20">新宿民宿</div>
                    <div class="midd_21"><span>和大自然的没融为一体</span><img src="images/10_10.png"><img src="images/10_10.png"><img
                            src="images/10_10.png"><img src="images/10_10.png"><img src="images/10_10.png"></div>
                    <div class="clear"></div>
                    <div class="midd_22">
                        东京安缦是东京这座传统与现代化首都一座具有里程碑意义的酒店，既散发都市活力气息，又不乏宁静。酒店坐落在大手町金融区，可轻松往返东京车站与热闹繁华的日本桥区。
                    </div>
                    <div class="midd_21"><img src="images/10_14.png"><span class="midd_23">東京都世田谷区玉川2-15-12 205室</span>
                    </div>
                </div>
                <div class="clear"></div>
            </a></div>
        <div class="midd_18"><a href="list.html">
                <div class="image2"><img src="images/image_1.png">
                    <div class="midd_16s"></div>
                </div>
                <div class="midd_19">
                    <div class="midd_20">新宿民宿</div>
                    <div class="midd_21"><span>和大自然的没融为一体</span><img src="images/10_10.png"><img src="images/10_10.png"><img
                            src="images/10_10.png"><img src="images/10_10.png"><img src="images/10_10.png"></div>
                    <div class="clear"></div>
                    <div class="midd_22">
                        东京安缦是东京这座传统与现代化首都一座具有里程碑意义的酒店，既散发都市活力气息，又不乏宁静。酒店坐落在大手町金融区，可轻松往返东京车站与热闹繁华的日本桥区。
                    </div>
                    <div class="midd_21"><img src="images/10_14.png"><span class="midd_23">東京都世田谷区玉川2-15-12 205室</span>
                    </div>
                </div>
                <div class="clear"></div>
            </a></div>
        <div class="midd_18"><a href="list.html">
                <div class="image2"><img src="images/image_1.png">
                    <div class="midd_16s"></div>
                </div>
                <div class="midd_19">
                    <div class="midd_20">新宿民宿</div>
                    <div class="midd_21"><span>和大自然的没融为一体</span><img src="images/10_10.png"><img src="images/10_10.png"><img
                            src="images/10_10.png"><img src="images/10_10.png"><img src="images/10_10.png"></div>
                    <div class="clear"></div>
                    <div class="midd_22">
                        东京安缦是东京这座传统与现代化首都一座具有里程碑意义的酒店，既散发都市活力气息，又不乏宁静。酒店坐落在大手町金融区，可轻松往返东京车站与热闹繁华的日本桥区。
                    </div>
                    <div class="midd_21"><img src="images/10_14.png"><span class="midd_23">東京都世田谷区玉川2-15-12 205室</span>
                    </div>
                </div>
                <div class="clear"></div>
            </a></div>
        <div id='pagina'>
            <a href='?tab=0&page=1'>上一页</a>
            <a href='?tab=0&page=1' class='number'>1</a>
            <a href='?tab=0&page=2'>2</a>
            <a href='?tab=0&page=3'>3</a>
            <a href='?tab=0&page=4'>4</a>
            <a href='?tab=0&page=5'>5</a>
            <a href='?tab=0&page=6'>6</a> &nbsp;
            ... <a href='?tab=0&page=22'>22</a>
            <a href='?tab=0&page=2'>下一页</a>
        </div>
    </div>
</div>
<footer id="fh5co-footer" role="contentinfo">
    <div class="container">
        <div class="midd_10 col-sm-push-0 col-xs-push-0">
            <h3>关于我们</h3>
            <p>美溪传媒車友倶楽部成立于2016年8月1日，是在日本东京投资注册的独立法人公司。<br>公司专致于提供日本境内旅游业务，为外国游客提供餐饮和娱乐服务，</p>
            <p><a href="#" class="btn btn-primary btn-outline with-arrow btn-sm">联系我们<i
                        class="icon-arrow-right"></i></a></p>
        </div>
        <div class="col-md-6 col-md-push-1 col-sm-12 col-sm-push-0 col-xs-12 col-xs-push-0">
            <ul class="float">
                <h3>联系方式</h3>
                <span>美溪车友传媒俱乐部</span>
                <li><a href="#"><img src="images/6_03.png">東京都世田谷区玉川2-15-12</a></li>
                <li><a href="#"><img src="images/6_07.png">090-0000-0000</a></li>
                <li><a href="#"><img src="images/6_10.png">090-0000-0000</a></li>
                <li><a href="#"><img src="images/6_13.png">090-0000-0000</a></li>
                <li><a href="#"><img src="images/6_17.png">contact@meixinpo.com</a></li>
            </ul>
            <div class="midd_65"><h3>微信公众号</h3><img src="images/17_03.jpg"></div>
        </div>
        <div class="clear"></div>
        <div class="midd_11">
            © 2016 美溪车友传媒俱乐部 All rights reserved
        </div>
    </div>
</footer>

<!-- 返回顶部 -->
<div id="top"><img src="images/top.png"></div>
<script>
    $('#top').click(function () {
        $('html,body').animate({scrollTop: '0px'}, 800);
        return false;
    });
</script>
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
            ["<?=$row['name']?>", "<?php echo $i?>"],

            <?php $i++;}?>
        }
            ;
            $$("s0").innerHTML = hbb[iType][0];
            $$("pt2").style.display = "none";
            SetCookie('sousuosss', iType);
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
    ["<?=$row['name']?>", "<?php echo $i?>"],

    <?php $i++;}?>
    }
    ;

    (function() {
    function initHead() {
        setTimeout(showSubSearch, 0)
    };
		function showSubSearch() {
        $$("q0").onclick = function() {
            $$("qt2").style.display = "block";
            $$("pt1").className = "select"
        };
		 $$("qt2").onclick = function() {
            $$("qt2").style.display = "none";
            $$("qt1").className = "select select_hover"
        };
        $$("q1").onclick = function() {
            selSubSearch(1);
            $$("q").focus()
        };
        $$("q2").onclick = function() {
            selSubSearch(2);
            $$("q").focus()
        };
        $$("q3").onclick = function() {
            selSubSearch(3);
            $$("q").focus()
        };
        $$("q4").onclick = function() {
            selSubSearch(4);
            $$("q").focus()
        };
        $$("q5").onclick = function() {
            selSubSearch(5);
            $$("q").focus()
        };
        $$("q6").onclick = function() {
            selSubSearch(6);
            $$("q").focus()
        };
        $$("q7").onclick = function() {
            selSubSearch(7);
            $$("q").focus()
        };
        $$("q8").onclick = function() {
            selSubSearch(8);
            $$("q").focus()
        };
        $$("q9").onclick = function() {
            selSubSearch(9);
            $$("q").focus()
        };
        $$("q10").onclick = function() {
            selSubSearch(10);
            $$("q").focus()
        };
        $$("q11").onclick = function() {
            selSubSearch(11);
            $$("q").focus()
        };
        $$("q12").onclick = function() {
            selSubSearch(12);
            $$("q").focus()
        };
		$$("q13").onclick = function() {
            selSubSearch(13);
            $$("q").focus()
        };
        $$("q14").onclick = function() {
            selSubSearch(14);
            $$("q").focus()
        };
        $$("q15").onclick = function() {
            selSubSearch(15);
            $$("q").focus()
        };
        $$("q16").onclick = function() {
            selSubSearch(16);
            $$("q").focus()
        };
        $$("q17").onclick = function() {
            selSubSearch(17);
            $$("q").focus()
        };
        $$("q18").onclick = function() {
            selSubSearch(18);
            $$("q").focus()
        };
        $$("q19").onclick = function() {
            selSubSearch(19);
            $$("q").focus()
        };
        $$("q20").onclick = function() {
            selSubSearch(20);
            $$("q").focus()
        };
        $$("q21").onclick = function() {
            selSubSearch(21);
            $$("q").focus()
        };
        $$("q22").onclick = function() {
            selSubSearch(22);
            $$("q").focus()
        };
    };

    function selSubSearch(iType) {
        hbb = [];
        hbb = {
				1 : ["全部", "5"],
				2 : ["东京", "8"],
				3 : ["大板", "9"],
				4 : ["京都", "9"],
				5 : ["神户", "12"],
				6 : ["札幌", "13"],
				7 : ["名古屋", "7"],
				8 : ["福冈", "10"],
				9 : ["横滨", "10"],
				10 : ["神奈川县", "10"],
				11 : ["奈良", "10"],
				12 : ["那霸", "10"],
				13 : ["名古屋", "10"],
				14 : ["福冈", "10"],
				15 : ["横滨", "10"],
				16 : ["神奈川县", "10"],
				17 : ["奈良", "10"],
				18 : ["那霸", "10"],
				19 : ["横滨", "10"],
				20 : ["神奈川县", "10"],
				21 : ["奈良", "10"],
				22 : ["那霸", "10"]
        };
        $$("q0").innerHTML = hbb[iType][0];
        $$("qt2").style.display = "none";
        SetCookie('sousuosss', iType);
        $$("catid").value = hbb[iType][1];
    };
    initHead();
})();

hbb = [];
hbb = {
				1 : ["全部", "5"],
				2 : ["东京", "8"],
				3 : ["大板", "9"],
				4 : ["京都", "9"],
				5 : ["神户", "5"],
				6 : ["札幌", "13"],
				7 : ["名古屋", "7"],
				8 : ["福冈", "10"],
				9 : ["横滨", "10"],
				10 : ["神奈川县", "10"],
				11 : ["奈良", "10"],
				12 : ["那霸", "10"],
				13 : ["名古屋", "10"],
				14 : ["福冈", "10"],
				15 : ["横滨", "10"],
				16 : ["神奈川县", "10"],
				17 : ["奈良", "10"],
				18 : ["那霸", "10"],
				19 : ["横滨", "10"],
				20 : ["神奈川县", "10"],
				21 : ["奈良", "10"],
				22 : ["那霸", "10"]
};
</script>
</body>
</html>

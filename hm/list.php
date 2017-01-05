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
                }
            }//欢迎来到站长 特效网，我们的网址是www.zzjs.net，很好记，zz站长，js就是js特效，本站收集大量高质量js代码，还有许多广告代码下载。
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
    <div class="midd_26"><img src="images/11_03.png"><a href="index.html">首页</a> > <a href="#">民宿</a> > <a
            href="list.html">东京丽思卡尔顿</a></div>
</div>
<div id="fh5co-work-section" class="fh5co-light-grey-section" style="padding:0;">
    <div class="container">
        <div class="midd_27">
            <div class="left midd_52">
                <div id="originalpic">
                    <li><a href="javascript:;"><img src="images/11_07.png" style="display: inline;"></a></li>
                    <li><a href="javascript:;"><img src="images/11_07.png"></a></li>
                    <li><a href="javascript:;"><img src="images/11_07.png"></a></li>
                    <li><a href="javascript:;"><img src="images/11_07.png"></a></li>
                    <li><a href="javascript:;"><img src="images/11_07.png"></a></li>
                    <a id="aPrev"
                       style="cursor: url(http://img.suofeiya.com.cn/themes/default/images/prev.cur), auto; height: 600px;"></a>
                    <a id="aNext"
                       style="cursor: url(http://img.suofeiya.com.cn/themes/default/images/next.cur), auto; height: 600px;"></a>
                </div>
                <div class="thumbpic"><a href="javascript:;" class="bntprev"></a>
                    <div id="piclist">
                        <ul>
                            <li class="hover"><a href="javascript:;"><img src="images/11_104.png"></a></li>
                            <li><a href="javascript:;"><img src="images/11_106.png"></a></li>
                            <li><a href="javascript:;"><img src="images/11_108.png"></a></li>
                            <li><a href="javascript:;"><img src="images/11_110.png"></a></li>
                            <li><a href="javascript:;"><img src="images/11_112.png"></a></li>
                        </ul>
                    </div>
                    <a href="javascript:;" class="bntnext"></a></div>
            </div>
            <div class="midd_28">
                <div class="midd_29">东京丽思卡尔顿</div>
                <div class="midd_48"><span>和大自然的没融为一体</span> <span><img src="images/11_10.png"><img
                            src="images/11_10.png"><img src="images/11_10.png"><img src="images/11_10.png"><img
                            src="images/11_10.png"></span></div>
                <ul class="midd_49">
                    <li><a href="#"><img src="images/11_14.png">東京都世田谷区玉川2-15-12</a></li>
                    <li><a href="#"><img src="images/11_17.png">090-0000-0000</a></li>
                    <li><a href="#"><img src="images/11_19.png">mei@163.com</a></li>
                </ul>
                <div class="midd_50">
                    <div class="midd_51"><span class="midd_53">5.0</span><span>/</span>分<br>
                        顾客评分
                    </div>
                    <div class="midd_54"><span class="midd_55">156</span><span>/</span>次<br>
                        评论数量
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="midd_56"><span>设施：</span> <img src="images/13_03.png"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="midd_27">
            <div class="midd_30">酒店介绍</div>
            <p class="midd_31">
                第一家丽思·卡尔顿酒店于1927年在波士顿建立，该酒店已经出售给泰姬陵酒店度假村管理公司。纽约的丽思·卡尔顿酒店繁华的曼哈顿地区第四十六街和麦迪逊大道的交汇处。佛罗里达州的那不勒斯市（Naples,
                Florida）是唯一一个丽思·卡尔顿酒店在同一条马路上的城市。丽思卡尔顿酒店管理集团还在美国及其周边地区提供部分房屋所有权的服务，将之命名为丽思卡尔顿俱乐部。这些不动产位于科罗拉多、维尔京群岛以及旧金山。1998年，万豪酒店国际集团收购了丽思·卡尔顿酒店集团公司的全部股份。</p>
            <p class="midd_31">
                丽思·卡尔顿作为全球首屈一指的奢华酒店品牌，从19世纪创建以来，一直遵从着经典的风格，成为名门、政要下榻的必选酒店。因为极度高贵奢华，她一向被称为“全世界的屋顶”，尤其是她的座右铭“我们以绅士淑女的态度为绅士淑女们忠诚服务”更是在业界被传为经典。不管在哪个城市，只要有丽思酒店，一定是国家政要和社会名流下榻的首选。巴黎的丽思更是全欧洲最豪华神秘的酒店，威尔士亲王、瑞典、葡萄牙、西班牙的国王都曾经在这里入住或就餐。戴安娜王妃遭遇车祸前的最后一顿美好的晚餐也是在那里享用。可可·夏奈尔甚至说：“每当我梦见死后在天堂的生活时，梦中的场景总是发生在丽思酒店。”</p>
            <div class="midd_30">房屋选择</div>
            <div class="midd_32"><a href="list.html">
                    <div class="midd_33"><img src="images/11_128.png"></div>
                    <div class="midd_34">
                        <div class="midd_35">双人大床房</div>
                        <div class="midd_36">和大自然的没融为一体</div>
                        <div class="midd_36">最大人数：大人*2、小孩*5</div>
                    </div>
                    <div class="midd_37"><span>￥</span><span class="midd_38">526</span> / 每晚</div>
                </a>
                <div class="midd_39">预定</div>
                <div class="clear"></div>
            </div>
            <div class="tanchuang">
                <div class="midd_57"><img src="images/14_03.png"></div>
                <div class="midd_58">在线预约</div>
                <div class="midd_59"><span>入住日期：</span>
                    <div class="midd_60">
                        <div class="rendezvous-input-date" id="start"></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="midd_59"><span>退房日期：</span>
                    <div class="midd_60">
                        <div class="rendezvous-input-date" id="end"></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="midd_59"><span>成人：</span>
                    <select name="select" class="input_3">
                    </select>
                    <div class="clear"></div>
                </div>
                <div class="midd_59"><span>儿童（0-5岁）：</span>
                    <select name="select" class="input_3">
                    </select>
                    <div class="clear"></div>
                </div>
                <div class="midd_59"><span>备注：</span>
                    <textarea name="textarea" class="input_4"></textarea>
                    <div class="clear"></div>
                </div>
                <input type="submit" name="button" class="input_5" value="立即预约"
                       onclick="window.location='payment.html';">
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
                <script>$(function () {
                        $(".midd_39").click(function () {
                            $(".tanchuang,.tanchuang1").slideToggle();
                        });
                        $(".midd_57").click(function () {
                            $(".tanchuang,.tanchuang1").slideToggle();
                        });
                    });
                </script>
            </div>
            <div class="tanchuang1"></div>
            <div class="midd_32"><a href="list.html">
                    <div class="midd_33"><img src="images/11_128.png"></div>
                    <div class="midd_34">
                        <div class="midd_35">双人大床房</div>
                        <div class="midd_36">和大自然的没融为一体</div>
                        <div class="midd_36">最大人数：大人*2、小孩*5</div>
                    </div>
                    <div class="midd_37"><span>￥</span><span class="midd_38">526</span> / 每晚</div>
                </a>
                <div class="midd_39">预定</div>
                <div class="clear"></div>
            </div>
            <div class="midd_32"><a href="list.html">
                    <div class="midd_33"><img src="images/11_128.png"></div>
                    <div class="midd_34">
                        <div class="midd_35">双人大床房</div>
                        <div class="midd_36">和大自然的没融为一体</div>
                        <div class="midd_36">最大人数：大人*2、小孩*5</div>
                    </div>
                    <div class="midd_37"><span>￥</span><span class="midd_38">526</span> / 每晚</div>
                </a>
                <div class="midd_39">预定</div>
                <div class="clear"></div>
            </div>
            <div class="midd_32"><a href="list.html">
                    <div class="midd_33"><img src="images/11_128.png"></div>
                    <div class="midd_34">
                        <div class="midd_35">双人大床房</div>
                        <div class="midd_36">和大自然的没融为一体</div>
                        <div class="midd_36">最大人数：大人*2、小孩*5</div>
                    </div>
                    <div class="midd_37"><span>￥</span><span class="midd_38">526</span> / 每晚</div>
                </a>
                <div class="midd_39">预定</div>
                <div class="clear"></div>
            </div>
            <div class="midd_30">地图</div>
            <img src="images/11_131.png" style="margin-top:10px; margin-bottom:22px;">
            <div class="midd_30">网友评论</div>
            <div class="midd_40">
                <div class="left">整体评分：<span>4.7</span>/分</div>
                <img src="images/11_10.png"><img src="images/11_10.png"><img src="images/11_10.png"><img
                    src="images/11_10.png"><img src="images/11_10.png"></div>
            <div class="midd_41">
                <div class="midd_42"><img src="images/13.jpg"><span>小鱼儿</span></div>
                <div class="left">
                    <div class="midd_43"><img src="images/10_10.png"><img src="images/10_10.png"><img
                            src="images/10_10.png"><img src="images/10_10.png"><img src="images/10_10.png"><span>2016-10-25</span>
                        <div class="clear"></div>
                    </div>
                    <div class="midd_44">环境不错 性价比高 房间不错 这家酒店位置特别好找就在总统大厦旁边 房间设施也很好 特别是前台的服务很好 每次路过前台都是微笑的打招呼
                        对客人提出的要求也都尽最大的努力满足 跟前台经理张毅已经成了很熟的朋友 非常有家的感觉 强烈推荐
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="midd_41">
                <div class="midd_42"><img src="images/13.jpg"><span>小鱼儿</span></div>
                <div class="left">
                    <div class="midd_43"><img src="images/10_10.png"><img src="images/10_10.png"><img
                            src="images/10_10.png"><img src="images/10_10.png"><img src="images/10_10.png"><span>2016-10-25</span>
                        <div class="clear"></div>
                    </div>
                    <div class="midd_44">环境不错 性价比高 房间不错 这家酒店位置特别好找就在总统大厦旁边 房间设施也很好 特别是前台的服务很好 每次路过前台都是微笑的打招呼
                        对客人提出的要求也都尽最大的努力满足 跟前台经理张毅已经成了很熟的朋友 非常有家的感觉 强烈推荐
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="midd_41">
                <div class="midd_42"><img src="images/13.jpg"><span>小鱼儿</span></div>
                <div class="left">
                    <div class="midd_43"><img src="images/10_10.png"><img src="images/10_10.png"><img
                            src="images/10_10.png"><img src="images/10_10.png"><img src="images/10_10.png"><span>2016-10-25</span>
                        <div class="clear"></div>
                    </div>
                    <div class="midd_44">环境不错 性价比高 房间不错 这家酒店位置特别好找就在总统大厦旁边 房间设施也很好 特别是前台的服务很好 每次路过前台都是微笑的打招呼
                        对客人提出的要求也都尽最大的努力满足 跟前台经理张毅已经成了很熟的朋友 非常有家的感觉 强烈推荐
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="midd_41">
                <div class="midd_42"><img src="images/13.jpg"><span>小鱼儿</span></div>
                <div class="left">
                    <div class="midd_43"><img src="images/10_10.png"><img src="images/10_10.png"><img
                            src="images/10_10.png"><img src="images/10_10.png"><img src="images/10_10.png"><span>2016-10-25</span>
                        <div class="clear"></div>
                    </div>
                    <div class="midd_44">环境不错 性价比高 房间不错 这家酒店位置特别好找就在总统大厦旁边 房间设施也很好 特别是前台的服务很好 每次路过前台都是微笑的打招呼
                        对客人提出的要求也都尽最大的努力满足 跟前台经理张毅已经成了很熟的朋友 非常有家的感觉 强烈推荐
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="midd_41">
                <div class="midd_42"><img src="images/13.jpg"><span>小鱼儿</span></div>
                <div class="left">
                    <div class="midd_43"><img src="images/10_10.png"><img src="images/10_10.png"><img
                            src="images/10_10.png"><img src="images/10_10.png"><img src="images/10_10.png"><span>2016-10-25</span>
                        <div class="clear"></div>
                    </div>
                    <div class="midd_44">环境不错 性价比高 房间不错 这家酒店位置特别好找就在总统大厦旁边 房间设施也很好 特别是前台的服务很好 每次路过前台都是微笑的打招呼
                        对客人提出的要求也都尽最大的努力满足 跟前台经理张毅已经成了很熟的朋友 非常有家的感觉 强烈推荐
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="midd_41">
                <div class="midd_42"><img src="images/13.jpg"><span>小鱼儿</span></div>
                <div class="left">
                    <div class="midd_43"><img src="images/10_10.png"><img src="images/10_10.png"><img
                            src="images/10_10.png"><img src="images/10_10.png"><img src="images/10_10.png"><span>2016-10-25</span>
                        <div class="clear"></div>
                    </div>
                    <div class="midd_44">环境不错 性价比高 房间不错 这家酒店位置特别好找就在总统大厦旁边 房间设施也很好 特别是前台的服务很好 每次路过前台都是微笑的打招呼
                        对客人提出的要求也都尽最大的努力满足 跟前台经理张毅已经成了很熟的朋友 非常有家的感觉 强烈推荐
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div id='pagina'><a href='?tab=0&page=1'>上一页</a> <a href='?tab=0&page=1' class='number'>1</a> <a
                    href='?tab=0&page=2'>2</a> <a href='?tab=0&page=3'>3</a> <a href='?tab=0&page=4'>4</a> <a
                    href='?tab=0&page=5'>5</a> <a href='?tab=0&page=6'>6</a> &nbsp;
                ... <a href='?tab=0&page=22'>22</a> <a href='?tab=0&page=2'>下一页</a></div>
            <textarea name="textarea" class="input_1" placeholder="输入你的留言..."></textarea>
            <div class="midd_45">
                <div class="left" onmouseover="rate(this,event)"><span>评价：</span><img src="images/11_135.png"><img
                        src="images/11_135.png"><img src="images/11_135.png"><img src="images/11_135.png"><img
                        src="images/11_135.png"></div>
                <div class="right">
                    <input type="submit" name="button" class="midd_39s" style="margin-top:0;" value="确认评价">
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="midd_27">
            <div class="midd_46">推荐民宿</div>
            <div class="midd_47"><a href="list.html"><img src="images/11_138.png"><span>新宿民宿</span></a></div>
            <div class="midd_47"><a href="list.html"><img src="images/11_138.png"><span>新宿民宿</span></a></div>
            <div class="midd_47"><a href="list.html"><img src="images/11_138.png"><span>新宿民宿</span></a></div>
            <div class="midd_47"><a href="list.html"><img src="images/11_138.png"><span>新宿民宿</span></a></div>
            <div class="midd_47" style="margin-right:0;"><a href="list.html"><img
                        src="images/11_138.png"><span>新宿民宿</span></a></div>
            <div class="clear"></div>
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

<!-- 产品图片 -->
<script src="js/slider.photo.js"></script>
<script
    type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
    document.write(unescape("%3Cspan id='cnzz_stat_icon_1253179997'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s13.cnzz.com/z_stat.php%3Fid%3D1253179997' type='text/javascript'%3E%3C/script%3E"));
    document.getElementById('cnzz_stat_icon_1253179997').style.display = 'none';</script>
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
</script>
</body>
</html>

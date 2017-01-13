<?php require_once 'coon.php';
$navid = 9;
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
    <?php require_once 'top.php'; ?>
    <script type="text/javascript"
            src="https://www.google.com/maps/api/js?key=AIzaSyDTRl1x8xftFpAmxhl76bzStKmA8aNGCYY&sensor=false"></script>
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
                    $rs1 = $pdo->query("SELECT * FROM pm_hotel_file WHERE lang = 2 AND id_item = " . $row['id'] . " ");
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
                            $rs1 = $pdo->query("SELECT * FROM pm_hotel_file WHERE lang = 2 AND id_item = " . $row['id'] . " ");
                            $i = 1;
                            while ($row1 = $rs1->fetch()) {
                                ?>
                                <li<?php if ($i == 1){ ?> class="hover"<?php } ?>"><a href="javascript:;"><img src="/medias/hotel/medium/<?php echo $row1['id']?>/<?php echo $row1['file']?>" width="120" height="86"></a></li>
                                <?php } ?>
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
                            echo round($row1[0], 1) ?></span><span>/</span>分<br>
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
                        src="/medias/facility/big/<?php echo $row1['rank'] ?>/<?php echo $row1['file'] ?>"
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
                        <div class="midd_37"><span>￥</span><span class="midd_38"><?php echo $row2['price'] ?></span> /
                            每晚
                        </div>
                    </a>
                    <div class="midd_39" date-id="<?php echo $row2['id']?>">预定</div>
                    <div class="clear"></div>
                </div>
            <?php } ?>
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

                    $(function () {
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

            <div class="midd_30">地图</div>
            <div id="mainMap" style="width: 1100px;height: 480px;"></div>
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
        }
        //调用函数实现功能要求
        setVeiwPort();
    };
    $(function () {
        googleMapOperation();
    });
</script>
</body>
</html>

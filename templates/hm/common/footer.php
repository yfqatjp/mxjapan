<?php debug_backtrace() || die ("Direct access not permitted"); ?>
<footer id="fh5co-footer" role="contentinfo">
    <div class="container">
        <div class="midd_10 col-sm-push-0 col-xs-push-0">
            <h3>关于我们</h3>
            <p>美溪传媒車友倶楽部成立于2016年8月1日，是在日本东京投资注册的独立法人公司。<br>公司专致于提供日本境内旅游业务，为外国游客提供餐饮和娱乐服务，</p>
            <p><a href="about.php" class="btn btn-primary btn-outline btn-sm">查看更多</a></p>
        </div>
        <div class="col-md-6 col-md-push-1 col-sm-12 col-sm-push-0 col-xs-12 col-xs-push-0">
            <ul class="float">
                <h3>联系方式</h3>
                <span><?php echo constant("SITE_TITLE"); ?></span>
                <li><a href="#"><img
                            src="<?php echo DOCBASE . "templates/" . TEMPLATE; ?>/images/6_03.png"><?php echo constant("ADDRESS"); ?>
                    </a></li>
                <li><a href="#"><img
                            src="<?php echo DOCBASE . "templates/" . TEMPLATE; ?>/images/6_07.png"><?php echo constant("PHONE"); ?>
                    </a></li>
                <li><a href="#"><img
                            src="<?php echo DOCBASE . "templates/" . TEMPLATE; ?>/images/6_10.png"><?php echo constant("MOBILE"); ?>
                    </a></li>
                <li><a href="#"><img
                            src="<?php echo DOCBASE . "templates/" . TEMPLATE; ?>/images/6_13.png"><?php echo constant("FAX"); ?>
                    </a></li>
                <li><a href="#"><img
                            src="<?php echo DOCBASE . "templates/" . TEMPLATE; ?>/images/6_17.png"><?php echo constant("EMAIL"); ?>
                    </a></li>
            </ul>
            <div class="midd_65"><h3>微信公众号</h3><img src="<?php echo constant("OWNER"); ?>"></div>
        </div>
        <div class="clear"></div>
        <div class="midd_11">
            © <?php echo date("Y"); ?>
            <?php echo constant("SITE_TITLE") . " " . $texts['ALL_RIGHTS_RESERVED']; ?>
        </div>
    </div>
</footer>
<div id="top"><img src="<?php echo DOCBASE . "templates/" . TEMPLATE; ?>/images/top.png"></div>
<!-- jQuery Easing -->
<script src="<?php echo getFromTemplate("js/jquery.easing.1.3.js"); ?>"></script>
<!-- Bootstrap -->
<script src="<?php echo getFromTemplate("js/bootstrap.min.js"); ?>"></script>
<!-- Waypoints -->
<script src="<?php echo getFromTemplate("js/jquery.waypoints.min.js"); ?>"></script>
<!-- Owl Carousel -->
<script src="<?php echo getFromTemplate("js/owl.carousel.min.js"); ?>"></script>
<!-- Flexslider -->
<script src="<?php echo getFromTemplate("js/jquery.flexslider-min.js"); ?>"></script>

<!-- MAIN JS -->
<script src="<?php echo getFromTemplate("js/main.js"); ?>"></script>

<script>
    $('#top').click(function () {
        $('html,body').animate({scrollTop: '0px'}, 800);
        return false;
    });
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
            $result_hotel = $db->query("SELECT * FROM pm_destination WHERE `checked` = 1");
            foreach($result_hotel as $i => $row){
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
            $result_hotel = $db->query("SELECT * FROM pm_destination WHERE `checked` = 1");
            foreach($result_hotel as $i => $row){
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
    $result_hotel = $db->query("SELECT * FROM pm_destination WHERE `checked` = 1");
    foreach($result_hotel as $i => $row){
    ?>
    <?php echo $i?> :
    ["<?=$row['name']?>", "<?php echo $i?>"],

    <?php $i++;}?>
    }
    ;
    if (GetCookie('sousuosss')) {
        var sss = GetCookie('sousuosss');
    }
</script>
</body>
</html>
<?php
$_SESSION['msg_error'] = "";
$_SESSION['msg_success'] = "";
$_SESSION['msg_notice'] = ""; ?>

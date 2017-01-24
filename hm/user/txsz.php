<?php require_once '../coon.php';
if (@$_SESSION['userid'] == "") {
    header("Location: /signin.html");
    exit;
}
$txt = "头像设置";
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
    <script>
        $(function () {
            if ($('#form').length > 0) {
                jQuery('#form').validationEngine({
                    showOneMessage: true,
                    addPromptClass: "formError-white",
                    promptPosition: 'inline'
                })
            }
        })
        function UpladFile() {
            fileObj = document.getElementById("file").files[0];
            if (fileObj) {
                $('body').append('<img src="/images/loading.gif" class="load"><div class="load2"></div>');
                var FileController = '/hm/upload.php?xx=tou';
                var form = new FormData();
                form.append("myfile", fileObj);
                createXMLHttpRequest();
                xhr.onreadystatechange = handleStateChange;
                xhr.open("post", FileController, true);
                xhr.send(form);
            }
        }

        function createXMLHttpRequest() {
            if (window.ActiveXObject) {
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }
            else if (window.XMLHttpRequest) {
                xhr = new XMLHttpRequest();
            }
        }

        function handleStateChange() {
            if (xhr.readyState == 4) {
                if (xhr.status == 200 || xhr.status == 0) {
                    var result = xhr.responseText;
                    $('.load').remove();
                    $('.load2').remove();
                    if (result == "") {
                        alert('上传失败')
                        return;
                    }
                    var json = eval("(" + result + ")");
                    if (json.tai == "ok") {
                        $(' .tou').attr('src', json.file);
                    } else {
                        alert(json.file)
                    }
                }
            }
        }
    </script>
    <style>
        .load {
            margin-top: -62px;
            margin-left: -62px;
            position: absolute;
            left: 50%;
            top: 50%;
            z-index: 999;
        }

        .load2 {
            background: #000;
            opacity: 0.2;
            position: absolute;
            z-index: 998;
            height: 100%;
            width: 100%;
            left: 0;
            top: 0;
            right: 0;
            bottom: 0;
        }

    </style>
</head>
<body>
<div class="sehun"></div>
<?php require_once '../head.php';
?>

<div class="midd_26"><img src="../images/11_03.png"><a href="/index.html">首页</a> > <a href="/user">个人中心</a> > <a
        href="txsz.html">头像设置</a></div>

<div class="midd_auto user">
    <!-- 左侧导航 -->
    <?php $nleft = 4;
    require_once 'left.php'; ?>
    <!-- 右侧 -->
    <div class="user_4">
        <div class="midd_68"><span>头像设置</span></div>
        <div class="midd_center midd_top65"><img src="<?= $rou['ico'] ?>" class="tou" onerror="this.src='/images/default.jpg'"></span>
            <input type="file" id="file" runat="server" name="file" onchange="UpladFile()" accept="image/*"
                   capture="camera" style="display:none"/></div>
        <input type="submit" name="button" class="input_14" onclick="file.click();" value="选择">
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

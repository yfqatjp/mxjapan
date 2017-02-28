<?php require_once '../coon.php';
if (@$_SESSION['userid'] == "") {
    header("Location: /signin.html");
    exit;
}
$_SESSION['formcode'] = rfc_encode(mt_rand(0, 1000000));
$txt = "爱车设置";
//
require_once $_SERVER['DOCUMENT_ROOT'] . '/common/HmWeb.php';
//
$token = $hmWeb->getToken();

// 取得原来爱车设置的信息
$charterUserRow = $pdo->query("SELECT * FROM pm_charter_user WHERE user_id = " .  $_SESSION['userid']);
//
$arrCharterUser = array();
if ($charterUserRow != null && $charterUserRow->rowCount() > 0) {
	$arrCharterUser = $charterUserRow->fetch();
}

$set_type = 0;
if (isset($arrCharterUser["set_type"])) {
	$set_type = $arrCharterUser["set_type"];
}

$arrChoiceWeek = array();
if (isset($arrCharterUser["week"])) {
	if (!empty($arrCharterUser["week"])) {
		$arrChoiceWeek = explode("," , $arrCharterUser["week"]);
	}
}

$start_date = "";
if (isset($arrCharterUser["start_date"])) {
	if (!empty($arrCharterUser["start_date"])) {
		$start_date = date("Y-m-d", $arrCharterUser["start_date"]);
	}
}

$end_date = "";
if (isset($arrCharterUser["end_date"])) {
	if (!empty($arrCharterUser["end_date"])) {
		$end_date = date("Y-m-d", $arrCharterUser["end_date"]);
	}
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
<?php require_once '../head.php';
?>

<div class="midd_26"><img src="../images/11_03.png"><a href="/index.html">首页</a> > <a href="/user">个人中心</a> > <a
        href="acsz.html">爱车设置</a></div>

<div class="midd_auto user">
    <!-- 左侧导航 -->
    <?php $nleft = 10;
    require_once 'left.php';
    ?>
    <!-- 右侧 -->
    <form action="/action.html?acsz=post" method="post" name="form" id="form">
        <input type="hidden" name="<?php echo $hmWeb->token_name?>" value="<?php echo $token ?>">
        <input type="hidden" name="start_date" id="start_date" value="<?php echo $start_date ?>">
        <input type="hidden" name="end_date" id="end_date" value="<?php echo $end_date ?>">
        <div class="user_4">
            <div class="midd_68"><span>爱车设置-不接单时间设置</span></div>
            <div class="user_17 midd_top55">
                <span>设置类型：</span>
                <input type="radio" name="set_type" value="0" id="set_type_0" <?php if ($set_type == "0") {echo 'checked';}?> onclick="clickRadio();"><label for="set_type_0">不设置</label>&nbsp;&nbsp;
                <input type="radio" name="set_type" value="1" id="set_type_1" <?php if ($set_type == "1") {echo 'checked';}?> onclick="clickRadio();"><label for="set_type_1">每周</label>&nbsp;&nbsp;
                <input type="radio" name="set_type" value="2" id="set_type_2" <?php if ($set_type == "2") {echo 'checked';}?> onclick="clickRadio();"><label for="set_type_2">日期范围</label>
                <div class="clear"></div>
            </div>
            
            <div class="user_17" id="weekradio_1" style="display:none;">
                <span>周期：</span>
                <input type="checkbox" name="week[]" value="1" id="week_1" <?php if (in_array("1", $arrChoiceWeek)) {echo 'checked';}?> ><label for="week_1">周一</label>&nbsp;&nbsp;
                <input type="checkbox" name="week[]" value="2" id="week_2" <?php if (in_array("2", $arrChoiceWeek)) {echo 'checked';}?> ><label for="week_2">周二</label>&nbsp;&nbsp;
                <input type="checkbox" name="week[]" value="3" id="week_3" <?php if (in_array("3", $arrChoiceWeek)) {echo 'checked';}?> ><label for="week_3">周三</label>&nbsp;&nbsp;
                <input type="checkbox" name="week[]" value="4" id="week_4" <?php if (in_array("4", $arrChoiceWeek)) {echo 'checked';}?> ><label for="week_4">周四</label>&nbsp;&nbsp;
                <input type="checkbox" name="week[]" value="5" id="week_5" <?php if (in_array("5", $arrChoiceWeek)) {echo 'checked';}?> ><label for="week_5">周五</label>&nbsp;&nbsp;
                <input type="checkbox" name="week[]" value="6" id="week_6" <?php if (in_array("6", $arrChoiceWeek)) {echo 'checked';}?> ><label for="week_6">周六</label>&nbsp;&nbsp;
                <input type="checkbox" name="week[]" value="7" id="week_7" <?php if (in_array("7", $arrChoiceWeek)) {echo 'checked';}?> ><label for="week_7">周日</label>
                <div class="clear"></div>
            </div>
            
            <div class="user_17" id="weekradio_2" style="display:none;">
                <span>日期：</span>
                <div class="rendezvous-input-date" id="start" style="width:156px;background-position:122px center;">选择开始日期</div>
                <div class="rendezvous-input-date" id="end" style="width:156px;background-position:122px center;">选择结束日期</div>
                <div class="clear"></div>
            </div>
                   
            <input type="submit" name="button" class="input_14" value="确认">
        </div>
        <div class="clear"></div>
    </form>
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
        <!-- 选择日期 --> 
        <script type="text/javascript" src="/js/laydate.js"></script> 
        <script type="text/javascript">
!function(){
	laydate.skin('dahong');//切换皮肤，请查看skins下面皮肤库
	//laydate({elem: '#demo'});//绑定元素
}();

//日期范围限制
var start = {
    elem: '#start',
    format: 'YYYY-MM-DD',
    max: '2099-06-16', //最大日期
    istime: true,
    istoday: false,
    start:$("#start_date").val(),
    choose: function(datas){
         end.min = datas; //开始日选好后，重置结束日的最小日期
         end.start = datas //将结束日的初始值设定为开始日
         $("#start_date").val(datas);
    }
};

var end = {
    elem: '#end',
    format: 'YYYY-MM-DD',
    max: '2099-06-16',
    istime: true,
    istoday: false,
    start:$("#end_date").val(),
    choose: function(datas){
        start.max = datas; //结束日选好后，充值开始日的最大日期
        $("#end_date").val(datas);
    }
};
laydate(start);
laydate(end);


</script>
<!-- 导航 -->
<script>
    $(function () {
        if ($("#start_date").val() != "") {
        	$("#start").html($("#start_date").val());
        }

        if ($("#end_date").val() != "") {
        	$("#end").html($("#end_date").val());
        }
        
    });

    clickRadio();
    function clickRadio() {
        var checked = $("input[name='set_type']:checked").val();
        if (checked == "1") {
            $("#weekradio_1").show();
            $("#weekradio_2").hide();
        } else if (checked == "2") {
        	$("#weekradio_1").hide();
        	$("#weekradio_2").show();
        }else {
        	$("#weekradio_1").hide();
        	$("#weekradio_2").hide();
        }
            
    }
</script>
</body>
</html>

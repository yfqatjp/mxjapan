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


$settingId = 0;
if (isset($_GET["id"])) {
	$settingId = $_GET["id"];
	
	//
	if (isset($_GET["do"]) && $_GET["do"] == "delete") {
		$pdo->query("delete from  pm_charter_user_setting WHERE id = " .  $settingId);
		$settingId = 0;
	}
}

// 取得原来爱车设置的信息
$charterUserRow = $pdo->query("SELECT * FROM pm_charter_user_setting WHERE id = " .  $settingId);
//
$arrCharterUser = array();
if ($charterUserRow != null && $charterUserRow->rowCount() > 0) {
	$arrCharterUser = $charterUserRow->fetch();
}

$start_date = "";
if (isset($arrCharterUser["start_date"])) {
	if (!empty($arrCharterUser["start_date"]) && $arrCharterUser["start_date"] > 0) {
		$start_date = date("Y-m-d", $arrCharterUser["start_date"]);
	}
}

$end_date = "";
if (isset($arrCharterUser["end_date"])) {
	if (!empty($arrCharterUser["end_date"]) && $arrCharterUser["end_date"] > 0) {
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
        <input type="hidden" name="setting_id" id="setting_id" value="<?php echo $settingId;?>">
        <input type="hidden" name="start_date" id="start_date" value="<?php echo $start_date ?>">
        <input type="hidden" name="end_date" id="end_date" value="<?php echo $end_date ?>">
        <div class="user_4">
            <div class="midd_68"><span>爱车设置-不接单时间设置</span></div>
            <div class="user_17" id="weekradio_2" >
                <span style="width:100px;">不接单日期：</span>
                <div class="rendezvous-input-date" id="start" style="width:156px;background-position:122px center;">选择开始日期</div>
                <div class="rendezvous-input-date" id="end" style="width:156px;background-position:122px center;">选择结束日期</div>
                <div class="clear"></div>
            </div>
                   
            <input type="submit" name="button" class="input_14" value="确认">
            
            <br/>
            
            		<table width="80%" border="0" cellspacing="0" cellpadding="0" class="user_13" align="center">
            <tr class="user_14">
                <td width="35%" align="center">开始日期</td>
                <td width="35%" align="center">结束日期</td>
                <td width="30%" align="center">订单操作</td>
            </tr>
            <?php
            $rs = $pdo->query("SELECT a.* FROM pm_charter_user_setting AS a WHERE a.user_id = " . $_SESSION['userid'] . " order by id desc ");
            while ($row = $rs->fetch()) {
                    ?>
                    <tr>
                        <td align="center">
                            <?php if (!empty($row['start_date'])) { ?>
                            	<?php echo date('Y-m-d', $row['start_date']) ?>
                            	<?php } ?>
                        </td>
						<td align="center">
                            <?php if (!empty($row['end_date'])) { ?>
                            	<?php echo date('Y-m-d', $row['end_date']) ?>
                            	<?php } ?>
                        </td>
                        <td align="center">
                        	<a href="/user/acsz.html?id=<?php echo $row['id'];?>">编辑</a> &nbsp;&nbsp;&nbsp;&nbsp;
                        	<a href="/user/acsz.html?do=delete&id=<?php echo $row['id'];?>">删除</a>
                        </td>
                    </tr>
                <?php 
            } ?>
        </table>
        
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


</script>
</body>
</html>

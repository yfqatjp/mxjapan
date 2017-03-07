<?php 

require_once 'coon.php';
$navid = 5;

$rs = $pdo->query("SELECT * FROM `pm_page` WHERE `lang` = '2' AND id = " . $navid);
$row = $rs->fetch();

$rs2 = $pdo->query("SELECT * FROM pm_article_file WHERE checked = 1 AND lang = 2 AND type = 'image' AND file != '' ORDER BY rank LIMIT 1");
$row2 = $rs2->fetch();

//
require_once $_SERVER['DOCUMENT_ROOT'] . '/common/HmWeb.php';

// 车导ID
$charterId = $hmWeb->query("id", 0);

// 车导情报
$charterSql = "SELECT * FROM `pm_charter` WHERE `lang` = '2' AND id = ? ";

// 取得车导情报
$arrCharter = $hmWeb->findOne($charterSql, array($charterId));

// 车导情报取不到的时候，跳转到一览画面
if ($arrCharter == null || count($arrCharter) == 0) {
	// 非法请求
	header("Location: guide.html");
	exit();
}

// 图片的sql
$charterFileSql = "SELECT * FROM pm_charter_file WHERE id_item = ? AND checked = 1 AND lang = ".$hmWeb->defaultLang." AND type = 'image' AND file != '' ORDER BY rank ";

$arrCharterImages = array();
// 一览的图片设定
$arrCharterFileResult = $hmWeb->findAll($charterFileSql, array($charterId));
if ($arrCharterFileResult != null && count($arrCharterFileResult) > 0) {
	foreach($arrCharterFileResult as $arrImageResult) {
		$arrImages = array();
		$file_id = $arrImageResult['id'];
		$filename = $arrImageResult['file'];
		$realpath = $_SERVER['DOCUMENT_ROOT']."/medias/charter/small/".$file_id."/".$filename;
		$thumbpath = "/medias/charter/small/".$file_id."/".$filename;
		if (is_file($realpath)) {
			$arrImages["small_image"] = $thumbpath;
		} else {
			$arrImages["small_image"] = "";
		}
		
		$realpath = $_SERVER['DOCUMENT_ROOT']."/medias/charter/big/".$file_id."/".$filename;
		$thumbpath = "/medias/charter/big/".$file_id."/".$filename;
		if (is_file($realpath)) {
			$arrImages["big_image"] = $thumbpath;
		} else {
			$arrImages["big_image"] = "";
		}
		$arrImages["image_label"] = $arrImageResult["label"];
		if (!empty($arrImages["big_image"]) && !empty($arrImages["small_image"])) {
			$arrCharterImages[] = $arrImages;
		}
	}
}

// 路线
$arrCharterLines = array();
// sql
$lineSql = "SELECT * FROM pm_charter_line WHERE id_charter = ?  ORDER BY sort ASC ";
$lineImageSql = "SELECT * FROM pm_charter_line_file WHERE id_item = ? AND checked = 1 AND type = 'image' AND file != '' ORDER BY rank ";

//
$arrLineData = $hmWeb->findAll($lineSql, array($charterId));
foreach($arrLineData as $lineData) {
	//
	$arrLineImages = array();
	//
	$arrLineImageData = $hmWeb->findAll($lineImageSql, array($lineData["id"]));
	if ($arrLineImageData != null && count($arrLineImageData) > 0) {
		foreach($arrLineImageData as $lineImageData) {
			$arrImages = array();
			$file_id = $lineImageData['id'];
			$filename = $lineImageData['file'];
			$realpath = $_SERVER['DOCUMENT_ROOT']."/medias/charter_line/small/".$file_id."/".$filename;
			$thumbpath = "/medias/charter_line/small/".$file_id."/".$filename;
			if (is_file($realpath)) {
				$arrImages["small_image"] = $thumbpath;
			} else {
				$arrImages["small_image"] = "";
			}
			$realpath = $_SERVER['DOCUMENT_ROOT']."/medias/charter_line/big/".$file_id."/".$filename;
			$thumbpath = "/medias/charter_line/big/".$file_id."/".$filename;
			if (is_file($realpath)) {
				$arrImages["big_image"] = $thumbpath;
			} else {
				$arrImages["big_image"] = "";
			}
			$arrImages["image_label"] = $lineImageData["label"];
			if (!empty($arrImages["big_image"]) && !empty($arrImages["small_image"])) {
				$arrLineImages[] = $arrImages;
			}
		}
	}
	$lineData["images"] = $arrLineImages;
	$arrCharterLines[] = $lineData;
}


// 设定的座位
$charterClassesSql = "SELECT T1.price, T1.class_id, T2.title
    				FROM pm_charter_classes T1
    				INNER JOIN pm_charter_class T2 ON ( T1.class_id = T2.id and T2.lang = ".$hmWeb->defaultLang." )
    				WHERE T1.charter_id = ? ORDER BY T1.price DESC ";
// 取得包车规格
$arrCharterClassResult = $hmWeb->findAll($charterClassesSql, array($charterId));
if ($arrCharterClassResult != null) {
	$arrCharter["classes"] = $arrCharterClassResult;
} else {
	$arrCharter["classes"] = array();
}

$arrOptions = $hmWeb->getSelectOptions();

$choiceClassId = 0;
$choiceClassPrice = 0;
if (count($arrCharter["classes"]) > 0) {
	$choiceClassId = $arrCharter["classes"][0]["class_id"];
	$choiceClassPrice = $arrCharter["classes"][0]["price"];
}

// 设置
$arrSetting = $hmWeb->findCharterSetting();

$settingIndex = 4;


// 推荐的车导
$recommendCharters = $hmWeb->findRecommendCharterList(array());

//
$token = $hmWeb->getToken();

// 车导情报
$bookingSql = "SELECT count(id) AS booking_count FROM `pm_charter_booking` WHERE  charter_id = ? ";

// 取得车导情报
$arrBooking = $hmWeb->findOne($bookingSql, array($charterId));
$bookingCount = 0;
if ($arrBooking != null && count($arrBooking) > 0) {
	$bookingCount = $arrBooking["booking_count"];
}

?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<head>
<?php require_once 'top.php'; ?>
<style>
body {
	background: #f7f7f7;
}
</style>

<!-- 评价 -->
<script type="text/javascript">
function rate(obj,oEvent){
var imgSrc = 'images/11_135.png';
var imgSrc_2 = 'images/11_10.png';
if(obj.rateFlag) return;
var e = oEvent || window.event;
var target = e.target || e.srcElement;
var imgArray = obj.getElementsByTagName("img");
for(var i=0;i<imgArray.length;i++){
   imgArray[i]._num = i;
   imgArray[i].onclick=function(){
    if(obj.rateFlag) return;
    alert//加个, 就没有弹窗了//(this._num+1);
	var inputid=this.parentNode.previousSibling
	inputid.value=this._num+1;
	$("#pl_xx").val(this._num+1);
   }
}//欢迎来到站长 特效网，我们的网址是www.zzjs.net，很好记，zz站长，js就是js特效，本站收集大量高质量js代码，还有许多广告代码下载。
if(target.tagName=="IMG"){
   for(var j=0;j<imgArray.length;j++){
    if(j<=target._num){
     imgArray[j].src=imgSrc_2;
    } else {
     imgArray[j].src=imgSrc;
    }
	target.parentNode.onmouseout=function(){
	var imgnum=parseInt(target.parentNode.previousSibling.value);
		for(n=0;n<imgArray.length;n++){
			imgArray[n].src=imgSrc;
		}
		for(n=0;n<imgnum;n++){
			imgArray[n].src=imgSrc_2;
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

<!--  -->
<?php require_once 'head.php';?>

<div class="container"> </div>
<aside id="fh5co-hero">
  <div style="background: url(/images/guide.jpg) no-repeat; background-position:center center; height:222px;">
    <div class="overlay-gradient"></div>
    <div class="container" style="height:222px;">
      <div class="col-md-offset-1 text-center js-fullheight slider-text">
        <div class="slider-text-inner midd_230s">
          <h2>美溪车友平台</h2>
          <p><span>租车随时随地，自驾自由自在</span></p>
        </div>
      </div>
    </div>
    <div class="clear"></div>
  </div>
</aside>


<div class="midd_25">
  <div class="midd_26"><img src="/images/11_03.png"><a href="index.html">首页</a> > 
  <a href="guide.html">车导服务 </a> > 
  <a href="guidexx.html?id=<?php echo $charterId;?>"><?php echo $hmWeb->t("title", $arrCharter);?></a></div>
</div>


<div id="fh5co-work-section" class="fh5co-light-grey-section" style="padding:0;">
  <div class="container">
    <div class="midd_27">
    
      <div class="left midd_52">
      	<?php 
      	if (count($arrCharterImages) > 0) {
      		
      	?>
        <div id="originalpic">
        	<?php 
	      	foreach($arrCharterImages as $index => $arrImageData) {
	      		
	      	?>
	          <li><a href="javascript:;"><img src="<?php echo $arrImageData["big_image"];?>" <?php if ($index == 0) { echo 'style="display: inline;"';}?> ></a></li>
			<?php 
	      	}
	      	?>
          <a id="aPrev" style="cursor: url(http://img.suofeiya.com.cn/themes/default/images/prev.cur), auto; height: 600px;"></a> 
          <a id="aNext" style="cursor: url(http://img.suofeiya.com.cn/themes/default/images/next.cur), auto; height: 600px;"></a> 
        </div>
        <div class="thumbpic"> <a href="javascript:;" class="bntprev"></a>
          <div id="piclist">
            <ul>
			<?php 
	      	foreach($arrCharterImages as $index => $arrImageData) {
	      		
	      	?>
	          <li <?php if ($index == 0) { echo 'class="hover"';}?> >
	          <a href="javascript:;"><img src="<?php echo $arrImageData["small_image"];?>"  ></a>
	          </li>
			<?php 
	      	}
	      	?>
            </ul>
          </div>
          <a href="javascript:;" class="bntnext"></a> 
      	</div>
      	
		<?php 
      	} else {
      	?>
      	
		<div id="originalpic">
          <li><a href="javascript:;"><img src="images/guide_4_03.png" style="display: inline;"></a></li>
          <a id="aPrev" style="cursor: url(http://img.suofeiya.com.cn/themes/default/images/prev.cur), auto; height: 600px;"></a> 
          <a id="aNext" style="cursor: url(http://img.suofeiya.com.cn/themes/default/images/next.cur), auto; height: 600px;"></a> 
        </div>
        <div class="thumbpic"> <a href="javascript:;" class="bntprev"></a>
          <div id="piclist">
            <ul>
              <li class="hover"><a href="javascript:;"><img src="images/guide_4_07.png"></a></li>
            </ul>
          </div>
          <a href="javascript:;" class="bntnext"></a> 
      	</div>
		<?php 
      	}
      	?>
      	
      </div>
      
      <div class="midd_28">
      
		<form name="booking_form" method="post" action="action.html?booking=post">
		<input type="hidden" name="<?php echo $hmWeb->token_name?>" value="<?php echo $token ?>">
		<input type="hidden" name="cid" value="<?php echo $charterId ?>">
        
        <input type="hidden" id="booking_date" name="booking_date" value="">
        <input type="hidden" id="choice_class_id" name="choice_class_id" value="<?php echo $choiceClassId ?>">
        
        <div class="midd_29"><?php echo $hmWeb->t("title", $arrCharter);?></div>
        <div class="midd_48">
        <span class="midd_102"><?php echo $hmWeb->t("descr", $arrCharter);?></span> </div>
        <div class="midd_103"><span>￥</span><h1 id="choice_class_price"><?php echo $choiceClassPrice;?></h1> / 车<div class="clear"></div></div>
        <div class="midd_104">
        
         <?php foreach($arrCharter['classes'] as $classesList) {?>
	     <a href="javascript:void(0);" <?php if ($classesList["class_id"] == $choiceClassId) {echo 'class="active"';} ?> 
	      data-price="<?php echo $classesList["price"];?>" 
	      data-classid="<?php echo $classesList["class_id"];?>">
	      <?php echo $classesList["title"];?>
	      </a>
	     <?php } ?>
        <div class="clear"></div>
        </div>
        <div class="midd_127"><div class="rendezvous-input-date" id="start">选择预定日期</div></div>
        <div class="midd_115">
          <select name="adults" class="input_11">
          <option value="0">成人/人</option>
          <?php 
          foreach($arrOptions as $k => $v) {
          ?>
          <option value="<?php echo $k;?>"><?php echo $v;?></option>
          <?php 
          }
          ?>
          </select>
          <select name="children" class="input_11" style="margin-right:0;">
          <option value="0">儿童（0~5岁）/人</option>
          <?php 
          foreach($arrOptions as $k => $v) {
          ?>
          <option value="<?php echo $k;?>"><?php echo $v;?></option>
          <?php 
          }
          ?>
          </select>
        <div class="clear"></div>
        </div>
        <input type="submit" name="button" class="input_12" value="立即预约" >
        
        <div class="midd_128">
          <span style="color:#e83744;"><?php echo $bookingCount;?></span>人预约 | 
          <a href="javascript:void(0);" onclick="clickLike(<?php echo $charterId;?>)"><img src="images/guide_1_06.jpg"></a><span id="like_<?php echo $charterId ?>" style="color:#e83744;"><?php echo $arrCharter['like_count'];?></span>/人点赞 | 顾客评分：
          <span style="color:#104787;"><?php echo $arrCharter['score_count'];?></span>分 | 评论数：
          <span style="color:#104787;"><?php echo $arrCharter['comment_count'];?></span>次
        </div>
        
        </form>
        <!-- 选择日期 --> 
        <script type="text/javascript" src="js/laydate.js"></script> 
        <script type="text/javascript">
!function(){
	laydate.skin('dahong');//切换皮肤，请查看skins下面皮肤库
	laydate({elem: '#demo'});//绑定元素
}();

//日期范围限制
var start = {
    elem: '#start',
    format: 'YYYY-MM-DD',
    min: laydate.now(+1), //设定最小日期为当前日期
    max: '2099-06-16', //最大日期
    istime: true,
    istoday: false,
    choose: function(datas){
         end.min = datas; //开始日选好后，重置结束日的最小日期
         end.start = datas //将结束日的初始值设定为开始日
         $("#booking_date").val(datas);
    }
};

var end = {
    elem: '#end',
    format: 'YYYY-MM-DD',
    min: laydate.now(),
    max: '2099-06-16',
    istime: true,
    istoday: false,
    choose: function(datas){
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
    choose: function(datas){ //选择日期完毕的回调
        alert('得到：'+datas);
    }
});

//日期范围限定在昨天到明天
laydate({
    elem: '#hello3',
    min: laydate.now(-1), //-1代表昨天，-2代表前天，以此类推
    max: laydate.now(+1) //+1代表明天，+2代表后天，以此类推
});
</script>
        <script type="text/javascript">
jQuery(function(){
	var list = jQuery('.midd_104 a');
	list.click(function(){
		list.removeClass('active');
		jQuery(this).addClass('active');

		var price = jQuery(this).data("price");
		$("#choice_class_price").html(price);

		var choice_class_id = jQuery(this).data("classid");
		$("#choice_class_id").val(choice_class_id);
	});
});

function clickLike(charterId) {
	var data = {};
	data['<?php echo $hmWeb->token_name?>'] = '<?php echo $token?>';
	data['charter_id'] = charterId;
	$.ajax({
		type:'POST',
		url:"action.html?like=post",
		data:data,
		dataType:'json',
		success:function(data){
			if (data.result == "error") {
				alert('系统发送失败,请与客服联系。');
				return false;
			} else {
				$("#like_" + charterId).html(data.like_count);
			}
		},
		error:function(){
			alert('系统发送失败。');
		}
	});
}


</script>
      </div>
      <div class="clear"></div>
    </div>
    
	<div class="midd_105">
	  <?php if (count($arrCharterLines) > 0) {?>
      <a href="#q1" class="midd_106">线路详细</a>
      <a href="#q2">服务流程</a>
      <?php } else { ?>
      <a href="#q2" class="midd_106">服务流程</a>
      <?php }  ?>
      <a href="#q3">车辆信息</a>
      <?php foreach($arrSetting as $index => $setting) {
      	echo '<a href="#q'.($settingIndex + $index).'">'.$setting["name"].'</a>';
      }?>
      <a href="#pl">用户评价</a>
	</div>
	
    <div class="midd_27" style="margin-top:0;">
      <?php if (count($arrCharterLines) > 0) {?>
      <a name="q1"></a>
      <div class="midd_107">线路详细</div>
      
      <?php 
      foreach($arrCharterLines as $charterLineData) {
      ?>
      <div class="midd_108 midd_top20">
        <img src="images/guide_4_11.png">
        <div class="midd_109"><?php echo $charterLineData["line_name"];?></div>
      <div class="clear"></div>
      </div>
      <div class="midd_110">
      	<?php echo $charterLineData["line_description"];?>
        
		<?php 
			if (count($charterLineData["images"]) > 0) {
				foreach($charterLineData["images"] as $lineImages) {
		?>
        	<img src='<?php echo $lineImages["big_image"];?>'>
          <?php 
				}
	      	}
	      ?>
      <div class="clear"></div>
      </div>
      <?php 
      
      	}
      } 
      ?>
      
      <!-- 服务流程 -->
      <a name="q2"></a>
	  <?php require_once 'include/services_rules.php';?>
	  
	  <!-- 车辆信息 -->
      <a name="q3"></a>
      <?php require_once 'include/car_info.php';?>


	  <!-- 服务标准/注意事项 -->
      <?php 
      foreach($arrSetting as $index => $setting) {
      	echo '<a name="q'.($settingIndex + $index).'"></a>';
      	echo '<div class="midd_107 midd_top20">'.$setting["name"].'</div>';
      ?>
      <div class="midd_126">
        <?php echo $setting["content"];?>
        
        <?php 
        if (count($setting["images"]) > 0) {
        ?>
        <div class="midd_125">
        	<?php 
		      foreach($setting["images"] as $images) {
		      ?>
        	<img src="<?php echo $images;?>">
	        <?php 
		      }
		      ?>
        </div>
         <?php 
	      }
	      ?>
      <div class="clear"></div>
      </div>
      
      <?php 
      }
      ?>
      
      <a name="pl"></a>
      <div class="midd_107 midd_top20">用户评价</div>
      <div class="midd_40">
        <div class="left">整体评分：<span><?php echo $arrCharter['score_count'];?></span>/分</div>
        <?php for ($i = 0; $i < floor($arrCharter['score_count']); $i++) { ?>
                    <img src="images/11_10.png">
                <?php }
                for ($i = 0; $i < 5 - floor($arrCharter['score_count']); $i++) {
                    ?>
                    <img src="images/11_135.png"><?php } ?>
        </div>
        
      <div class="midd_115">
      
      <?php
            $perNumber = 10;
            $page = @$_GET['page'];
            $count = $pdo->query("SELECT * FROM pm_charter_pl WHERE id_item = " . $charterId);
            $totalNumber = $count->rowCount();
            $totalPage = ceil($totalNumber / $perNumber);
            if (!isset($page)) {
                $page = 1;
            }
            $startCount = ($page - 1) * $perNumber;
            $rs1 = $pdo->query("SELECT * FROM pm_charter_pl WHERE id_item = " . $charterId . " order by id desc limit $startCount,$perNumber");
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
      <div class="clear"></div>
      </div>
      
      <!-- 翻页 -->
      <div id='pagina'>
                <?php
                if ($page - 1 > 0) {
                    ?>
                    <a href="guidexx.html?id=<?php echo $charterId ?>&page=<?php echo $page - 1 ?>#pl">上一页</a>
                    <?php
                }
                if ($page == $totalPage && $page == 1) {
                    echo "<a class='number'>1</a>";
                } else {
                    if ($page - 2 > 0) {
                        ?>
                        <a href="guidexx.html?id=<?php echo $charterId ?>&page=<?php echo $page - 2 ?>#pl"><?php echo $page - 2 ?></a>
                        <?php
                    }
                    if ($page - 1 > 0) {
                        ?>
                        <a href="guidexx.html?id=<?php echo $charterId ?>&page=<?php echo $page - 1 ?>#pl"><?php echo $page - 1 ?></a>
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
                            <a href="guidexx.html?id=<?php echo $charterId ?>&page=<?php echo $i ?>#pl"><?php echo $i ?></a>
                            <?php
                        }
                    }
                }
                if ($page + 1 < $totalPage) {
                    ?>
                    <a href="guidexx.html?id=<?php echo $charterId ?>&page=<?php echo $page + 1 ?>#pl">下一页</a>
                <?php } ?>
            </div>
        
      <form name="search_form" method="post" action="action.html?pl=post">
			<input type="hidden" name="<?php echo $hmWeb->token_name?>" value="<?php echo $token ?>">
			<input type="hidden" name="cid" value="<?php echo $charterId ?>">
			<textarea name="text" class="input_1" placeholder="输入你的留言..."></textarea>
			<div class="midd_45">
				<div class="left" onmouseover="rate(this,event)"><span>评价：</span><img src="images/11_135.png"><img
                            src="images/11_135.png"><img src="images/11_135.png"><img src="images/11_135.png"><img
                            src="images/11_135.png">
                </div>
                    <input type="hidden" id="pl_xx" class="plid" name="xx" value="5">
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
    
	<!-- 推荐车导服务 -->
	<?php require_once 'include/recommends.php';?>
      
  </div>
<div class="clear"></div>
</div>

<!-- 底部 -->
<?php require_once 'foot.php';?>


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
$(function(){
  $(".sehun").click(function(){
	$(".navshow").slideToggle();
  });	
});
</script>
</body>
</html>

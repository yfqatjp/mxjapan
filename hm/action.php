<?php 
require_once 'coon.php';

//
require_once $_SERVER['DOCUMENT_ROOT'] . '/common/HmWeb.php';

$token = $hmWeb->query($hmWeb->token_name, "");
// token值为空的，非法请求
if (empty($token)) {
	exit(header("Location: /"));
}

// token的验证
if (!$hmWeb->isValidToken()) {
	exit(Alert(2, "表单认证失败", "/"));
}

// 车友申请
if (@$_GET['cysq'] == 'post') {
	if (@$_SESSION['userid'] == "") {
		header("Location: /signin.html");
		exit;
	}
	$userId = $_SESSION['userid'];
	$upData = array();
	// 
	if (empty($hmWeb->query("user_name"))) {
		exit(alert(2, "姓名必须填", "/user/cysq.html"));
	}
	//
	if (empty($hmWeb->query("drive_year"))) {
		exit(alert(2, "在当地年限必须填", "/user/cysq.html"));
	}
	//
	if (empty($hmWeb->query("mobile"))) {
		exit(alert(2, "手机号码必须填", "/user/cysq.html"));
	}
	//
	if (empty($hmWeb->query("identity"))) {
		exit(alert(2, "身份证号必须填", "/user/cysq.html"));
	}
	//
	if (empty($hmWeb->query("self_comment"))) {
		exit(alert(2, "介绍自己必须填", "/user/cysq.html"));
	}
	//
	if (empty($hmWeb->query("friend_comment"))) {
		exit(alert(2, "朋友对您的评价必须填", "/user/cysq.html"));
	}
	$upData["user_name"] = $hmWeb->query("user_name");
	$upData["drive_year"] = $hmWeb->query("drive_year");
	$upData["mobile"] = $hmWeb->query("mobile");
	$upData["alipay"] = $hmWeb->query("alipay");
	$upData["identity"] = $hmWeb->query("identity");
	$upData["self_comment"] = $hmWeb->query("self_comment");
	$upData["friend_comment"] = $hmWeb->query("friend_comment");
	$upData["why_comment"] = $hmWeb->query("why_comment");
	//
	$existSql = "select * from pm_charter_user where user_id = ? ";
	$arrExistsUser = $hmWeb->findOne($existSql, array($userId));
	if ($arrExistsUser != null && count($arrExistsUser) > 0) {
		$upData["checked"] = "0";
		$upData["add_date"] = strtotime("now");
		$upData["edit_date"] = strtotime("now");
		//
		$hmWeb->update("pm_charter_user", $upData, " user_id = ?", array($userId));
	} else {
		$upData["edit_date"] = strtotime("now");
		//
		$hmWeb->insert("pm_charter_user", $upData);
	}
	exit(alert(2, "保存成功", "/user/cysq.html"));
}

// 爱车不接单时间的设置
if (@$_GET['acsz'] == 'post') {
	if (@$_SESSION['userid'] == "") {
		header("Location: /signin.html");
		exit;
	}
	$userId = $_SESSION['userid'];
	
	$upData = array();
	$setType = $hmWeb->query("set_type", "0");
	// 设置类型(0:不设置  1：每周  2：日期范围）
	$upData["set_type"] = $hmWeb->query("set_type", "0");
	if ($setType == "1") {
		
		$arrweek = $hmWeb->query("week");
		if (is_array($arrweek)) {
			$upData["week"] = implode(",", $arrweek);
		} else {
			$upData["week"] = $hmWeb->query("week");
		}
		
		
		$upData["end_date"] = "";
		$upData["start_date"] = "";
	} else if ($setType == "2") {
		if (!empty($hmWeb->query("start_date"))) {
			$upData["start_date"] = @strtotime($hmWeb->query("start_date"));
		} else {
			$upData["start_date"] = "";
		}
		if (!empty($hmWeb->query("end_date"))) {
			$upData["end_date"] = @strtotime($hmWeb->query("end_date"));
		} else {
			$upData["end_date"] = "";
		}
		$upData["week"] = "";
	} else {
		$upData["week"] = "";
		$upData["end_date"] = "";
		$upData["start_date"] = "";
	}
	$upData["edit_date"] = strtotime("now");
	$hmWeb->update("pm_charter_user", $upData, "user_id = ?", array($userId));
	
	exit(alert(2, "设置成功", "/user/acsz.html"));
}

// 点赞
if (@$_GET['jiedan'] == 'post') {
	$order_no = $hmWeb->query("order_no", "");
	$page = $hmWeb->query("page", 1);
	$jiedanResult = 0;
	if (!empty($order_no)) {
		// sql
		$sql = "SELECT * FROM pm_charter_booking WHERE trans = ?  ";
		$result = $hmWeb->findOne($sql, array($order_no));

		if ($result != null) {
			$upData = array();
			// 状态变为已接单
			$upData["status"] = 6;
			$upData["edit_date"] = strtotime("now");
			$hmWeb->update("pm_charter_booking", $upData, "trans = ?", array($order_no));
			$jiedanResult = 1;
		}

	}
	if ($jiedanResult == 1) {
		exit(alert(2, "接单成功", "/user/acdd.html?page=" . $page));
	} else {
		exit(alert(2, "接单失败", "/user/acdd.html?page=" . $page));
	}
	
}

// 点赞
if (@$_GET['like'] == 'post') {
	$charter_id = $hmWeb->query("charter_id", 0);
	$returnData = array();
	$returnData["result"] = "errors";
	$likeCount = 0;
	if (!empty($charter_id)) {
		$returnData["result"] = "success";
		
		// sql
		$sql = "SELECT like_count FROM pm_charter WHERE id = ?  ";
		$result = $hmWeb->findOne($sql, array($charter_id));
		
		if ($result != null) {
			if (empty($result["like_count"])) {
				$result["like_count"] = 0;
			}
			$upData = array();
			$upData["like_count"] = $result["like_count"] + 1;
			$hmWeb->update("pm_charter", $upData, "id=?", array($charter_id));
			$likeCount = $upData["like_count"];
		}
		
	}
	$returnData["like_count"] = $likeCount;
	echo json_encode($returnData);
	exit;
}
// 添加评论的场合
if (@$_GET['pl'] == 'post') {
	if (@$_SESSION['userid'] == "") {
		header("Location: /signin.html");
		exit;
	}

	if (empty($hmWeb->query("text"))) {
		exit(alert(2, "请输入您的留言", "/guidexx.html?id=" . $_POST['cid'] . "#pl"));
	}
	
	//
	$arrPl = array();
	$arrPl["rank"] = $hmWeb->query("xx", 5);
	$arrPl["text"] = $hmWeb->query("text", "");
	$arrPl["uid"] = $_SESSION['userid'];
	$arrPl["userip"] = $userip;
	$arrPl["dtime"] = "Now()";
	$arrPl["lang"] = 2;
	$arrPl["id_item"] = $hmWeb->query("cid", 0);
	$hmWeb->insert("pm_charter_pl", $arrPl);
	//$rs = $pdo->exec("INSERT INTO pm_charter_pl (`rank`,`text`,`uid`,`userip`,`dtime`,`lang`,id_item) VALUES ('" . $_POST['xx'] . "','" . $_POST['text'] . "','" . $_SESSION['userid'] . "','" . $userip . "',now(),'2'," . $_POST['cid'] . ")");
	
	// sql
	$sql = "SELECT avg(rank) AS avg_rank, count(id) as pl_count FROM pm_charter_pl WHERE id_item = ?  ";
	$result = $hmWeb->findOne($sql, array($hmWeb->query("cid", 0)));
	
	if ($result != null) {
		$upData = array();
		$upData["score_count"] = round($result["avg_rank"], 1);
		$upData["comment_count"] = $result["pl_count"];
		//$upData["like_count"] = $result["pl_count"];
		$hmWeb->update("pm_charter", $upData, "id=?", array($hmWeb->query("cid", 0)));
	}
	
	header("Location: "."/guidexx.html?id=" . $_POST['cid'] . "#pl");
}

// 预约
if (@$_GET['booking'] == "post") {
	
	if (@$_SESSION['userid'] == "") {
		header("Location: /signin.html");
		exit;
	}
	
	$rs = $pdo->query("SELECT * FROM pm_user WHERE ( name IS NOT NULL OR phone IS NOT NULL) AND id = " . $_SESSION['userid']);
	if ($rs->rowCount() == 0) {
		exit(Alert(2, "未设置姓名和电话", "/user/grxx.html"));
	}
	
	$choice_class_id = $hmWeb->query("choice_class_id", 0);
	$booking_date = $hmWeb->query("booking_date", "");
	$cid = $hmWeb->query("cid", 0);
	
	// 成人/人
	$adults = $hmWeb->query("adults", 0);
	
	// 儿童（0~5岁）
	$children = $hmWeb->query("children", 0);
	
	// 预定的日期
	if (empty($booking_date)) {
		exit(alert(2, "请选择预定日期", "/guidexx.html?id=" . $cid));
	}
	
	// 坐车的人数
	if (empty($adults)) {
		exit(alert(2, "请设定坐车的人数", "/guidexx.html?id=" . $cid));
	}
	
	$day = date('Ymd', strtotime($booking_date)) - date('Ymd', time());
	if ($day <= 0) {
		exit(alert(2, "请选择未来的日期", "/guidexx.html?id=" . $cid));
	}

	
	// 删除以前预约过的信息
	$rs = $pdo->query("DELETE FROM pm_gwc WHERE uid = " . $_SESSION['userid'] . " AND onum IS NULL AND type = 1 ");
	
	$arrCharter = $hmWeb->findOne("SELECT * FROM pm_charter WHERE lang = 2 AND id = ? ", array($cid));
	if (count($arrCharter) == 0) {
		exit(Alert(2, "此车导服务未找到", "/"));
	}
	
	//
	$sql = "SELECT t1.*, t2.title FROM pm_charter_classes t1, pm_charter_class t2 WHERE t1.class_id = t2.id and t1.charter_id = ? AND t1.class_id = ? ";
	$arrClass = $hmWeb->findOne($sql, array($cid, $choice_class_id));
	if (count($arrClass) == 0) {
		exit(Alert(2, "此规格的车型未找到", "/"));
	}
	
	//
	$arrData = array();
	$arrData["charter_id"] = $cid;
	$arrData["charter_class_id"] = $choice_class_id;
	$arrData["charter_title"] = $arrCharter["title"];
	$arrData["charter_class_name"] = $arrClass["title"];
	$arrData["price"] = $arrClass['price'];
	$arrData["uid"] = $_SESSION['userid'];
	$arrData["userip"] = $userip;
	$arrData["dtime"] = "Now()";
	$arrData["arrive_time"] = $booking_date;
	$arrData["adults"] = $adults;
	$arrData["children"] = $children;
	$arrData["type"] = 1;
	$hmWeb->insert("pm_gwc", $arrData);
	echo "<script>parent.window.location.href='/guide_payment.html'</script>";
	//header("Location: /payment.html");
	exit;
}

// 预约
if (@$_GET['topay'] == "post") {

	if (@$_SESSION['userid'] == "") {
		header("Location: /signin.html");
		exit;
	}
	
	$o = date('Ymdhis', time()) . rand(1000, 9999);
	// 支付方式
	$pay = $hmWeb->query("pay", 0);
	// 
	$lid = $hmWeb->query("lid", 0);
	// 
	$paymentTotal = $hmWeb->query("price", 0);
	
	$rs = $pdo->exec("UPDATE pm_gwc SET    price  = " . $paymentTotal . " , onum = '" . $o . "' WHERE id = " . $lid);
	$rs = $pdo->query("SELECT * FROM pm_gwc WHERE onum LIKE '" . $o . "'");
	$row = $rs->fetch();

	$rs1 = $pdo->query("SELECT * FROM pm_charter WHERE lang = 2 AND id = " . $row['charter_id']);
	$row1 = $rs1->fetch();


	$rs5 = $pdo->query("SELECT * FROM pm_user WHERE id = " . $_SESSION['userid']);
	$row5 = $rs5->fetch();

	if ($pay == 0) {
		//$rs = $pdo->exec("INSERT INTO pm_booking (`id_room`,`room`,`comments`,`firstname`,`from_date`,`to_date`,`Nights`,`adults`,`children`,add_date,Total,phone,payment_method,`status`,country,trans) SELECT `room`,'" . $row1['title'] . "',`text`,'" . $row5['name'] . "',UNIX_TIMESTAMP(ont),UNIX_TIMESTAMP(offt),'" . $day . "',`adults`,`children`,UNIX_TIMESTAMP(dtime),'" . $_POST['price']. "','" . $row5['phone'] . "','只预约',1,'中国','" . $o . "' FROM pm_gwc WHERE onum LIKE '" . $o . "'");
		$arrBookingData = $hmWeb->getBookingData($lid, $row, $row5, $row1, 0, 1, array());
		//
		$charterBookingSql = "select * from pm_charter_booking where trans = ? ";
		$arrExistsBooking = $hmWeb->findOne($charterBookingSql, array($o));
		if ($arrExistsBooking != null && count($arrExistsBooking) > 0) {
			//
			$hmWeb->update("pm_charter_booking", $arrBookingData, " id = ?", array($arrExistsBooking["id"]));
		} else {
			//
			$hmWeb->insert("pm_charter_booking", $arrBookingData);
		}
		$rs = $pdo->exec("UPDATE pm_gwc SET pay = 0,tai = 2,yytime = now() WHERE onum = '" . $o . "'");
		exit(Alert(2, "预约成功,请等待客服致电确认预约信息", "/user/bcdd.html"));
	} elseif ($_POST['pay'] == 1 && $_POST['price'] > 0) {
		// 等待支付
		$arrBookingData = $hmWeb->getBookingData($lid, $row, $row5, $row1, 1, 1, array());
		//
		$charterBookingSql = "select * from pm_charter_booking where trans = ? ";
		$arrExistsBooking = $hmWeb->findOne($charterBookingSql, array($o));
		if ($arrExistsBooking != null && count($arrExistsBooking) > 0) {
			//
			$hmWeb->update("pm_charter_booking", $arrBookingData, " id = ?", array($arrExistsBooking["id"]));
		} else {
			//
			$hmWeb->insert("pm_charter_booking", $arrBookingData);
		}
		header("Location: /pay/create_direct_pay/alipayapi.php?o=" . $o);
	} elseif ($_POST['pay'] == 2 && $_POST['price']  > 0) {
		// 等待支付
		$arrBookingData = $hmWeb->getBookingData($lid, $row, $row5, $row1, 2, 1, array());
		//
		$charterBookingSql = "select * from pm_charter_booking where trans = ? ";
		$arrExistsBooking = $hmWeb->findOne($charterBookingSql, array($o));
		if ($arrExistsBooking != null && count($arrExistsBooking) > 0) {
			//
			$hmWeb->update("pm_charter_booking", $arrBookingData, " id = ?", array($arrExistsBooking["id"]));
		} else {
			//
			$hmWeb->insert("pm_charter_booking", $arrBookingData);
		}
		header("Location: /pay/WxpayAPI_php_v3/example/native.php");
	} elseif ($_POST['pay'] == 3 && $_POST['price']  > 0) {
		// 等待支付
		$arrBookingData = $hmWeb->getBookingData($lid, $row, $row5, $row1, 3, 1, array());
		//
		$charterBookingSql = "select * from pm_charter_booking where trans = ? ";
		$arrExistsBooking = $hmWeb->findOne($charterBookingSql, array($o));
		if ($arrExistsBooking != null && count($arrExistsBooking) > 0) {
			//
			$hmWeb->update("pm_charter_booking", $arrBookingData, " id = ?", array($arrExistsBooking["id"]));
		} else {
			//
			$hmWeb->insert("pm_charter_booking", $arrBookingData);
		}
		header("Location: /pay/paypal/alipayto.php?o=" . $o);
	}
	exit;
}

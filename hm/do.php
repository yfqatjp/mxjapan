<?php require_once 'coon.php';
if (@$_GET['ss'] == "list") {
    if ($_POST['offt'] == "退房日期") {
        $offt = "";
    } else {
        $offt = $_POST['offt'];
    }
    if ($_POST['ont'] == "入住日期") {
        $ont = "";
    } else {
        $ont = $_POST['ont'];
    }
    if ($_POST['page'] == "") {
        $page = 1;
    } else {
        $page = $_POST['page'];
    }
    header("Location: /list2_" . $page . "_0_0_0_0_" . urlencode($_POST['text']) . "_" . ($_POST['lid'] - 1) . "_" . $ont . "_" . $offt . ".html#fh5co-work-section");
    //echo ("Location: /list2_1_0_0_0_1_".urlencode($_POST['text'])."_".($_POST['lid']-1)."_".$_POST['ont']."_".$_POST['offt'].".html#fh5co-work-section");
    exit;
}

if (@$_GET['gg'] == "post") {
    if (@$_SESSION['userid'] == "") {
        header("Location: /signin.html");
        exit;
    }
    if ($_POST['page'] == "") {
        $page = 1;
    } else {
        $page = $_POST['page'];
    }

    header("Location: /user/nbxxk_" . $page . "_" . $_POST['lid'] . "_" . urlencode($_POST['text']) . ".html");
}


$sta = 0;

if (@$_SESSION['time']) {
    if (time() - $_SESSION['time'] < 60) {
        if ($_SESSION['sub_num'] <= 3) {
            $sta = 1;
        }
    } else {
        $_SESSION['time'] = time();
        $_SESSION['sub_num'] = 0;
        $sta = 1;
    }
} else {
    $_SESSION['time'] = time();
    $_SESSION['sub_num'] = 0;
    $sta = 1;
}

if ($sta) {
    $_SESSION['sub_num'] = $_SESSION['sub_num'] + 1;
} else {
    //exit(Alert(3,"每分钟只能提交六次",""));
}

if (@$_POST['formcode'] == "") {
    exit(header("Location: /"));
}
if ($_POST['formcode'] != $_SESSION['formcode']) {
    exit(Alert(2, "表单认证失败", "/"));
}
$_SESSION['formcode'] = rfc_encode(mt_rand(0, 1000000));

if (@$_GET['yy'] == "post") {
    if (@$_SESSION['userid'] == "") {
        header("Location: /signin.html");
        exit;
    }

    $rs = $pdo->query("SELECT * FROM pm_user WHERE ( name IS NOT NULL OR phone IS NOT NULL) AND id = " . $_SESSION['userid']);
    if ($rs->rowCount() == 0) {
        exit(Alert(2, "未设置姓名和电话", "/user/grxx.html"));
    }

    $rs = $pdo->query("DELETE FROM pm_gwc WHERE uid = " . $_SESSION['userid'] . " AND onum IS NULL");

    $rs = $pdo->query("SELECT * FROM pm_hotel WHERE lang = 2 AND id = " . $_POST['hotels']);
    if ($rs->rowCount() == 0) {
        exit(Alert(2, "酒店未找到", "/"));
    }

    $rs = $pdo->query("SELECT * FROM pm_room WHERE lang = 2 AND id = " . $_POST['room']);
    if ($rs->rowCount() == 0) {
        exit(Alert(2, "房间未找到", "/"));
    }

    $rs = $pdo->query("SELECT * FROM pm_gwc WHERE uid = " . $_SESSION['userid'] . " AND onum IS NULL AND room = " . $_POST['room']);
    if ($rs->rowCount() == 0) {
        $rs = $pdo->exec("INSERT INTO pm_gwc (`room`,`hotels`,`text`,`uid`,`userip`,`ont`,`offt`,`adults`,`children`,dtime) VALUES ('" . $_POST['room'] . "','" . $_POST['hotels'] . "','" . $_POST['text'] . "','" . $_SESSION['userid'] . "','" . $userip . "','" . $_POST['ont'] . "','" . $_POST['offt'] . "','" . $_POST['yuy'] . "','" . $_POST['yuy2'] . "',now())");
    }
    echo "<script>parent.window.location.href='/payment.html'</script>";
    //header("Location: /payment.html");
    exit;
}

if (@$_GET['pay'] == "post") {
    if (@$_SESSION['userid'] == "") {
        header("Location: /signin.html");
        exit;
    }
    $o = date('Ymdhis', time()) . rand(1000, 9999);
    $rs = $pdo->exec("UPDATE pm_gwc SET    price  = " . $_POST['price'] . " , onum = '" . $o . "' WHERE id = " . $_POST['lid']);
    $rs = $pdo->query("SELECT * FROM pm_gwc WHERE onum LIKE '" . $o . "'");
    $row = $rs->fetch();

    $rs1 = $pdo->query("SELECT * FROM pm_hotel WHERE lang = 2 AND id = " . $row['hotels']);
    $row1 = $rs1->fetch();

    /*
    $rs4 = $pdo->query("SELECT * FROM pm_rate WHERE id_room = " . $row['room'] . " ORDER BY id DESC");
    $row4 = $rs4->fetch();

*/
    $rs4 = $pdo->query("SELECT * FROM pm_room WHERE lang = 2 AND id = " . $row['room'] . " ORDER BY id DESC");
    $row4 = $rs4->fetch();

    $day = date('Ymd', strtotime($row['offt'])) - date('Ymd', strtotime($row['ont']));
    if ($day <= 0) {
        $day = 1;
    }

    if ($_POST['price'] != $row4['price'] * $day) {
        exit(Alert(2, "订单信息发送变化", "/payment.html"));
    }

    $rs5 = $pdo->query("SELECT * FROM pm_user WHERE id = " . $_SESSION['userid']);
    $row5 = $rs5->fetch();

    if ($_POST['pay'] == 0) {
        smtp_mail($row5['email'], "预约订单确认", "尊敬的" . $row5['name'] . "<br>
<br>
您好<br>
<br>
欢迎使用美溪车友平台，您的订单已经提交，<br>
请确认您的订单<br>
<br>
订单号：" . $o . "<br>
入住日期：" . date('Y-m-d', strtotime($row['ont'])) . "<br>
退房日期：" . date('Y-m-d', strtotime($row['offt'])) . "<br>
价钱：" . $_POST['price'] . "<br>
<br>
<br>
再次感谢");

        smtp_mail("yuefuquan@gmail.com", "预约订单确认", "管理员您好<br>
<br>
客户预定了以下的订单<br>
<br>
订单号：" . $o . "<br>
入住日期：" . date('Y-m-d', strtotime($row['ont'])) . "<br>
退房日期：" . date('Y-m-d', strtotime($row['offt'])) . "<br>
价钱：" . $_POST['price']);
        $rs = $pdo->exec("INSERT INTO pm_booking (`id_room`,`room`,`comments`,`firstname`,`from_date`,`to_date`,`Nights`,`adults`,`children`,add_date,Total,phone,payment_method,`status`,country,trans) SELECT `room`,'" . $row1['title'] . "',`text`,'" . $row5['name'] . "',UNIX_TIMESTAMP(ont),UNIX_TIMESTAMP(offt),'" . $day . "',`adults`,`children`,UNIX_TIMESTAMP(dtime),'" . $_POST['price'] . "','" . $row5['phone'] . "','只预约',1,'中国','" . $o . "' FROM pm_gwc WHERE onum LIKE '" . $o . "'");
        $rs = $pdo->exec("UPDATE pm_gwc SET pay = 0,tai = 2,yytime = now() WHERE onum = '" . $o . "'");
        exit(Alert(2, "预约成功,请等待客服致电确认预约信息", "/user/jddd.html"));
    } elseif ($_POST['pay'] == 1 && $_POST['price'] > 0) {
        header("Location: /pay/create_direct_pay/alipayapi.php?o=" . $o);
    } elseif ($_POST['pay'] == 2 && $_POST['price']  > 0) {
        header("Location: /pay/WxpayAPI_php_v3/example/native.php");
    } elseif ($_POST['pay'] == 3 && $_POST['price']  > 0) {
        header("Location: /pay/paypal/alipayto.php?o=" . $o);
    }
    exit;
}

if (@$_GET['id'] == 'reg') {

    $rs = $pdo->query("SELECT * FROM pm_user WHERE email LIKE '" . $_POST['mail'] . "'");
    if ($rs->rowCount() > 0) {
        exit(alert(2, "邮箱已经被注册", "/register.html"));
    }

    $rs = $pdo->query("SELECT * FROM pm_user WHERE phone LIKE '" . $_POST['phone'] . "'");
    if ($rs->rowCount() > 0) {
        exit(alert(2, "手机已经被注册", "/register.html"));
    }

    $rs = $pdo->exec("INSERT INTO pm_user (`email`,pass,token,phone,`name`,add_date) VALUES ('" . $_POST['mail'] . "','" . md5($_POST['pass']) . "','" . $userip . "','" . $_POST['phone'] . "','" . $_POST['name'] . "','" . time() . "')");

    exit(alert(2, "注册成功", "/signin.html"));
}

if (@$_GET['id'] == 'xg') {

    $rs = $pdo->exec("UPDATE pm_user SET `name` = '" . $_POST['name'] . "',xname = '" . $_POST['xname'] . "',phone='" . $_POST['phone'] . "' WHERE id = " . $_SESSION['userid']);
    if ($_POST['xname'] == "") {
        $_SESSION['username'] = $_POST['name'];
    } else {
        $_SESSION['username'] = $_POST['xname'];
    }

    exit(alert(2, "修改成功", "/user/grxx.html"));
}

if (@$_GET['id'] == 'mm') {
    $rs = $pdo->query("SELECT * FROM pm_user WHERE id = " . $_SESSION['userid']);
    $row = $rs->fetch();

    if (md5($_POST['ymm']) != $row['pass']) {
        exit(alert(2, "原密码错误", "/user/mmxx.html"));
    }

    $rs = $pdo->exec("UPDATE pm_user SET `pass` = '" . md5($_POST['rpass']) . "' WHERE id = " . $_SESSION['userid']);

   // $_SESSION['userid'] = "";
      $_SESSION['uservip'] = "";
   // $_SESSION['username'] = "";

    exit(alert(2, "修改成功", "/user/mmxx.html"));
}

if (@$_GET['id'] == 'dl') {
    $rs = $pdo->query("SELECT * FROM pm_user WHERE email LIKE '" . $_POST['mail'] . "'");
    $row = $rs->fetch();

    if (md5($_POST['pass']) != $row['pass']) {
        exit(alert(2, "帐号或密码错误", "/signin.html"));
    }

    $_SESSION['userid'] = $row['id'];
    if ($row['xname'] == "") {
        $_SESSION['username'] = $row['name'];
    } else {
        $_SESSION['username'] = $row['xname'];
    }
    
    if (isset($_SESSION['wx_openid']) && !empty($_SESSION['wx_openid'])) {
    	if ($row['wx_openid'] <> $_SESSION['wx_openid']) {
    		// 在登录的时候，将用户和微信账号绑定
	    	$rs = $pdo->exec("UPDATE pm_user SET `wx_openid` = '" . $_SESSION['wx_openid']. "' WHERE id = " . $_SESSION['userid']);
    	}
    }
    if (@$_POST['lid'] == "") {
        //exit(alert(2, "登录成功", "/user/"));
        header("Location: /user/");
    } else {
      //  exit(alert(2, "登录成功", "/list_x" . $_POST['lid'] . ".html#pl"));
    	header("Location: "."/list_x" . $_POST['lid'] . ".html#pl");
    }

}

if (@$_GET['pl'] == 'post') {
    if (@$_SESSION['userid'] == "") {
        header("Location: /signin.html");
        exit;
    }

    $rs = $pdo->exec("INSERT INTO pm_hotel_pl (`rank`,`text`,`uid`,`userip`,`dtime`,`lang`,id_item) VALUES ('" . $_POST['xx'] . "','" . $_POST['text'] . "','" . $_SESSION['userid'] . "','" . $userip . "',now(),'2'," . $_POST['lid'] . ")");
   // exit(alert(2, "评论成功", "/list_x" . $_POST['lid'] . ".html#pl"));
    header("Location: "."/list_x" . $_POST['lid'] . ".html#pl");

}

if (@$_GET['id'] == 'spyd') {
    
    $pageId = @$_POST['pageid'];
    $telno = @$_POST['telno'];
    $wechatid = @$_POST['wechatid'];
    $name1 = @$_POST['name1'];
    $number1 = @$_POST['number1'];

    if ($telno == "" || $wechatid == "" || $name1 == "" || $number1 == "") {
        // 内容填写错误，不允许发送的状态设置
        // header("Location: /mallxx_".$pageId.".html");
        exit(alert(2, "输入内容有误", "/mallxx_".$pageId.".html"));
    }

    // 目标邮箱地址取得相关处理
    // 发送邮件
    $sendto_email = 'yuefuuan@gmail.com';
    $subject = '商品订单-商品ID'.$pageId;
    $body = '商品名：'.'<br>联系电话：'.$telno.'<br>微信号：'.$wechatid.'<br>联系人：'.$name1.'<br>数量：'.$number1;
    smtp_mail($sendto_email, $subject, $body);
    // 发送成功的状态设置
    exit(alert(2, "您的订单已提交，商家会及时联系您，请保持联系畅通。", "/mallxx_".$pageId.".html"));
}
<?php require_once 'coon.php';
if (@$_GET['ss'] == "list") {
    if ($_POST['offt'] == "退房日期") {
        $offt = "";
    } else {
        $offt = $_POST['offt'];
    }
    if ($_POST['ont'] == "退房日期") {
        $ont = "";
    } else {
        $ont = $_POST['ont'];
    }
    header("Location: /list2_1_0_0_0_1_" . urlencode($_POST['text']) . "_" . ($_POST['lid'] - 1) . "_" . $ont . "_" . $offt . ".html#fh5co-work-section");
    //echo ("Location: /list2_1_0_0_0_1_".urlencode($_POST['text'])."_".($_POST['lid']-1)."_".$_POST['ont']."_".$_POST['offt'].".html#fh5co-work-section");
    exit;
}

if (@$_GET['yy'] == "post") {
    if (@$_SESSION['userid'] == "") {
        header("Location: /signin.html");
        exit;
    }

    $rs = $pdo->query("SELECT * FROM pm_user WHERE ( name is not null or phone is not null) AND id = " . $_SESSION['userid']);
    if ($rs->rowCount() == 0) {
        exit(Alert(2, "未设置姓名和电话", "/user/grxx.html"));
    }

    $rs = $pdo->query("DELETE FROM pm_gwc WHERE uid = " . $_SESSION['userid'] . " AND onum IS NULL");

    $rs = $pdo->query("SELECT * FROM pm_hotel WHERE lang = 2 AND id = " . $_POST['room']);
    if ($rs->rowCount() == 0) {
        exit(Alert(2, "房间未找到", "/"));
    }

    $rs = $pdo->query("SELECT * FROM pm_gwc WHERE uid = " . $_SESSION['userid'] . " and onum is null AND room = " . $_POST['room']);
    if ($rs->rowCount() == 0) {
        $rs = $pdo->exec("INSERT INTO pm_gwc (`room`,`hotels`,`text`,`uid`,`userip`,`ont`,`offt`,`adults`,`children`,dtime) VALUES ('" . $_POST['room'] . "','" . $_POST['hotels'] . "','" . $_POST['text'] . "','" . $_SESSION['userid'] . "','" . $userip . "','" . $_POST['ont'] . "','" . $_POST['offt'] . "','" . $_POST['yuy'] . "','" . $_POST['yuy2'] . "',now())");
    }
    header("Location: /payment.html");
    exit;
}

if (@$_GET['pay'] == "post") {
    if (@$_SESSION['userid'] == "") {
        header("Location: /signin.html");
        exit;
    }
    $o = date('Ymdhis', time()) . rand(1000, 9999);
    $rs = $pdo->exec("UPDATE pm_gwc SET onum = '" . $o . "' WHERE id = " . $_POST['lid']);
    if ($_POST['pay'] == 0) {
        $rs = $pdo->exec("UPDATE pm_gwc SET pay = 0,tai = 2,yytime = now() WHERE onum = '" . $o . "'");
        exit(Alert(2, "预约成功,请等待客服致电确认预约信息", "/user/jddd.html"));
    } elseif ($_POST['pay'] == 1) {
        header("Location: /pay/create_direct_pay/alipayapi.php?o=" . $o);
    } elseif ($_POST['pay'] == 2) {
        header("Location: /pay/WxpayAPI_php_v3/example/native.php");
    } elseif ($_POST['pay'] == 3) {
        header("Location: /pay/paypal/alipayto.php?o=" . $o);
    }
    exit;
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

    $_SESSION['userid'] = "";
    $_SESSION['uservip'] = "";
    $_SESSION['username'] = "";

    exit(alert(2, "修改成功", "/signin.html"));
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
    exit(alert(2, "登录成功", "/user/"));

}

if (@$_GET['pl'] == 'post') {
    if (@$_SESSION['userid'] == "") {
        header("Location: /signin.html");
        exit;
    }

    $rs = $pdo->exec("INSERT INTO pm_hotel_pl (`rank`,`text`,`uid`,`userip`,`dtime`,`lang`,id_item) VALUES ('" . $_POST['xx'] . "','" . $_POST['text'] . "','" . $_SESSION['userid'] . "','" . $userip . "',now(),'2'," . $_POST['lid'] . ")");
    exit(alert(2, "评论成功", "/list_x" . $_POST['lid'] . ".html#pl"));

}
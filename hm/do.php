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
    //exit(Alert(2, "表单认证失败", "/"));
}
$_SESSION['formcode'] = rfc_encode(mt_rand(0, 1000000));
if ($_GET['id'] == 'reg') {

    $rs = $pdo->query("SELECT * FROM pm_user WHERE email LIKE '" . $_POST['mail'] . "'");
    if ($rs->rowCount() > 0) {
        exit(alert(2, "邮箱已经被注册", "/register.html"));
    }

    $rs = $pdo->query("SELECT * FROM pm_user WHERE phone LIKE '" . $_POST['phone'] . "'");
    if ($rs->rowCount() > 0) {
        exit(alert(2, "手机已经被注册", "/register.html"));
    }

    $rs = $pdo->exec("INSERT INTO pm_user (`email`,pass,token,phone,`name`,add_date) VALUES ('" . $_POST['mail'] . "','" . md5($_POST['pass']) . "','" . $userip . "','" . $_POST['phone'] . "','" . $_POST['name'] . "','".time()."')");

    exit(alert(2, "注册成功", "/signin.html"));
}

if ($_GET['id'] == 'dl') {
    $rs = $pdo->query("SELECT * FROM pm_user WHERE email LIKE '" . $_POST['mail'] . "' AND pass LIKE '" . md5($_POST['pass']) . "'");
    echo ("SELECT * FROM pm_user WHERE email LIKE '" . $_POST['mail'] . "' AND pass LIKE '" . md5($_POST['pass']) . "'");
    if ($rs->rowCount() == 0) {
        exit(alert(2, "帐号或密码错误", "/signin.html"));
    }

    $row = $rs->fetch();

    $_SESSION['userid'] = $row['id'];
    $_SESSION['username'] = $row['name'];

    exit(alert(2, "登录成功", "/user/"));

}
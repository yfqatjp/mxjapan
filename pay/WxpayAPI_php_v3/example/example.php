<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hm/coon.php';
if (@$_SESSION['userid'] == "") {
    header("Location: /signin.html");
    exit;
}
if (@$_GET['o'] == "") {
    exit("0");
}
$rs = $pdo->query("SELECT * FROM pm_gwc WHERE tai = 3 AND wxnum LIKE '" . $_GET['o'] . "' AND uid = " . $_SESSION['userid']);
if ($rs->rowCount() > 0) {
    echo "1";
}
echo "0";
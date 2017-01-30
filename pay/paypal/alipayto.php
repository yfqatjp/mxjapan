<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hm/coon.php';

$o = @$_GET['o'];
$rs = $pdo->query("SELECT * FROM pm_gwc WHERE onum LIKE  '" . $o . "' AND uid = " . $_SESSION['userid']);
$row = $rs->fetch();
?>
<!-- 
<form action="https://www.paypal.com/hk/cgi-bin/webscr" name="payForm" id="payForm" method="post">
 -->
 
<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" name="payForm" id="payForm" method="post">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="charset" value="utf-8">
    <input type="hidden" name="item_number" value="<?php echo $o ?>">
    <input type="hidden" name="business" value="yuefuquan-facilitator@gmail.com">
    <input type="hidden" name="item_name" value="订单ID:<?php echo $o ?>">
    <input type="hidden" name="currency_code" value="JPY">
   <!-- <input type="hidden" name="amount" value="<?php echo $row['price'] ?>"> --> 
    <input type="hidden" name="amount" value="2">
    
    <input type="hidden" name="shipping" value="0">
    <input type="hidden" name="cancel_return" value="http://<?php echo $_SERVER['HTTP_HOST'] ?>">
    <input type="hidden" name="return" value="http://<?php echo $_SERVER['HTTP_HOST'] ?>/user/jddd.html">
    <input type="hidden" name="notify_url" value="http://<?php echo $_SERVER['HTTP_HOST'] ?>/pay/paypal/NotifyUrl.php">
</form>
<script language="javascript">
    payForm.submit();
</script>
<?php require_once 'coon.php';
$navid = 9;
$_SESSION['formcode'] = rfc_encode(mt_rand(0, 1000000));
$rs = $pdo->query("SELECT * FROM `pm_page` WHERE `lang` = '2' AND id = " . $navid);
$row = $rs->fetch();

$rs2 = $pdo->query("SELECT * FROM pm_article_file WHERE checked = 1 AND lang = 2 AND type = 'image' AND file != '' ORDER BY rank LIMIT 1");
$row2 = $rs2->fetch();
?><!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" xmlns="http://www.w3.org/1999/html">
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
    <style>
        body {
            padding: 0;
            margin: 0;
            width: 100%;
            height: 100%;
        }
    </style>
    <link rel="stylesheet" href="js/daterangepicker.min.css">
    <script type="text/javascript" src="js/moment.min.js"></script>
    <script type="text/javascript" src="js/jquery.daterangepicker.min.js"></script>
<body>
<?php
$dis = "";

function getDateFromRange($startdate, $enddate)
{

    $stimestamp = $startdate;
    $etimestamp = $enddate;

    $days = ($etimestamp - $stimestamp) / 86400 + 1;

    $date = "[" . date('m,d,Y', $stimestamp) . "]";
    for ($i = 1; $i < $days; $i++) {
        $date .= ",[" . date('m,d,Y', $stimestamp + (86400 * $i)) . "]";
    }

    return $date;
}

if (@$_GET['d'] != "" && @$_GET['e'] != "") {
    $dis .= getDateFromRange($_GET['d'], $_GET['e']);
}
$rs = $pdo->query("SELECT *,a.room AS aroom FROM pm_gwc AS a LEFT JOIN pm_booking AS b ON a.onum = b.trans WHERE b.id IS NOT NULL AND (b.`status` = 4 OR b.`status` = 5) ");
while ($row = $rs->fetch()) {
    if ($dis != "") {
        $dis .= ",";
    }
    $dis .= getDateFromRange($row['from_date'], $row['to_date']);
}
$dis .= "";
?>

<form name="form" id="form" method="post" action="do?yy=post">
    <input type="hidden" name="formcode" value="<?php echo $_SESSION['formcode'] ?>">
    <input name="room" class="room" value="<?php echo $_GET['a'] ?>" type="hidden">
    <input name="hotels" value="<?php echo $_GET['f'] ?>" type="hidden">
    <div class="midd_57"><img src="images/14_03.png"></div>
    <div class="midd_58">在线预约</div>
    <span id="room">
    <div class="midd_59"><span>入住日期：</span>
        <div class="midd_60">
            <input name="ont" class="rendezvous-input-date"

                   data-validation-engine="validate[required]"
                   id="start">
        </div>
        <div class="clear"></div>
    </div>
    <div class="midd_59"><span>退房日期：</span>
        <div class="midd_60">
            <input name="offt" class="rendezvous-input-date"

                   data-validation-engine="validate[required]"
                   id="end">
        </div>
        <div class="clear"></div>
    </div>
    </span>
    <div class="midd_59"><span>成人：</span>
        <select name="yuy" id="yuy" class="input_3 adults">
        </select>
        <div class="clear"></div>
    </div>
    <div class="midd_59"><span>儿童（0-5岁）：</span>
        <select name="yuy2" id="yuy2" class="input_3 children">
        </select>
        <div class="clear"></div>
    </div>
    <div class="midd_59"><span>备注：</span>
        <textarea name="text" class="input_4"></textarea>
        <div class="clear"></div>
    </div>
    <input type="submit" name="button" class="input_5" value="立即预约">
</form>

<!-- 选择日期 -->
<script type="text/javascript">

    natDays = [
        <?php echo $dis?>
    ]
    ;

    function nationalDays(date) {
        for (i = 0; i < natDays.length; i++) {
            if (date.getFullYear() == natDays[i][2] && date.getMonth() == natDays[i][0] - 1
                && date.getDate() == natDays[i][1]) {
                return [false, natDays[i][2] + '_day'];
            }
        }
        return [true, ''];
    }


    $('#room').dateRangePicker(
        {
            separator: ' to ',
            getValue: function () {
                if ($('#start').val() && $('#end').val())
                    return $('#start').val() + ' to ' + $('#end').val();
                else
                    return '';
            },
            setValue: function (s, s1, s2) {
                $('#start').val(s1);
                $('#end').val(s2);
            },
            showShortcuts: false,
            beforeShowDay: nationalDays,
            startDate: '<?php echo date('Y-m-d')?>',
            startOfWeek: 'monday',
            autoClose: true
        })
    ;

    for (i = 1; i <= <?php echo $_GET['b']?>; i++) {
        document.form.yuy.options[document.form.yuy.length] = new Option(i + '人', i);
    }
    for (i = 0; i <= <?php echo $_GET['c'] ?>; i++) {
        document.form.yuy2.options[document.form.yuy2.length] = new Option(i + '人', i);
    }


    $(function () {
        $(".midd_57").click(function () {
            $(".tanchuang,.tanchuang1", parent.document).slideToggle();
        });
    });
</script>
</body>
</html>
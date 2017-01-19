<?php
function time_tran($the_time)
{
    $now_time = date("Y-m-d H:i:s", time());
    $now_time = strtotime($now_time);
    $show_time = strtotime($the_time);
    $dur = $now_time - $show_time;
    if ($dur < 0) {
        return $the_time;
    } else {
        if ($dur < 60) {
            return $dur . '秒前';
        } else {
            if ($dur < 3600) {
                return floor($dur / 60) . '分钟前';
            } else {
                if ($dur < 86400) {
                    return floor($dur / 3600) . '小时前';
                } else {
                    return floor($dur / 86400) . '天前';
                }
            }
        }
    }
}

function strtrunc($text, $length, $html = true, $ending = "...", $exact = false){

    $text = preg_replace("/\s/", " ", $text);
    $text = preg_replace("/\s\s+/", " ", $text);

    if(mb_strlen(preg_replace("/<.*?>/is", "", $text), "UTF-8") <= $length) return $text;

    if($html){
        preg_match_all("/(<.+?>)?([^<>]*)/is", $text, $matches, PREG_SET_ORDER);

        $matches_length = 0;
        $content_text = "";
        $tags = array();

        foreach($matches as $match){
            if(!empty($match[0])){
                if(strlen($content_text) < $length){
                    $content_text .= $match[2];
                    if(!empty($match[1])) $tags[strpos($match[0], $match[1]) + $matches_length] = $match[1];
                    $matches_length += strlen($match[0]);
                }else
                    break;
            }
        }
    }else
        $content_text = rip_tags($text);

    $result = substr($content_text, 0, $length);

    if(!$exact){
        $spacepos = strrpos($result, " ");
        if($spacepos !== false)
            $result = substr($result, 0, $spacepos);
    }
    if($html){
        foreach($tags as $tag_pos => $tag){
            $str_start = substr($result, 0, $tag_pos);
            $str_end = substr($result, $tag_pos, strlen($result) - $tag_pos);
            $result = $str_start.$tag.$str_end;
        }
        $result = close_html_tags($result);
        $result = preg_replace("/<([a-z]+[0-9]*)([^>]*)><\/([a-z]+[0-9]*)>/is", "", $result);
    }
    return $result.$ending;
}

function close_html_tags($text){

    preg_match_all("/<[^>]*>/", $text, $tags);
    $list = array();
    foreach($tags[0] as $tag){
      if($tag{1} != "/"){
          preg_match("/<([a-z]+[0-9]*)/i", $tag, $type);
          $list[] = $type[1];
      }else{
           preg_match("/<\/([a-z]+[0-9]*)/i", $tag, $type);
           for($i = count($list)-1; $i >= 0; $i--)
                if($list[$i] == $type[1]) $list[$i] = "";
        }
    }
    $closed_tags = "";
    for($i = count($list)-1; $i >= 0; $i--)
        if($list[$i] != "" && $list[$i] != "br") $closed_tags .= "</".$list[$i].">";

    return($text.$closed_tags);
}

function xml_to_array($xml)
{
    $reg = "/<(\w+)[^>]*>([\\x00-\\xFF]*)<\\/\\1>/";
    if (preg_match_all($reg, $xml, $matches)) {
        $count = count($matches[0]);
        for ($i = 0; $i < $count; $i++) {
            $subxml = $matches[2][$i];
            $key = $matches[1][$i];
            if (preg_match($reg, $subxml)) {
                $arr[$key] = xml_to_array($subxml);
            } else {
                $arr[$key] = $subxml;
            }
        }
    }
    return $arr;
}

function format_size($in)
{
    $in = abs($in);
    if ($in >= 1024 * 1024 * 1024) {
        $out = sprintf("%01.2f", $in / (1024 * 1024 * 1024)) . " GB";
    } elseif ($in >= 1024 * 1024) {
        $out = sprintf("%01.2f", $in / (1024 * 1024)) . " MB";
    } elseif ($in >= 1024) {
        $out = sprintf("%01.2f", $in / 1024) . " KB";
    } else {
        $out = $in . " Bytes";
    }
    return ($out);
}

function getDistance($lat1, $lng1, $lat2, $lng2)
{
    if (empty($lat1) || !is_numeric($lat1) || empty($lat2) || !is_numeric($lat1)) {
        return "未知";
    }

    $earthRadius = 6367000;

    $lat1 = ($lat1 * pi()) / 180;
    $lng1 = ($lng1 * pi()) / 180;

    $lat2 = ($lat2 * pi()) / 180;
    $lng2 = ($lng2 * pi()) / 180;


    $calcLongitude = $lng2 - $lng1;
    $calcLatitude = $lat2 - $lat1;
    $stepOne = pow(sin($calcLatitude / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($calcLongitude / 2), 2);
    $stepTwo = 2 * asin(min(1, sqrt($stepOne)));
    $calculatedDistance = $earthRadius * $stepTwo;

    return round($calculatedDistance) / 1000;
}

function rfc_rpl($str, $de = false)
{ //参数库
    if ($de) {
        $str = @str_replace("XxX", "/", @str_replace("ZzZ", "+", $str));
    } else {
        $str = @str_replace("/", "XxX", @str_replace("+", "ZzZ", $str));
    }
    return $str;
}

function rfc_encode($str)
{ //参数编码
    $nstr = "";
    $code = @base64_encode($str);
    $len = @strlen($code);
    for ($i = 0; $i < $len; $i++) {
        $nstr .= @chr(@ord(@substr($code, $i, 1)) + $i * 2 % 8 * 3);
    }
    return str_replace("=", "", rfc_rpl(@base64_encode($nstr)));
}

function rfc_decode($str)
{ //参数解码
    $nstr = "";
    $code = @base64_decode(rfc_rpl($str, true));
    $len = @strlen($code);
    for ($i = 0; $i < $len; $i++) {
        $nstr .= @chr(@ord(@substr($code, $i, 1)) - $i * 2 % 8 * 3);
    }
    return @base64_decode($nstr);
}

function code($a, $aa = 3)
{ //编码ID
    $b = '';
    $c = 1;
    for ($i = 0; $i < $aa; $i++) {
        $b .= "0";
    }
    if ($b == 9999) {
        $c++;
    }
    return $c . $b . $a;
}

function url($s = 0)
{ //生成访问url
    if ($s == 0) {
        return urlencode('http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"]);
    } elseif ($s == 1) {
        return 'http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER["SERVER_PORT"];
    } else {
        return 'http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    }
}

//水果php项目

$rq = '?nid=' . @$_GET['nid'] . '&aid=' . @$_GET['aid']; //后台标记

function diffdate($date1, $date2)
{ //计算时间差
    if ($date1 == "" || $date2 == "") {
        return 0;
    }
    $Date_List_a1 = explode("-", date("Y-m-d", strtotime($date1)));
    $Date_List_a2 = explode("-", date("Y-m-d", strtotime($date2)));
    $d1 = @mktime(0, 0, 0, $Date_List_a1[1], $Date_List_a1[2], $Date_List_a1[0]);
    $d2 = @mktime(0, 0, 0, $Date_List_a2[1], $Date_List_a2[2], $Date_List_a2[0]);
    $Days = round(($d1 - $d2) / 3600 / 24);
    return $Days;
}

function page($page, $iurl, $totalPage)
{
    @$u = $_SERVER['QUERY_STRING'];
    @$u = str_replace("&page=" . @$_GET['page'], "", @$u);
    @$u = str_replace("page=" . @$_GET['page'], "", @$u);
    if (@$u <> "") {
        @$ur = @$u . "&";
    }
    if ($iurl <> "") {
        $qian = "/" . $_SERVER['PHP_SELF'];
    }
    echo "<div id='pagina'>";
    echo '<a';

    if ($page != 1) {

        echo ' href="' . @$qian . '?' . @$ur . 'page=' . ($page - 1) . $iurl . '"';
    } else {
        echo ' class="hui" ';
    }

    echo '>上一页</a>';


    echo '<a href="' . @$qian . '?' . @$ur . 'page=1' . $iurl . '"';
    if ($page == 1) {
        echo 'class="number"';
    }
    echo '>1</a>';

    for ($i = 2; $i < $totalPage; $i++) {
        echo '<a href="' . @$qian . '?' . @$ur . 'page=' . $i . $iurl . '"';
        if ($page == $i) {
            echo 'class="number"';
        }
        echo '>' . $i . '</a>';
    }

    if ($page == $totalPage && $page != 1) {
        echo '<a href="' . @$qian . '?' . @$ur . 'page=' . $page . $iurl . '" class="number">' . $page . '</a>';
    }

    if ($page != $totalPage && $totalPage != 0) {
        echo '<a href="' . @$qian . '?' . @$ur . 'page=' . $totalPage . $iurl . '">' . $totalPage . '</a>';
    }

    echo '<a ';

    if ($page != $totalPage) {
        echo 'href="' . @$qian . '?' . @$ur . 'page=' . ($page + 1) . $iurl . '"';
    } else {
        echo ' class="hui" ';
    }

    echo '>下一页</a>';

    echo "</div>";
}

function pages($page, $i, $totalPage)
{ //分页样式2
    echo "<div id='pagina'>";
    if ($page != 1) {
        echo '<a href="' . str_ireplace(".php", "", $_SERVER['PHP_SELF']) . '.php?key=' . @$_REQUEST['key'] . '&lid=' . @$_REQUEST['lid'] . '&nid=' . @$_GET['nid'] . '&aid=' . @$_GET['aid'] . '&page=' . ($page - 1) . '">上一页</a>';
    }
    for ($i = 1; $i <= $totalPage; $i++) {
        echo '<a href="' . str_ireplace(".php", "", $_SERVER['PHP_SELF']) . '.php?key=' . @$_REQUEST['key'] . '&lid=' . @$_REQUEST['lid'] . '&nid=' . @$_GET['nid'] . '&aid=' . @$_GET['aid'] . '&page=' . $i . '"';
        if ($page == $i) {
            echo 'class="number"';
        }
        echo '>' . $i . '</a>';
    }
    if ($page < $totalPage) {
        echo '<a href="' . str_ireplace(".php", "", $_SERVER['PHP_SELF']) . '.php?key=' . @$_REQUEST['key'] . '&lid=' . @$_REQUEST['lid'] . '&nid=' . @$_GET['nid'] . '&aid=' . @$_GET['aid'] . '&page=' . ($page + 1) . '">下一页</a>';
    }
}

@$userip = $_SERVER['HTTP_X_FORWARDED_FOR'];
if ($userip == "") {
    $userip = $_SERVER["REMOTE_ADDR"];
}

function Alert($showType, $str, $url)
{
    echo "<script language='javascript'>";
    if ($str <> "") {
        echo "window.alert('" . $str . "');";
    }
    if ($showType == 1) {
        echo "window.history.go(-1); ";
    } elseif ($showType == 2) {
        echo "parent.window.location.href='" . $url . "';";
    } elseif ($showType == 5) {
        echo "window.location.href='" . $url . "'; ";
    } elseif ($showType == 3) {
        echo "window.open('','_self');window.close(); ";
    } elseif ($showType == 4) {
        echo "top.location.href='" . $url . "'; ";
    } elseif ($showType == 0) {
        echo "parent.location.reload();";
    } else {
        echo "window.location.href='" . @$_SERVER['HTTP_REFERER'] . "'; ";
    }
    echo "</script>";
}
<?php require_once 'coon.php';
function ImageToJPG($srcFile, $dst_file, $new_width, $new_height)
{
    $quality = 100;
    $data = @getimagesize($srcFile);
    switch ($data['2']) {
        case 1:
            $im = imagecreatefromgif($srcFile);
            break;
        case 2:
            $im = imagecreatefromjpeg($srcFile);
            break;
        case 3:
            $im = imagecreatefrompng($srcFile);
            break;
        case 6:
            $im = imagecreatefrombmp($srcFile);
            break;
    }

    $w = imagesx($im);
    $h = imagesy($im);
    $ratio_w = 1.0 * $new_width / $w;
    $ratio_h = 1.0 * $new_height / $h;
    $ratio = 1.0;
    // 生成的图像的高宽比原来的都小，或都大 ，原则是 取大比例放大，取大比例缩小（缩小的比例就比较小了）
    if (($ratio_w < 1 && $ratio_h < 1) || ($ratio_w > 1 && $ratio_h > 1)) {
        if ($ratio_w < $ratio_h) {
            $ratio = $ratio_h; // 情况一，宽度的比例比高度方向的小，按照高度的比例标准来裁剪或放大
        } else {
            $ratio = $ratio_w;
        }
        // 定义一个中间的临时图像，该图像的宽高比 正好满足目标要求
        $inter_w = (int)($new_width / $ratio);
        $inter_h = (int)($new_height / $ratio);
        $inter_img = imagecreatetruecolor($inter_w, $inter_h);
        //var_dump($inter_img);
        imagecopy($inter_img, $im, 0, 0, 0, 0, $inter_w, $inter_h);
        // 生成一个以最大边长度为大小的是目标图像$ratio比例的临时图像
        // 定义一个新的图像
        $new_img = imagecreatetruecolor($new_width, $new_height);
        //var_dump($new_img);exit();
        imagecopyresampled($new_img, $inter_img, 0, 0, 0, 0, $new_width, $new_height, $inter_w, $inter_h);

        imagejpeg($new_img, $dst_file, $quality); // 存储图像

    }
    // 2 目标图像 的一个边大于原图，一个边小于原图 ，先放大平普图像，然后裁剪
    // =if( ($ratio_w < 1 && $ratio_h > 1) || ($ratio_w >1 && $ratio_h <1) )
    else {
        $ratio = $ratio_h > $ratio_w ? $ratio_h : $ratio_w; //取比例大的那个值
        // 定义一个中间的大图像，该图像的高或宽和目标图像相等，然后对原图放大
        $inter_w = (int)($w * $ratio);
        $inter_h = (int)($h * $ratio);
        $inter_img = imagecreatetruecolor($inter_w, $inter_h);
        //将原图缩放比例后裁剪
        imagecopyresampled($inter_img, $im, 0, 0, 0, 0, $inter_w, $inter_h, $w, $h);
        // 定义一个新的图像
        $new_img = imagecreatetruecolor($new_width, $new_height);
        imagecopy($new_img, $inter_img, 0, 0, 0, 0, $new_width, $new_height);

        imagejpeg($new_img, $dst_file, $quality); // 存储图像

    }
}

$ret = array();

if (@$_SESSION['userid'] == "") {
    $ret['file'] = "存储空间不足";
    $ret['tai'] = "off";
    echo json_encode($ret, JSON_UNESCAPED_UNICODE);
    exit;
}

if (@$_GET['xx'] == "") {
    $ret['file'] = "存储空间不足";
    $ret['tai'] = "off";
    echo json_encode($ret, JSON_UNESCAPED_UNICODE);
    exit;
}

if (isset($_FILES["myfile"])) {
    $uploadDir = DIRECTORY_SEPARATOR . 'uploadFiles' . DIRECTORY_SEPARATOR . $_GET['xx'] . DIRECTORY_SEPARATOR;
    $dir = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . $uploadDir;
    file_exists($dir) || (mkdir($dir, 0777, true) && chmod($dir, 0777));
    if (!is_array($_FILES["myfile"]["name"])) {
        $a = pathinfo($_FILES["myfile"]["name"]);
        $fileName = time() . uniqid() . '.jpg';

        move_uploaded_file($_FILES["myfile"]["tmp_name"], $dir . $fileName);
        $ret['file'] = str_replace("\\", "/", $uploadDir . $fileName);
        //$arr = getimagesize($dir.$fileName);
        //$ret['width'] = $arr[0];
        //$ret['height'] = $arr[1];
        $ret['size'] = format_size($_FILES["myfile"]["size"]);
        $ret['tai'] = "ok";
        $ret['type'] = $_GET['xx'];

        if ($_GET['xx'] == "tou") {
            ImageToJPG($dir . $fileName, $dir . $fileName, "150", "150");
            $rs = $pdo->exec("UPDATE pm_user SET ico='".$ret['file']."' WHERE id = " . $_SESSION['userid']);
        }

        if ($_GET['xx'] == "pl") {
            //ImageToJPG($dir . $fileName, $dir . $fileName, "133", "133");
        }

        echo json_encode($ret);
    }
}
?>
<?php
require_once("../../../common/lib.php");
require_once("../../../common/define.php");
if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Example: File Upload</title>
</head>
<body>
<?php
// Required: anonymous function reference number as explained above.
$funcNum = $_GET['CKEditorFuncNum'] ;
// Optional: instance name (might be used to load a specific configuration file or anything else).
$CKEditor = $_GET['CKEditor'] ;
// Optional: might be used to provide localized messages.
$langCode = '2' ;
// Optional: compare it with the value of `ckCsrfToken` sent in a cookie to protect your server side uploader against CSRF.
// Available since CKEditor 4.5.6.
$token = $_SESSION['token'];
$dir = $_SESSION['module_referer'];
$uniqid = uniqid();
$path = "../../../medias/".$dir."/tmp";
$path1 = "medias/".$dir."/tmp";
if(!empty($_FILES)){
    $now = new DateTime();
    $a = md5("sessid_".$uniqid.$_POST['timestamp']);
    // upload folder for a session
    if(!is_dir($path."/".$token)) mkdir($path."/".$token, 0777);
    chmod($path."/".$token, 0777);
    if(!is_dir($path."/".$token."/".$langCode)) mkdir($path."/".$token."/".$langCode, 0777);
    chmod($path."/".$token."/".$langCode, 0777);
    if(!is_dir($path."/".$token."/".$langCode."/".$uniqid)) mkdir($path."/".$token."/".$langCode."/".$uniqid, 0777);
    chmod($path."/".$token."/".$langCode."/".$uniqid, 0777);
    $tempFile = $_FILES['upload']['tmp_name'];
        
    $ext = mb_strtolower(strrchr($_FILES['upload']['name'], "."), "UTF-8");
    $filename = str_replace($ext, "", mb_strtolower($_FILES['upload']['name'], "UTF-8"));
    $patern_from = "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüýÿÑñ";
    $patern_to = "aaaaaaaaaaaaooooooooooooeeeeeeeecciiiiiiiiuuuuuuuuyynn";
    
    $filename = utf8_decode($filename);
    $patern_from = utf8_decode($patern_from);
    $patern_to = utf8_decode($patern_to);
    
    $filename = strtr($filename, $patern_from, $patern_to);
    $filename = preg_replace("/([^a-z0-9]+)/i", "-", $filename);
    $filename = preg_replace("/-[-]+/", "-", $filename);
    $filename = trim($filename, "-");
    $filename = strtolower($filename);
    $filename = utf8_encode($filename).$ext;
    $targetFile = $path."/".$token."/".$langCode."/".$uniqid."/".$filename;
    $path1 = $path1."/".$token."/".$langCode."/".$uniqid."/".$filename;

    move_uploaded_file($tempFile, $targetFile);
}

// Check the $_FILES array and save the file. Assign the correct path to a variable ($url).
$url = "/".$path1;
// Usually you will only assign something here if the file could not be uploaded.
// $message = 'The uploaded file has been renamed';

// echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";
echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url');</script>";
?>
</body>
</html>
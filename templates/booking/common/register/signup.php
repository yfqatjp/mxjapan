<?php
/**
 * Script called (Ajax) on login
 */
require_once("../../../../common/lib.php");
require_once("../../../../common/define.php");
    
$response = array("html" => "", "notices" => array(), "error" => "", "success" => "", "redirect" => "");

$login = htmlentities($_POST['username'], ENT_COMPAT, "UTF-8");
$email = htmlentities($_POST['email'], ENT_COMPAT, "UTF-8");
$name = htmlentities($_POST['name'], ENT_COMPAT, "UTF-8");
$password = $_POST['password'];

if($name == "") $response['notices']['name'] = $texts['REQUIRED_FIELD'];
if($login == "") $response['notices']['username'] = $texts['REQUIRED_FIELD'];
if(strlen($password) < 6) $response['notices']['password'] = $texts['PASS_TOO_SHORT'];
if($email == "" || !preg_match("/^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$/i", $email)) $response['notices']['email'] = $texts['INVALID_EMAIL'];

$result_exists = $db->query("SELECT * FROM pm_user WHERE email = ".$db->quote($email)." OR login = ".$db->quote($login));
if($result_exists !== false && $db->last_row_count() > 0){
    $row = $result_exists->fetch();
    if($email = $row['email']) $response['notices']['email'] = $texts['ACCOUNT_EXISTS'];
    if($login = $row['login']) $response['notices']['username'] = $texts['USERNAME_EXISTS'];
}
        
if(count($response['notices']) == 0){

    $data = array();
    $data['id'] = "";
    $data['name'] = $name;
    $data['login'] = $login;
    $data['email'] = $email;
    $data['pass'] = md5($password);
    $data['type'] = "registered";
    $data['checked'] = 1;
    $data['add_date'] = time();

    $result_user = db_prepareInsert($db, "pm_user", $data);
    if($result_user->execute() !== false){
        
        $_SESSION['user']['id'] = $db->lastInsertId();
        $_SESSION['user']['login'] = $login;
        $_SESSION['user']['email'] = $email;
        $_SESSION['user']['type'] = "registered";
        
        $response['success'] = $texts['ACCOUNT_CREATED'];
    }else
        $response['error'] = $texts['ACCOUNT_CREATE_FAILURE'];
}else
    $response['error'] = $texts['FORM_ERRORS'];

echo json_encode($response);

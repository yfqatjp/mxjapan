<?php
if(!isset($_SESSION['user']) || $_SESSION['user']['type'] != "registered"){
    header("Location: ".DOCBASE);
    exit();
}

$msg_error = "";
$msg_success = "";
$field_notice = array();

$result_user = $db->query("SELECT * FROM pm_user WHERE id = ".$db->quote($_SESSION['user']['id'])." AND checked = 1");
if($result_user !== false && $db->last_row_count() == 1){
    $row = $result_user->fetch();
    
    $name = $row['name'];
    $login = $row['login'];
    $email = $row['email'];
    $address = $row['address'];
    $postcode = $row['postcode'];
    $city = $row['city'];
    $company = $row['company'];
    $country = $row['country'];
    $mobile = $row['mobile'];
    $phone = $row['phone'];
    
}else{
    $name = "";
    $login = "";
    $email = "";
    $address = "";
    $postcode = "";
    $city = "";
    $company = "";
    $country = "";
    $mobile = "";
    $phone = ""; 
}

if(isset($_POST['edit'])){
    
    $name = $_POST['name'];
    $login = $_POST['login'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $postcode = $_POST['postcode'];
    $city = $_POST['city'];
    $company = $_POST['company'];
    $country = $_POST['country'];
    $mobile = $_POST['mobile'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    
    if($name == "") $field_notice['name'] = $texts['REQUIRED_FIELD'];
    if($login == "") $field_notice['login'] = $texts['REQUIRED_FIELD'];
    if($address == "") $field_notice['address'] = $texts['REQUIRED_FIELD'];
    if($postcode == "") $field_notice['postcode'] = $texts['REQUIRED_FIELD'];
    if($city == "") $field_notice['city'] = $texts['REQUIRED_FIELD'];
    if($country == "" || $country == "0") $field_notice['country'] = $texts['REQUIRED_FIELD'];
    if($password != ""){
        if($password_confirm != $password) $field_notice['password_confirm'] = $texts['PASS_DONT_MATCH'];
        if(strlen($password) < 6) $field_notice['password'] = $texts['PASS_TOO_SHORT'];
    }
    if($phone == "" || preg_match("/([0-9\-\s\+\(\)\.]+)/i", $phone) !== 1) $field_notice['phone'] = $texts['REQUIRED_FIELD'];
    if($email == "" || !preg_match("/^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$/i", $email)) $field_notice['email'] = $texts['INVALID_EMAIL'];
    
    $result_exists = $db->query("SELECT * FROM pm_user WHERE id != ".$db->quote($_SESSION['user']['id'])." AND (email = ".$db->quote($email)." OR login = ".$db->quote($login).")");
    if($result_exists !== false && $db->last_row_count() > 0){
        $row = $result_exists->fetch();
        if($email = $row['email']) $field_notice['email'] = $texts['ACCOUNT_EXISTS'];
        if($login = $row['login']) $field_notice['login'] = $texts['USERNAME_EXISTS'];
    }
    
    if(count($field_notice) == 0){

        $data = array();
        $data['id'] = $_SESSION['user']['id'];
        $data['name'] = $name;
        $data['login'] = $login;
        $data['email'] = $email;
        $data['pass'] = md5($password);
        $data['address'] = $address;
        $data['postcode'] = $postcode;
        $data['city'] = $city;
        $data['company'] = $company;
        $data['country'] = $country;
        $data['mobile'] = $mobile;
        $data['phone'] = $phone;
        $data['edit_date'] = time();

        $result_user = db_prepareUpdate($db, "pm_user", $data);
        if($result_user->execute() !== false){
            
            $_SESSION['user']['login'] = $login;
            $_SESSION['user']['email'] = $email;
            
            $msg_success .= $texts['ACCOUNT_EDIT_SUCCESS'];
        }else
            $msg_error .= $texts['ACCOUNT_EDIT_FAILURE'];
    }else
        $msg_error .= $texts['FORM_ERRORS'];
    
}

require(getFromTemplate("common/header.php", false)); ?>

<section id="page">
    
    <?php include(getFromTemplate("common/page_header.php", false)); ?>
    
    <div class="container">
        <h2 class="page-title">Travel Profile</h2>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <aside class="user-profile-sidebar">
                    <div class="user-profile-avatar text-center">
                        <img src="<?php echo getFromTemplate("images/300x300.png"); ?>" alt="Image Alternative text" title="AMaze" />
                        <h5>John Doe</h5>
                        <p>Member Since May 2012</p>
                    </div>
                    <ul class="list user-profile-nav">
                        <li>
                            <a href="<?php echo DOCBASE.LANG_ALIAS.'account/0'; ?>">
                            <!--<a href="user-profile.php">-->
                                <i class="fa fa-user"></i>
                                Overview
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo DOCBASE.LANG_ALIAS.'account/1'; ?>">
                            <!--<a href="user-profile-settings.html">-->
                                <i class="fa fa-cog"></i>
                                Settings
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo DOCBASE.LANG_ALIAS.'account/2'; ?>">
                            <!--<a href="user-profile-photos.html">-->
                                <i class="fa fa-camera"></i>
                                My Travel Photos
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo DOCBASE.LANG_ALIAS.'account/3'; ?>">
                            <!--<a href="user-profile-booking-history.html">-->
                                <i class="fa fa-clock-o"></i>
                                Booking History
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo DOCBASE.LANG_ALIAS.'account/4'; ?>">
                            <!--<a href="user-profile-cards.html">-->
                                <i class="fa fa-credit-card"></i>
                                Credit/Debit Cards
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo DOCBASE.LANG_ALIAS.'account/5'; ?>">
                            <!--<a href="user-profile-wishlist.html">-->
                                <i class="fa fa-heart-o"></i>
                                Wishlist
                            </a>
                        </li>
                    </ul>
                </aside>
            </div>
            <div class="col-md-9">
                <?php 
                    if($article_alias == "" || $article_alias == 0){
                        include(getFromTemplate("common/user-profile.php", false));
                    }else if($article_alias == 1){
                        include(getFromTemplate("common/user-profile-settings.php", false));
                    }else if($article_alias == 2){
                        include(getFromTemplate("common/user-profile-photos.php", false));
                    }else if($article_alias == 3){
                        include(getFromTemplate("common/user-profile-booking-history.php", false));
                    }else if($article_alias == 4){
                        include(getFromTemplate("common/user-profile-cards.php", false));
                    }else if($article_alias == 5){
                        include(getFromTemplate("common/user-profile-wishlist.php", false));
                    }
                ?>
            </div>
        </div>
    </div>

    <div class="gap"></div>

    
</section>

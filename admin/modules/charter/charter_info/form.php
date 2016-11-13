<?php
/**
 * Template of the module form
 */
debug_backtrace() || die ("Direct access not permitted");
 
// Item ID
if(isset($_GET['id']) && is_numeric($_GET['id'])) $id = $_GET['id'];
elseif(isset($_POST['id']) && is_numeric($_POST['id'])) $id = $_POST['id'];
else{
    header("Location: index.php?view=list");
    exit();
}

// Item ID to delete
$id_file = (isset($_GET['file']) && is_numeric($_GET['file'])) ? $_GET['file'] : 0;
$id_row = (isset($_GET['row']) && is_numeric($_GET['row'])) ? $_GET['row'] : 0;

// Action to perform
$back = false;
$action = (isset($_GET['action'])) ? htmlentities($_GET['action'], ENT_QUOTES, "UTF-8") : "";
if(isset($_POST['edit']) || isset($_POST['edit_back'])){
    $action = "edit";
    if(isset($_POST['edit_back'])) $back = true;
}
if(isset($_POST['add']) || isset($_POST['add_back'])){
    $action = "add";
    $id = 0;
    if(isset($_POST['add_back'])) $back = true;
}

// Initializations
$file = array();
$img = array();
$img_label = array();
$file_label = array();
$fields_checked = true;
$total_lang = 1;
$rank = 0;
$old_rank = 0;
$home = 0;
$checked = 0;
$add_date = null;
$edit_date = time();
$publish_date = time();
$unpublish_date = null;
$id_user = $_SESSION['user']['id'];
$referer = DIR."index.php?view=form";

// Messages
if(NB_FILES > 0) $_SESSION['msg_notice'][] = $texts['EXPECTED_IMAGES_SIZE']." ".MAX_W_BIG." x ".MAX_H_BIG."px<br>";

// Creation of the unique token for uploadifive
if(!isset($_SESSION['uniqid'])) $_SESSION['uniqid'] = uniqid();
if(!isset($_SESSION['timestamp'])) $_SESSION['timestamp'] = time();
if(!isset($_SESSION['token'])) $_SESSION['token'] = md5("sessid_".$_SESSION['uniqid'].$_SESSION['timestamp']);

// Getting languages
if(MULTILINGUAL && $db != false){
    $result_lang = $db->query("SELECT id, title FROM pm_lang WHERE checked = 1 ORDER BY CASE main WHEN 1 THEN 0 ELSE 1 END, rank");
    if($result_lang !== false){
        $total_lang = $db->last_row_count();
        $langs = $result_lang->fetchAll(PDO::FETCH_ASSOC);
    }
}

// Last rank selection
if(RANKING && $db != false){
    $result_rank = $db->query("SELECT rank FROM pm_".MODULE." ORDER BY rank DESC LIMIT 1");
    $rank = ($result_rank !== false && $db->last_row_count() > 0) ? $result_rank->fetchColumn(0) + 1 : 1;
}

// Inclusions
require_once(SYSBASE.ADMIN_FOLDER."/includes/fn_form.php");

$fields = getFields($db);
if(is_null($fields)) $fields = array();

/* @jeff 包车服务  start */
// 应用的前期处理
$hotelApp->beforeAction($fields, $id);
// 服务项目
$arrItem = array();
//
$activeItem = 1;
/* @jeff 包车服务  end */

// Getting datas in the database
if($db !== false){
	// 取得服务项目
	$chartItemSql = "SELECT * FROM pm_charter_item WHERE checked = 1 ";
	if(db_column_exists($db, "pm_charter_item", "lang")) $chartItemSql .=  " and lang = ".DEFAULT_LANG;
	$chartItemSql .=  " ORDER BY id asc ";
	$result = $db->query($chartItemSql);
	if($result !== false){
		foreach($result as $row){
			$arrItem[] = $row;
		}
	}
    $result = $db->query("SELECT * FROM pm_".MODULE." WHERE id = ".$id);
    if($result !== false){
        
        // Datas of the module
            
        foreach($result as $row){
            
            $id_lang = (MULTILINGUAL) ? $row['lang'] : 0;
            
            foreach($fields[MODULE]['fields'] as $fieldName => $field){
                if($field->getType() != "separator")
                    $field->setValue($row[$fieldName], 0, $id_lang);
            }
            
            if($id_lang == DEFAULT_LANG || $id_lang == 0){
                if(HOME) $home = $row['home'];
                if(VALIDATION) $checked = $row['checked'];
                if(RANKING) $old_rank = $row['rank'];
                if(DATES) $add_date = $row['add_date'];
                if(RELEASE){
                    $publish_date = $row['publish_date'];
                    $unpublish_date = $row['unpublish_date'];
                }
                if(db_column_exists($db, "pm_".MODULE, "id_user")){
                    $id_user = $row['id_user'];
                    if(!in_array($_SESSION['user']['type'], array("administrator", "manager", "editor")) && $id_user != $_SESSION['user']['id']){
                        header("Location: index.php?view=list");
                        exit();
                    }
                }
            }
        }
    }
    
    // Datas of the module's tables
        
    foreach($fields as $tableName => $fields_table){
        
        if($tableName != MODULE){
        
            $result = $db->query("SELECT * FROM pm_".$tableName." WHERE ".$fields_table['table']['fieldRef']." = ".$id);
            if($result !== false){
                
                foreach($result as $i => $row){
                    
                    $id_lang = (MULTILINGUAL) ? $row['lang'] : 0;
                
                    foreach($fields_table['fields'] as $fieldName => $field){
                        if($field->getType() != "separator")
                            $field->setValue($row[$fieldName], $i, $id_lang);
                    }
                }
            }
        }
    }
    
    // Insersion / update
    if(in_array("add", $permissions) || in_array("edit", $permissions) || in_array("all", $permissions)){
        if((($action == "add") || ($action == "edit")) && check_token($referer, "form", "post")){
            
            $files = array();
                    
            // Getting POST values
            for($i = 0; $i < $total_lang; $i++){
                
                $id_lang = (MULTILINGUAL) ? $langs[$i]['id'] : 0;
                
                foreach($fields as $tableName => $fields_table){
                    
                    foreach($fields_table['fields'] as $fieldName => $field){
                        $fieldName = $tableName."_".$fieldName."_";
                        $fieldName .= (MULTILINGUAL && !$field->isMultilingual()) ? DEFAULT_LANG : $id_lang;
                        
                        if(isset($_POST[$fieldName])){
                            
                            foreach($_POST[$fieldName] as $index => $value){
                        
                                switch($field->getType()){
                                    case "date" :
                                        $date = isset($_POST[$fieldName][$index]['date']) ? $_POST[$fieldName][$index]['date'] : "";
                                        if(!empty($date)) $date = strtotime($date." 00:00:00");
                                        if(is_numeric($date) && $date !== false)
                                            $field->setValue($date, $index, $id_lang);
                                        else
                                            $field->setValue(NULL, $index, $id_lang);
                                    break;
                                    case "datetime" :
                                        $date = isset($_POST[$fieldName][$index]['date']) ? $_POST[$fieldName][$index]['date'] : "";
                                        $hour = isset($_POST[$fieldName][$index]['hour']) ? $_POST[$fieldName][$index]['hour'] : "";
                                        $minute = isset($_POST[$fieldName][$index]['minute']) ? $_POST[$fieldName][$index]['minute'] : 0;
                                        if(!empty($date) && is_numeric($hour) && is_numeric($minute)) $date = strtotime($date." ".$hour.":".$minute.":00");
                                        if(is_numeric($date) && $date !== false)
                                            $field->setValue($date, $index, $id_lang);
                                        else
                                            $field->setValue(NULL, $index, $id_lang);
                                    break;
                                    case "password" :
                                        $value = ($value != "") ? md5($value) : "";
                                        if($value == "") $value = $field->getValue(false, $index, $id_lang);
                                        $field->setValue($value, $index, $id_lang);
                                    break;
                                    case "checkbox" :
                                    case "multiselect" :
                                        $value = isset($_POST[$fieldName][$index]) ? implode(",", $_POST[$fieldName][$index]) : "";
                                        $field->setValue($value, $index, $id_lang);
                                    break;
                                    case "alias" :
                                        $value = text_format($_POST[$fieldName][$index]);
                                        $field->setValue($value, $index, $id_lang);
                                    break;
                                    default :
                                        $value = isset($_POST[$fieldName][$index]) ? $_POST[$fieldName][$index] : "";
                                        $field->setValue($value, $index, $id_lang);
                                    break;
                                }
                            }
                        }
                    }
                }
            }
            
            // Remove row if (all fields = empty) and if (tableName != MODULE)
            
            foreach($fields as $tableName => $fields_table){
                if($tableName != MODULE){
                    $numRows = getNumMaxRows($fields, $tableName);
                    for($index = 0; $index < $numRows; $index++){
                        
                        $empty = true;
                        $id_row = 0;
                        if(isset($_POST[$tableName."_id_".DEFAULT_LANG][$index]))
                            $id_row = $_POST[$tableName."_id_".DEFAULT_LANG][$index];
                            
                        if($id_row == 0 || $id_row == ""){
                        
                            foreach($fields_table['fields'] as $fieldName => $field){
                                $value = $field->getValue(false, $index);
                                if(!empty($value)) $empty = false;
                            }
                            if($empty){
                                foreach($fields_table['fields'] as $fieldName => $field){
                                    $field->removeValue($index);
                                }
                            }
                        }
                    }
                }
            }
            
            if(VALIDATION && isset($_POST['checked']) && is_numeric($_POST['checked'])) $checked = $_POST['checked'];
            if(HOME && isset($_POST['home']) && is_numeric($_POST['home'])) $home = $_POST['home'];
            if(DATES && (!is_numeric($add_date) || $add_date == 0)) $add_date = time();
            if(RELEASE){
                $day = (isset($_POST['publish_date_day'])) ? $_POST['publish_date_day'] : "";
                $month = (isset($_POST['publish_date_month'])) ? $_POST['publish_date_month'] : "";
                $year = (isset($_POST['publish_date_year'])) ? $_POST['publish_date_year'] : "";
                $hour = (isset($_POST['publish_date_hour'])) ? $_POST['publish_date_hour'] : "";
                $minute = (isset($_POST['publish_date_minute'])) ? $_POST['publish_date_minute'] : "";
                if(is_numeric($day) && is_numeric($month) && is_numeric($year) && is_numeric($hour) && is_numeric($minute))
                    $publish_date = mktime($hour, $minute, 0, $month, $day, $year);
                else
                    $publish_date = NULL;
                    
                $day = (isset($_POST['unpublish_date_day'])) ? $_POST['unpublish_date_day'] : "";
                $month = (isset($_POST['unpublish_date_month'])) ? $_POST['unpublish_date_month'] : "";
                $year = (isset($_POST['unpublish_date_year'])) ? $_POST['unpublish_date_year'] : "";
                $hour = (isset($_POST['unpublish_date_hour'])) ? $_POST['unpublish_date_hour'] : "";
                $minute = (isset($_POST['unpublish_date_minute'])) ? $_POST['unpublish_date_minute'] : "";
                if(is_numeric($day) && is_numeric($month) && is_numeric($year) && is_numeric($hour) && is_numeric($minute))
                    $unpublish_date = mktime($hour, $minute, 0, $month, $day, $year);
                else
                    $unpublish_date = NULL;
            }
            if(isset($_POST['id_user'])) $id_user = $_POST['id_user'];
            
            if(checkFields($db, $fields, $id)){
                
                for($i = 0; $i < $total_lang; $i++){
                    
                    $id_lang = (MULTILINGUAL) ? $langs[$i]['id'] : 0;
                    
                    // Add / Edit item in the table of the module
                    
                    $data = array();
                    $data['id'] = $id;
                    $data['lang'] = $id_lang;
                    $data['rank'] = $rank;
                    $data['home'] = $home;
                    $data['checked'] = $checked;
                    $data['add_date'] = $add_date;
                    $data['edit_date'] = $edit_date;
                    $data['publish_date'] = $publish_date;
                    $data['unpublish_date'] = $unpublish_date;
                    $data['id_user'] = $id_user;
                        
                    foreach($fields[MODULE]['fields'] as $fieldName => $field)
                        $data[$fieldName] = $field->getValue(false, 0, $id_lang);
                    
                    if($action == "add" && (in_array("add", $permissions) || in_array("all", $permissions))){
                            
                        $result_insert = db_prepareInsert($db, "pm_".MODULE, $data);
                        
                        add_item($db, MODULE, $result_insert, $id_lang);

                    }elseif($action == "edit" && (in_array("edit", $permissions) || in_array("all", $permissions))){
                        
                        $query_exist = "SELECT * FROM pm_".MODULE." WHERE id = ".$id;
                        if(MULTILINGUAL) $query_exist .= " AND lang = ".$id_lang;
                        $result_exist = $db->query($query_exist);
                        
                        $data['rank'] = $old_rank;
                        
                        if($result_exist !== false){
                            if($db->last_row_count() > 0){
                                    
                                $result_update = db_prepareUpdate($db, "pm_".MODULE, $data);
                                
                                edit_item($db, MODULE, $result_update, $id, $id_lang);
                            }else{
                                $result_insert = db_prepareInsert($db, "pm_".MODULE, $data);
                                
                                add_item($db, MODULE, $result_insert, $id_lang);
                            }
                        }
                    }
                    
                    // Add / Edit items in other tables
                    if(empty($_SESSION['msg_error']) && $id > 0){
                    
                        foreach($fields as $tableName => $fields_table){
                            if($tableName != MODULE){
                                $numRows = getNumMaxRows($fields, $tableName);
                                for($index = 0; $index < $numRows; $index++){
                                    
                                    $id_row = $fields_table['fields']['id']->getValue(false, $index, $id_lang);
                                    
                                    $data = array();
                                    $data['lang'] = $id_lang;
                                    $data[$fields_table['table']['fieldRef']] = $id;
                                        
                                    foreach($fields_table['fields'] as $fieldName => $field)
                                        $data[$fieldName] = $field->getValue(false, $index, $id_lang);
                                    
                                    if($id_row == 0 && (in_array("add", $permissions) || in_array("all", $permissions))){
                                            
                                        $result_insert = db_prepareInsert($db, "pm_".$tableName, $data);
                                        if($result_insert->execute() !== false){
                                            $fields_table['fields']['id']->setValue($db->lastInsertId(), $index, $id_lang);
                                        }

                                    }elseif($id_row > 0 && (in_array("edit", $permissions) || in_array("all", $permissions))){
                                        
                                        $query_exist = "SELECT * FROM pm_".$tableName." WHERE id = ".$id_row;
                                        if(MULTILINGUAL) $query_exist .= " AND lang = ".$id_lang;
                                        $result_exist = $db->query($query_exist);
                                        
                                        if($result_exist !== false){
                                            if($db->last_row_count() > 0){
                                                    
                                                $result_update = db_prepareUpdate($db, "pm_".$tableName, $data);
                                                $result_update->execute();
                                                
                                            }else{
                                                $result_insert = db_prepareInsert($db, "pm_".$tableName, $data);
                                                if($result_insert->execute() !== false){
                                                    $fields_table['fields']['id']->setValue($db->lastInsertId(), $index, $id_lang);
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }else
                $_SESSION['msg_error'][] = $texts['FORM_ERRORS'];
        }
    }

    if(($back === true) && empty($_SESSION['msg_error']) && !empty($_SESSION['msg_success'])){
        header("Location: index.php?view=list");
        exit();
    }

    if(in_array("edit", $permissions) || in_array("all", $permissions)){
        // Row deletion
        if($action == "delete_row" && $id_row > 0 && isset($_GET['table']) && isset($_GET['fieldref']) && check_token($referer, "form", "get"))
            delete_row($db, $id, $id_row, "pm_".$_GET['table'], $_GET['fieldref']);
            
        // File deletion
        if($action == "delete_file" && $id_file > 0 && check_token($referer, "form", "get"))
            delete_file($db, $id_file);
            
        if($action == "delete_multi_file" && isset($_POST['multiple_file']) && check_token($referer, "form", "get"))
            delete_multi_file($db, $_POST['multiple_file'], $id);
            
        // File activation/deactivation
        if($action == "check_file" && $id_file > 0 && check_token($referer, "form", "get"))
            check($db, "pm_".MODULE."_file", $id_file, 1);

        if($action == "uncheck_file" && $id_file > 0 && check_token($referer, "form", "get"))
            check($db, "pm_".MODULE."_file", $id_file, 2);
            
        if($action == "check_multi_file" && isset($_POST['multiple_file']) && check_token($referer, "form", "get"))
            check_multi($db, "pm_".MODULE."_file", 1, $_POST['multiple_file']);
            
        if($action == "uncheck_multi_file" && isset($_POST['multiple_file']) && check_token($referer, "form", "get"))
            check_multi($db, "pm_".MODULE."_file", 2, $_POST['multiple_file']);
            
        // Files displayed in homepage
        if($action == "display_home_file" && $id_file > 0 && check_token($referer, "form", "get"))
            display_home($db, "pm_".MODULE."_file", $id_file, 1);

        if($action == "remove_home_file" && $id_file > 0 && check_token($referer, "form", "get"))
            display_home($db, "pm_".MODULE."_file", $id_file, 0);
            
        if($action == "display_home_multi_file" && isset($_POST['multiple_file']) && check_token($referer, "form", "get"))
            display_home_multi($db, "pm_".MODULE."_file", 1, $_POST['multiple_file']);
            
        if($action == "remove_home_multi_file" && isset($_POST['multiple_file']) && check_token($referer, "form", "get"))
            display_home_multi($db, "pm_".MODULE."_file", 0, $_POST['multiple_file']);
    }
}

// File download
if($action == "download" && isset($_GET['type'])){
    $type = $_GET['type'];
    if($id_file > 0){
        if($type == "image" || $type == "other"){
            $query_file = "SELECT file FROM pm_".MODULE."_file WHERE id = ".$id_file;
            if(MULTILINGUAL) $query_file .= " AND lang = ".DEFAULT_LANG;
            $result_file = $db->query($query_file);
            if($result_file !== false && $db->last_row_count() > 0){
                $file = $result_file->fetchColumn(0);
                
                if($type == "image"){
                    if(is_file(SYSBASE."medias/".MODULE."/big/".$id_file."/".$file))
                        $filepath = SYSBASE."medias/".MODULE."/big/".$id_file."/".$file;
                    elseif(is_file(SYSBASE."medias/".MODULE."/medium/".$id_file."/".$file))
                        $filepath = SYSBASE."medias/".MODULE."/medium/".$id_file."/".$file;
                    elseif(is_file(SYSBASE."medias/".MODULE."/small/".$id_file."/".$file))
                        $filepath = SYSBASE."medias/".MODULE."/small/".$id_file."/".$file;
                }elseif($type == "other" && is_file(SYSBASE."medias/".MODULE."/other/".$id_file."/".$file))
                    $filepath = SYSBASE."medias/".MODULE."/other/".$id_file."/".$file;
                if(isset($filepath)){
                    $mime = getFileMimeType($filepath);
                    if(strstr($_SERVER["HTTP_USER_AGENT"], "MSIE") == false){
                        header("Content-disposition: attachment; filename=".$file);
                        header("Content-Type: ".$mime);
                        header("Content-Transfer-Encoding: ".$mime."\n");
                        header("Content-Length: ".filesize($filepath));
                        header("Pragma: no-cache");
                        header("Cache-Control: must-revalidate, post-check=0, pre-check=0, public");
                        header("Expires: 0");
                    }
                    readfile($filepath);
                }
            }
        }
    }
}
$csrf_token = get_token("form"); ?>
<!DOCTYPE html>
<head>
    <?php include(SYSBASE."admin/includes/inc_header_form.php"); ?>
</head>
<body>
    <div id="overlay"><div id="loading"></div></div>
    <div id="wrapper">
        <?php
        include(SYSBASE."admin/includes/inc_top.php");
        
        if(!in_array("no_access", $permissions)){
            //include(SYSBASE."admin/includes/inc_library.php");
            ?>
            <form id="form" class="form-horizontal" role="form" action="index.php?view=form" method="post" enctype="multipart/form-data">
                <div id="page-wrapper">
                    <div class="page-header">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-6 col-md-6 col-sm-8 clearfix">
                                    <h1 class="pull-left"><i class="fa fa-<?php echo ICON; ?>"></i> <?php echo TITLE_ELEMENT; ?></h1>
                                    <div class="pull-left text-right">
                                        &nbsp;&nbsp;
                                        <?php
                                        if(in_array("add", $permissions) || in_array("all", $permissions)){ ?>
                                            <a href="index.php?view=form&id=0">
                                                <button class="btn btn-primary mt15" type="button"><i class="fa fa-plus-circle"></i><span class="hidden-sm hidden-xs"> <?php echo $texts['NEW']; ?></span></button>
                                            </a>
                                            <?php
                                        } ?>
                                        <a href="index.php?view=list">
                                            <button class="btn btn-default mt15" type="button"><i class="fa fa-reply"></i><span class="hidden-sm hidden-xs"> <?php echo $texts['BACK_TO_LIST']; ?></span></button>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-md-6 col-sm-4 clearfix pb15 text-right">
                                    <?php
                                    if($db !== false){
                                        if($id > 0){
                                            if(in_array("edit", $permissions) || in_array("all", $permissions)){ ?>
                                                <button type="submit" name="edit" class="btn btn-default mt15"><i class="fa fa-floppy-o"></i><span class="hidden-sm hidden-xs"> <?php echo $texts['SAVE']; ?></span></button>
                                                <button type="submit" name="edit_back" class="btn btn-success mt15"><i class="fa fa-floppy-o"></i><span class="hidden-sm hidden-xs"> <?php echo $texts['SAVE_EXIT']; ?></span></button>
                                                <?php
                                            }
                                            if(in_array("add", $permissions) || in_array("all", $permissions)){ ?>
                                                <button type="submit" name="add" class="btn btn-default mt15"><i class="fa fa-files-o"></i><span class="hidden-sm hidden-xs"> <?php echo $texts['REPLICATE']; ?></span></button>
                                                <?php
                                            }
                                        }else{
                                            if(in_array("add", $permissions) || in_array("all", $permissions)){ ?>
                                                <button type="submit" name="add" class="btn btn-default mt15"><i class="fa fa-plus-circle"></i><span class="hidden-sm hidden-xs"> <?php echo $texts['SAVE']; ?></span></button>
                                                <button type="submit" name="add_back" class="btn btn-success mt15"><i class="fa fa-plus-circle"></i><span class="hidden-sm hidden-xs"> <?php echo $texts['SAVE_EXIT']; ?></span></button>
                                                <?php
                                            }
                                        }
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="alert-container">
                        <div class="alert alert-success alert-dismissable"></div>
                        <div class="alert alert-warning alert-dismissable"></div>
                        <div class="alert alert-danger alert-dismissable"></div>
                    </div>
                    <?php
                    if($db !== false){ ?>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>"/>
                        <div class="panel panel-default">
                            <ul class="nav nav-tabs pt5">
                                <?php
                                for($i = 0; $i < count($arrItem); $i++){
                                    $tabId = $arrItem[$i]['id'];
                                    $tabName = $arrItem[$i]['name']; ?>
                                    
                                    <li<?php if($activeItem == $tabId) echo " class=\"active\""; ?>>
                                        <a data-toggle="tab" href="#tab_<?php echo $tabId; ?>">
                                            <?php
                                            $result_img_item = $db->query("SELECT id, file FROM pm_charter_item_file WHERE type = 'image' AND id_item = ".$tabId." AND file != '' ORDER BY rank LIMIT 1");
                                            if($result_img_item !== false && $db->last_row_count() == 1){
                                                $row_img_item = $result_img_item->fetch();
                                                $id_img_item = $row_img_item[0];
                                                $file_img_item = $row_img_item[1];
                                                    
                                                if(is_file(SYSBASE."medias/charter_item/big/".$id_img_item."/".$file_img_item))
                                                    echo "<img src=\"".DOCBASE."medias/charter_item/big/".$id_img_item."/".$file_img_item."\" alt=\"\" border=\"0\"> ";
                                            }
                                            echo $tabName;
                                            ?>
                                        </a>
                                    </li>
                                    <?php
                                } ?>
                            </ul>
                            <div class="panel-body">
                                <div class="tab-content">
                                    <?php
                                    for($i = 0; $i < count($arrItem); $i++){
                                        
                                        $tabId = $arrItem[$i]['id'];
                                    ?>
                                        
                                        <div id="tab_<?php echo $tabId; ?>" class="tab-pane fade <?php if($activeItem == $tabId) echo " in active"; ?>">
                                        
                                            <?php
                                            displayFieldsForTab($fields[MODULE]["fields"], $tabId);
                                            
                                            if($tabId == 1){
                                            	
                                                if($_SESSION['user']['type'] == "administrator" && db_column_exists($db, "pm_".MODULE, "id_user")){ ?>
                                                    <div class="row mb10">
                                                        <div class="col-lg-8">
                                                            <div class="row">
                                                                <label class="col-lg-3 control-label"><?php echo $texts['USER']; ?></label>
                                                                <div class="col-lg-9">
                                                                    <div class=" form-inline">
                                                                        <select name="id_user" class="form-control">
                                                                            <?php
                                                                            $result_user = $db->query("SELECT * FROM pm_user ORDER BY login");
                                                                            if($result_user !== false){
                                                                                foreach($result_user as $user){ ?>
                                                                                    <option value="<?php echo $user['id']; ?>"<?php if($user['id'] == $id_user) echo " selected=\"selected\""; ?>>
                                                                                        <?php echo $user['login']; ?>
                                                                                    </option>
                                                                                    <?php
                                                                                }
                                                                            } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            
                                        </div>
                                        <?php
                                    }
                                    if(isset($result_lang)) $result_lang->closeCursor(); ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    } ?>
                </div>
            </form>
            <?php
        }else echo "<p>".$texts['ACCESS_DENIED']."</p>"; ?>
    </div>
</body>
</html>
<?php
if($_SESSION['msg_error'] == "") recursive_rmdir(SYSBASE."medias/".MODULE."/tmp/".$_SESSION['token']);
$_SESSION['redirect'] = false;
$_SESSION['msg_error'] = "";
$_SESSION['msg_success'] = "";
$_SESSION['msg_notice'] = ""; ?>

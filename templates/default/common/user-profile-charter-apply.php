<?php
// 前台
require(SYSBASE."common/front.php");
require(SYSBASE."templates/default/common/charter_actions.php");

// 用户ID
$userId = $_SESSION['user']['id'];

//
$chartUserId = 0;
// 车主情报
$arrCharterUser = array();
$result_user = $db->query("SELECT * FROM pm_charter_user WHERE user_id = ".$db->quote($userId));
if($result_user !== false && $db->last_row_count() == 1){
	$arrCharterUser = $result_user->fetch();
	$chartUserId = $arrCharterUser["id"];
}

$action = $hotelApp->query("action", "");
if ($action == "delete_file") {
	$fileId = $hotelApp->query("file", "");
	delete_charter_file($db, $fileId);
}

$query_file = "SELECT * FROM pm_charter_user_file WHERE user_id = ".$db->quote($userId);
$query_file .= " ORDER BY type asc, id asc ";
$result_file = $db->query($query_file);

//
$arrResultFile = array();
$arrResultFile[1] = array();
$arrResultFile[2] = array();
$arrResultFile[3] = array();
if ($result_file != null && count($result_file) > 0) {
	foreach ($result_file as $file_row) {
		$type = $file_row["type"];
		if (!array_key_exists($type, $arrResultFile)) {
			$arrResultFile[$type] = array();
		}
		$arrResultFile[$type][] = $file_row;
	}
}

// 错误提示消息
$msg_error = "";
$arrMsg = array();
// 是否是POST请求
if ($hotelApp->isPOST()) {
	//
	$arrMsg = $hotelApp->checkCharterUserForm();
	if ($arrMsg != null && count($arrMsg) > 0) {
		$msg_error = implode("<br/>", $arrMsg);
		$arrCharterUser = $_POST;
	}
	
	if (empty($msg_error)) {
		$add_date = time();
		$edit_date = time();
		//
		$arrData = array();
		$arrData['id'] = $chartUserId;
		$arrData['user_id'] = $userId;
		$arrData['user_name'] = $hotelApp->query("user_name");
		$arrData['drive_year'] = $hotelApp->query("drive_year");
		$arrData['mobile'] = $hotelApp->query("mobile");
		$arrData['alipay'] = $hotelApp->query("alipay");
		$arrData['identity'] = $hotelApp->query("identity");
		$arrData['self_comment'] = $hotelApp->query("self_comment");
		$arrData['friend_comment'] = $hotelApp->query("friend_comment");
		$arrData['why_comment'] = $hotelApp->query("why_comment");
		$arrData['service_comment'] = $hotelApp->query("service_comment");
		$arrData['edit_date'] = $edit_date;
		if ($chartUserId > 0) {
			$result_update = db_prepareUpdate($db, "pm_charter_user", $arrData);
			if($result_update->execute() !== false) {
				//$msg_error = $texts['UPDATE_SUCCESS'];
				$dir = SYSBASE."medias/charter_user/tmp/".$_SESSION['token']."/".$userId;
				// 文件上传
				upload_charter_files($db, $userId, $dir, $_SESSION['token']);
			} else {
				$msg_error = $texts['UPDATE_ERROR'];
			}
		} else {
			$arrData['add_date'] = $add_date;
			$result_insert = db_prepareInsert($db, "pm_charter_user", $arrData);
			if($result_insert->execute() !== false) {
				$dir = SYSBASE."medias/charter_user/tmp/".$_SESSION['token']."/".$userId;
				// 文件上传
				upload_charter_files($db, $userId, $dir, $_SESSION['token']);
			} else {
				$msg_error = $texts['UPDATE_ERROR'];
			}
		}
		
		$arrCharterUser = $_POST;
	}
}

// 上传图片
if(!isset($_SESSION['uniqid'])) $_SESSION['uniqid'] = uniqid();
if(!isset($_SESSION['timestamp'])) $_SESSION['timestamp'] = time();
if(!isset($_SESSION['token'])) $_SESSION['token'] = md5("sessid_".$_SESSION['uniqid'].$_SESSION['timestamp']);
$allowable_file_exts = array(
	"jpg" => "img.png",
	"jpeg" => "img.png",
	"png" => "img.png",
	"gif" => "img.png"
);
/////////////////////////////////////////////////////////////////
function checkHasError($arrmsg, $key) {
	if (array_key_exists($key, $arrmsg)) {
		return " has-error ";
	} else {
		return "";
	}
}

function echoInfo($arr, $key){
	if (isset($arr[$key])) {
		return $arr[$key];
	} else {
		return "";
	}
}

//////////////////////////////////////////////////////////////////

?>

<div class="row">
	<div class='lead'>
		<i class='fa fa-car'></i>
		美溪车友申请
	</div>
	<small class='muted'>非常感谢您的信任加入美溪车友</small>
</div>

<?php 
	if (!empty($msg_error)) {
?>
		<div class="alert alert-danger"><?php echo $msg_error;?></div>
<?php 
	}
?>
            
<div class="row">
	<form method="post" action="?" class="ajax-form form">
	<input type="hidden" name="action" value="save" />
    <div class="form-group form-group-icon-left <?php echo checkHasError($arrMsg, "user_name");?>">
        <label class='control-label'>姓名 *</label>
        <div class='controls'>
        <input name="user_name" class="form-control" value="<?php echo echoInfo($arrCharterUser, "user_name");?>" type="text" />
        </div>
    </div>
    
    <div class="form-group form-group-icon-left <?php echo checkHasError($arrMsg, "drive_year");?>">
        <label class=" control-label">在当地年限 *</label>
        <input name="drive_year" class="form-control" value="<?php echo echoInfo($arrCharterUser, "drive_year");?>" type="text" />
        <div class="help-block" >以年为单位</div>
        
    </div>
    
    <div class="form-group form-group-icon-left <?php echo checkHasError($arrMsg, "mobile");?>">
        <label class='control-label'>手机号码 *</label>
        <input name="mobile" class="form-control" value="<?php echo echoInfo($arrCharterUser, "mobile");?>" type="text" />
    </div>
    
    <div class="form-group form-group-icon-left <?php echo checkHasError($arrMsg, "alipay");?>">
        <label class='control-label'>支付宝账号 </label>
        <input name="alipay" class="form-control" value="<?php echo echoInfo($arrCharterUser, "alipay");?>" type="text" />
        <div class="field-notice">支付宝账号将在结算时使用，请务必填写真实账号</div>
    </div>
    
    <div class="form-group form-group-icon-left <?php echo checkHasError($arrMsg, "identity");?>">
        <label class='control-label'>您在当地的身份 *</label>
        <input name="identity" class="form-control" value="<?php echo echoInfo($arrCharterUser, "identity");?>" type="text" />
    </div>
    <hr>
    
    <div class="form-group form-group-icon-left <?php echo checkHasError($arrMsg, "file_upload_1");?>">
        <label class='control-label'>驾驶证 *</label>
        <?php
        	$maxFile = 1 - count($arrResultFile[1]);
		?>
        <input type="file" name="file_upload_1" id="file_upload_1" class="file_upload" rel="1,<?php echo $maxFile;?>"/>
        <div id="file_upload_1-queue" class="uploadify-queue"></div>
        <div class="uploaded clearfix alert alert-success" id="file_uploaded_1">
        </div>
        
        <ul class="files-list" id="files_list_1">
		<?php
			if (count($arrResultFile[1]) > 0) {
		    foreach($arrResultFile[1] as $row_file){
		    
		        $filename = $row_file['file'];
		        $id_file = $row_file['id'];
		        $type = $row_file['type'];
		        
		        $file_path = "medias/charter_user/".$userId."/".$id_file."/".$filename;
		        $ext = strtolower(ltrim(strrchr($filename, "."), "."));
		        $filesize = "";
		        $dim = @getimagesize(SYSBASE.$file_path);
		        if(is_array($dim)){
		        	$w = $dim[0]."px";
		        	$h = $dim[1];
		        }else{
		        	$w = "100%";
		        	$h = 0;
		        }
		        $weight = filesize(SYSBASE.$file_path);
		        $filesize = $w." x ".$h." | ";
		        
		      ?>
	            <li id="file_<?php echo $id_file; ?>">
	                <div class="prev-file">
	                    <img src="<?php echo DOCBASE.$file_path; ?>" alt="" border="0" style="width:<?php echo $w; ?>">
	                </div>
	                <div class="actions-file">
	                    <a class="tips" href="javascript:if(confirm('您确定要删除吗？')) window.location = '?file=<?php echo $id_file; ?>&csrf_token=<?php echo $csrf_token; ?>&action=delete_file';" >删除</a>
	                </div>
	                <div class="infos-file">
	                    <span class="filename"><?php echo strtrunc(substr($filename, 0, strrpos($filename, ".")), 23, "..", true).".".$ext; ?></span><br>
	                    <span class="filesize"><?php echo $filesize; ?></span>
	                </div>
	            </li>
			<?php
			    } 
			}?>
		</ul>                               
    </div>
    
    <div class="form-group form-group-icon-left <?php echo checkHasError($arrMsg, "file_upload_2");?>">
        <label class='control-label'>护照，中国身份证，居住证，学生证,领队证或者导游证（最多5张）</label>
        <?php
        	$maxFile = 5 - count($arrResultFile[2]);
		?>
        <input type="file" name="file_upload_2" id="file_upload_2" class="file_upload" rel="2,<?php echo $maxFile;?>"/>
        <div id="file_upload_2-queue" class="uploadify-queue"></div>
        <div class="uploaded clearfix alert alert-success" id="file_uploaded_2">
        </div>
        <ul class="files-list" id="files_list_2">
		<?php
			if (count($arrResultFile[2]) > 0) {
		    foreach($arrResultFile[2] as $row_file){
		    
		        $filename = $row_file['file'];
		        $id_file = $row_file['id'];
		        $type = $row_file['type'];
		        
		        $file_path = "medias/charter_user/".$userId."/".$id_file."/".$filename;
		        $ext = strtolower(ltrim(strrchr($filename, "."), "."));
		        $filesize = "";
		        $dim = @getimagesize(SYSBASE.$file_path);
		        if(is_array($dim)){
		        	$w = $dim[0]."px";
		        	$h = $dim[1];
		        }else{
		        	$w = "100%";
		        	$h = 0;
		        }
		        $weight = filesize(SYSBASE.$file_path);
		        $filesize = $w." x ".$h." | ";
		        
		      ?>
	            <li id="file_<?php echo $id_file; ?>">
	                <div class="prev-file">
	                    <img src="<?php echo DOCBASE.$file_path; ?>" alt="" border="0" style="width:<?php echo $w; ?>">
	                </div>
	                <div class="actions-file">
	                    <a class="tips" href="javascript:if(confirm('您确定要删除吗？')) window.location = '?file=<?php echo $id_file; ?>&csrf_token=<?php echo $csrf_token; ?>&action=delete_file';" >删除</a>
	                </div>
	                <div class="infos-file">
	                    <span class="filename"><?php echo strtrunc(substr($filename, 0, strrpos($filename, ".")), 23, "..", true).".".$ext; ?></span><br>
	                    <span class="filesize"><?php echo $filesize; ?></span>
	                </div>
	            </li>
			<?php
			    } 
			}?>
		</ul>  
    </div>
    
    <div class="form-group form-group-icon-left <?php echo checkHasError($arrMsg, "file_upload_3");?>">
        <label class='control-label'>个人照，风景，美食，游客合影 *</label>
        <?php
        	$maxFile = 5 - count($arrResultFile[3]);
		?>
        <input type="file" name="file_upload_3" id="file_upload_3" class="file_upload" rel="3,<?php echo $maxFile;?>"/>
        <div class="field-notice">至少有一张是车前与车合影</div>
        <div id="file_upload_3-queue" class="uploadify-queue"></div>
        <div class="uploaded clearfix alert alert-success" id="file_uploaded_3">
        </div>
        <ul class="files-list" id="files_list_3">
		<?php
			if (count($arrResultFile[3]) > 0) {
		    foreach($arrResultFile[3] as $row_file){
		    
		        $filename = $row_file['file'];
		        $id_file = $row_file['id'];
		        $type = $row_file['type'];
		        
		        $file_path = "medias/charter_user/".$userId."/".$id_file."/".$filename;
		        $ext = strtolower(ltrim(strrchr($filename, "."), "."));
		        $filesize = "";
		        $dim = @getimagesize(SYSBASE.$file_path);
		        if(is_array($dim)){
		        	$w = $dim[0]."px";
		        	$h = $dim[1];
		        }else{
		        	$w = "100%";
		        	$h = 0;
		        }
		        $weight = filesize(SYSBASE.$file_path);
		        $filesize = $w." x ".$h." | ";
		        
		      ?>
	            <li id="file_<?php echo $id_file; ?>">
	                <div class="prev-file">
	                    <img src="<?php echo DOCBASE.$file_path; ?>" alt="" border="0" style="width:<?php echo $w; ?>">
	                </div>
	                <div class="actions-file">
	                    <a class="tips" href="javascript:if(confirm('您确定要删除吗？')) window.location = '?file=<?php echo $id_file; ?>&csrf_token=<?php echo $csrf_token; ?>&action=delete_file';" >删除</a>
	                </div>
	                <div class="infos-file">
	                    <span class="filename"><?php echo strtrunc(substr($filename, 0, strrpos($filename, ".")), 23, "..", true).".".$ext; ?></span><br>
	                    <span class="filesize"><?php echo $filesize; ?></span>
	                </div>
	            </li>
			<?php
			    } 
			}?>
		</ul>
    </div>
    
    <hr>
    <div class="form-group form-group-icon-left <?php echo checkHasError($arrMsg, "self_comment");?>">
        <label class='control-label'>请用几句话形容自己 *</label>
        <textarea name="self_comment" class="form-control"><?php echo echoInfo($arrCharterUser, "self_comment");?></textarea>
    </div>
    
	<div class="form-group form-group-icon-left <?php echo checkHasError($arrMsg, "friend_comment");?>">
        <label class='control-label'>朋友如何评价您 *</label>
        <textarea name="friend_comment" class="form-control"><?php echo echoInfo($arrCharterUser, "friend_comment");?></textarea>
    </div>
    
    <div class="form-group form-group-icon-left <?php echo checkHasError($arrMsg, "why_comment");?>">
        <label class='control-label'>您为什么来到这座城市 </label>
        <textarea name="why_comment" class="form-control"><?php echo echoInfo($arrCharterUser, "why_comment");?></textarea>
    </div>
    
    <div class="form-group form-group-icon-left <?php echo checkHasError($arrMsg, "service_comment");?>">
        <label class='control-label'>您可以提供什么样的特色服务？报价如何？ </label>
        <textarea name="service_comment" class="form-control"><?php echo echoInfo($arrCharterUser, "service_comment");?></textarea>
    </div>
    
    <hr>
    <input type="submit" class="btn btn-primary" value="保存">
	</form>
</div>

<script src="<?php echo DOCBASE; ?>admin/includes/uploadifive/jquery.uploadifive.js"></script>   

<script>

        
        $(function() {
            
            $('.file_upload').each(function(){
                
                var id = $(this).attr('id');
                var rel = $(this).attr('rel').split(',');
                var fileType = rel[0];
                var max_file = rel[1];
                
                if(max_file > 10) max_file = 10;
                
                var container = $('#file_uploaded_'+fileType);
                if($('.prev-file', container).size() > 0) container.slideDown();
                
                $('#'+id).uploadifive({
                    'formData'         : {
                        'timestamp' : '<?php echo $_SESSION['timestamp'];?>',
                        'uniqid' : '<?php echo $_SESSION['uniqid'];?>',
                        'token' : '<?php echo $_SESSION['token'];?>',
                        'dir' : 'charter_user',
                        'root_bo' : '<?php echo DOCBASE; ?>admin/',
                        'exts' : '<?php echo serialize(array_keys($allowable_file_exts)); ?>',
                        'fileType' : fileType
                    },
                    'buttonText'     : '<i class="fa fa-folder-open"></i> 选择上传图片',
                    'fileTypeDesc'     : 'Files',
                    'fileTypeExts'     : '<?php foreach(array_keys($allowable_file_exts) as $file_ext) echo "*.".$file_ext.";*.".mb_strtoupper($file_ext, "UTF-8").";"; ?>',
                    'multi'            : (max_file > 1),
                    'queueSizeLimit': max_file,
                    'uploadLimit'     : max_file,
                    'queueID'        : 'file_upload_'+fileType+'-queue',
                    'uploadScript'     : '<?php echo DOCBASE; ?>admin/includes/uploadifive/uploader/charteruploadifive.php',
                    'onUploadComplete' : function(file, data, response){
                        data = data.split('|');
                        
                        if($('.prev-file', container).size() == 0) container.slideDown();
                            
                        var filename = data[0].substring(data[0].lastIndexOf('/')+1);
                        var ext = filename.substring(filename.lastIndexOf('.')+1).toLowerCase();
                        
                        if((data[2] == 0 && data[3] == 0) || ext == 'swf'){
                        
                            var icon_file = '';
                            
                            switch(ext){
                                <?php
                                foreach($allowable_file_exts as $file_ext => $icon_file)
                                    echo "case '".$file_ext."' : icon_file = '".$icon_file."'; break;\n"; ?>
                            }
                            
                            container.append('<div class="prev-file"><img src="<?php echo DOCBASE; ?>common/images/'+icon_file+'" alt="" border="0">'+filename.substring(0, filename.lastIndexOf('.')).substring(0, 15)+'...'+ext+'<br>'+data[1]+'</div>');
                        
                        }else
                            container.append('<div class="prev-file"><img src="'+data[0]+'" alt="" border="0">'+filename.substring(0, filename.lastIndexOf('.')).substring(0, 15)+'...'+ext+'<br>'+data[1]+' | '+data[2]+' x '+data[3]+'</div>');
                        
                        if($('.prev-file', container).size() == 1) container.slideDown();
                    }
                });
            });
        });
    </script>

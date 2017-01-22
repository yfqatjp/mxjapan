<?php

// 驾驶证的尺寸
define("CHARTER_1_W", 400);
define("CHARTER_1_H", 400);

define("CHARTER_2_W", 400);
define("CHARTER_2_H", 400);

// 个人风景
define("CHARTER_3_W", 600);
define("CHARTER_3_H", 600);

/***********************************************************************
 * browse_files() browses the medias directory and get all files
 *
 * @param $dir      directory containing files
 * @param $files    file data array
 *
 * @return array
 *
 */
function browse_charter_files($dir, $files = array(), $beforeDir = "3")
{
	if(is_dir($dir)) $rep = opendir($dir) or die("Error directory opening : ".$dir);

	while($entry = @readdir($rep)){
		if(is_dir($dir."/".$entry) && $entry != "." && $entry != "..") {

			$files = browse_charter_files($dir."/".$entry, $files, $entry);
		} else{
				if(is_file($dir."/".$entry)){

					$ext = substr($entry, strrpos($entry, ".")+1);
					$weight = fileSizeConvert(filesize($dir."/".$entry));
					$dim = @getimagesize($dir."/".$entry);

					if((is_array($dim) && $dim[0] > 0 && $dim[1] > 0) || stripos(getFileMimeType($dir."/".$entry), "image") !== false){
						$w = $dim[0];
						$h = $dim[1];
					}else{
						$w = "";
						$h = "";
					}
					$filename = str_replace(".".$ext, "", substr($dir."/".$entry, strrpos($dir."/".$entry, "/")+1));

					$files[] = array($dir."/".$entry, $filename, $ext, $weight, $w, $h, $beforeDir);
				}
			}
	}
	return $files;
}

/***********************************************************************
 * upload_files() copies the files uploaded and inserts the recordings into the database
 *
 * @param $db       database connection ressource
 * @param $id       ID of the item
 * @param $id_lang  ID of the current language
 * @param $dir      directory containing files
 *
 * @return void
 *
 */
function upload_charter_files($db, $user_id, $dir, $token)
{
	$browsed_files = browse_charter_files($dir);
	foreach($browsed_files as $file){
		$data = array();
		$type = $file[6];
	
	
		$data['id'] = null;
		$data['file'] = $file[1].".".$file[2];
		$data['user_id'] = $user_id;
		$data['type'] = $type;

		$result = db_prepareInsert($db, "pm_charter_user_file", $data);

		if($result->execute() !== false){

			$error = true;
			$id_file = $db->lastInsertId();
			$fileDir = SYSBASE."medias/charter_user/".$user_id;
			if(!is_dir($fileDir)) {
				mkdir($fileDir, 0777);
				chmod($fileDir, 0777);
			}
			
			$fileDir = SYSBASE."medias/charter_user/".$user_id."/".$id_file;
			if(!is_dir($fileDir)) {
				mkdir($fileDir, 0777);
				chmod($fileDir, 0777);
			}
			
			if ($type == "1") {
				// 上传驾驶证
				if(img_resize($file[0], $fileDir, CHARTER_1_W, CHARTER_1_H)) {
					
					$error = false;
				}
			} else if ($type == "2") {
				// 上传驾驶证
				if(img_resize($file[0], $fileDir, CHARTER_2_W, CHARTER_2_H)) {
					
					$error = false;
				}
			} else {
				// 其他
				if(img_resize($file[0], $fileDir, CHARTER_3_W, CHARTER_3_H)) {
				
					$error = false;
				}
			}
			
			// 删除上传的图片
			if(is_file($file[0])) unlink($file[0]);

			
			
			if($error === true) {
				$db->query("DELETE FROM pm_charter_user_file WHERE id = ".$id_file);
			}
		}
	}
	
	// 删除掉空的目录
	@full_rmdir(SYSBASE."medias/charter_user/tmp/".$token);
}


/***********************************************************************
 * delete_file() deletes a media from the database and handles the deletion of the concerned file
 *
 * @param $db       database connection ressource
 * @param $id_file  ID of the media
 *
 * @return void
 *
 */
function delete_charter_file($db, $id_file)
{
	$result = $db->query("SELECT * FROM pm_charter_user_file WHERE id = ".$id_file);
	if($result !== false && $db->last_row_count() > 0){

		$row = $result->fetch();

		$filename = $row['file'];
		$user_id = $row['user_id'];
		$type_item = $row['type'];
		$filePath = SYSBASE."medias/charter_user/".$user_id."/".$id_file."/".$filename;
		if(is_file($filePath)) {
			unlink($filePath);
		}

		if($db->query("DELETE FROM pm_charter_user_file WHERE id = ".$id_file) !== false) {
			return true;
		}
	}
	return false;
}


function full_rmdir( $dir )
{
	if ( !is_writable( $dir ) )
	{
		if ( !@chmod( $dir, 0777 ) )
		{
			return FALSE;
		}
	}
	 
	$d = dir( $dir );
	while ( FALSE !== ( $entry = $d->read() ) )
	{
		if ( $entry == '.' || $entry == '..' )
		{
			continue;
		}
		$entry = $dir . '/' . $entry;
		if ( is_dir( $entry ) )
		{
			if ( !full_rmdir( $entry ) )
			{
				return FALSE;
			}
			continue;
		}
		if ( !@unlink( $entry ) )
		{
			$d->close();
			return FALSE;
		}
	}
	 
	$d->close();
	 
	rmdir( $dir );
	 
	return TRUE;
}

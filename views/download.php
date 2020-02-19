<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'].'/init.php';

$oFileVw = new \classes\General\ObjectFactory('fileView');
$oClient = new \classes\Client\Client();

$path   = REAL_FILE_PATH;
$dir    = FILE_PATH;
$map    = $_REQUEST['fgid'];
$fileID = $_REQUEST['fid'];

$downloadValid = false;

$file_check = $oFileVw->selectSingleObject(array('fileID' => $fileID));
if($file_check->useLogin == 1){
	$loginCheck = $oClient->getClientInfo($_SESSION['login']['loginIdentifier']);
	if(isset($loginCheck->clientID) && $loginCheck->clientID!='') {

        $custom_query = 'AND (clientGroupID = '.$_SESSION['login']['clientGroupID'].' OR clientGroupID IS NULL)';
        $files = $oFileVw->selectSingleObject( array('fileID' => $fileID, 'useLogin' => 1), '', 'and',  $custom_query);
		if($files->fileID){
			$downloadValid = true;
			$file_name_download = $files->name;
		}else{
			echo 'ERR_#25';
		}
	}else{
		echo 'ERR_#28';
	}
}elseif($file_check->fileID){
	$downloadValid = true;
	$file_name_download = $file_check->name;
}else{
	echo 'ERR_#34';
}

if($downloadValid==true){
	$globFile    = glob($path.$map.'/'.$fileID.'_*');
	$tmp	     = $globFile[0];
	$tmpfileName = strrchr($tmp, '/');
	$fileName 	 = stristr($tmpfileName, '_');
	
	$chmodlink = $path.$map.$tmpfileName;
	$file 	   = $dir.$map.$tmpfileName;

	chmod($chmodlink, 0755);
	
	//**header
	$path_parts = pathinfo($file, PATHINFO_EXTENSION);
	$download_file = true;
	
	switch ($path_parts) {
		case "pdf": 	$ctype="application/pdf"; break;
		case "nwc": 	$ctype="application/x-nwc"; break;
		case "zip": 	$ctype="application/zip"; break;
		case "rar": 	$ctype="application/rar"; break;
		case "doc":
		case "docx": 	$ctype="application/msword"; break;
		case "dwg": 	$ctype="application/dwg"; break;
		case "dxf": 	$ctype="application/dxf"; break;
		case "xls":
		case "xlsx": 	$ctype="application/vnd.ms-excel"; break;
		case "ppt": 	$ctype="application/vnd.ms-powerpoint"; break;
		case "gif": 	$ctype="image/gif"; break;
		case "png": 	$ctype="image/png"; break;
		case "jpe": 
		case "jpeg":
		case "jpg": 	$ctype="image/jpg"; break;
		case "mp4": 	$ctype="video/mp4"; break;
		case "mov": 	$ctype="video/mov"; break;
		default: die();
	}
	
	if (!file_exists($chmodlink)) {
		die("(1)Bestand niet gevonden: ".$chmodlink);
	}
	
	header("Expires: 0");
	header("Cache-Control: post-check=0, pre-check=0");
	header("Content-Description: File Transfer");
	header("Content-Type: $ctype");
	if($download_file==true){
		header('Content-Disposition: attachment; filename="'.$file_name_download.'"');
	}else{
		header('Content-Disposition: inline; filename="'.$file_name_download.'"');
	}
	
	header("Content-Length: ".filesize($chmodlink));
	//set_time_limit(0);
	@readfile($file) or die("(2)Bestand niet gevonden: ".$file);
}
?>
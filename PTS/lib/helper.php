<?php
/* -------------------------------------------------------------------------------------- */
function LogIn($username,$password){
	include_once(__DIR__ . '/mysql.php');
	//Get data from users table
	$sql = "SELECT password FROM user WHERE user_name='" . $username . "'";
	$row = GetOneRowEx($sql);	
	if($password==$row['password'])
		return true;
	else	
		return false;
}
/* -------------------------------------------------------------------------------------- */
function DeleteImage($path,$file){
	try {
		if($file!='no_image.png')
			unlink($path . $file);
	}catch(Exception $e){}
}
/* -------------------------------------------------------------------------------------- */
function UploadImage($no_image, $path, $id,$width=570,$height=1024){
	set_time_limit(300);
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$temp = explode(".", $_FILES["file"]["name"]);
	$extension = strtolower(end($temp));
	
	if ((($_FILES["file"]["type"] == "image/gif")
	|| ($_FILES["file"]["type"] == "image/jpeg")
	|| ($_FILES["file"]["type"] == "image/jpg")
	|| ($_FILES["file"]["type"] == "image/pjpeg")
	|| ($_FILES["file"]["type"] == "image/x-png")
	|| ($_FILES["file"]["type"] == "image/png"))
	&& in_array($extension, $allowedExts))
	{
		if ($_FILES["file"]["error"] > 0){
			//echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
			return $no_image;
		}else{
			$extension =  $id . "." . $extension;
			$path = $path . $extension;
			move_uploaded_file($_FILES["file"]["tmp_name"],$path);
						
			$image = getimagesize($path);
			if($image[0]>$width){//width larger than 520px	
				include("../lib/resize-class.php");
				$resizeObj = new resize($path);
				$resizeObj -> resizeImage($width, $height, 'auto');
				$resizeObj -> saveImage($path, 100);
			}
			
			return $extension;//new file name
		}
	}else{
		//echo "Invalid file";
		return $no_image;
	}
}
/* -------------------------------------------------------------------------------------- */
function GetDateFormSring($str_date){
	return date('Y-m-d H:i:s', strtotime($str_date));
}
/* -------------------------------------------------------------------------------------- */
function FormatDateTime($date){
	$d = date_create($date);
	return date_format($d, 'Y F d \a\t H:i');
}
/* -------------------------------------------------------------------------------------- */
function FormatDate($date){
	$d = date_create($date);
	//return date_format($d, 'l jS F Y \a\t g:ia');
	return date_format($d, 'Y F d');
}
/* -------------------------------------------------------------------------------------- */
function FormatTime($time){
	return 	time_format("H:i:s",$time);
}
/* -------------------------------------------------------------------------------------- */
function IsRecordExist($sql,$field,$con){
	$row = mysql_fetch_array(ExecuteSQL($sql));
	if($row['COUNT(OrderID)']==0)
		return false;
	else
		return true;
}
/* -------------------------------------------------------------------------------------- */
function Randomize(){
	$seed = floor(time());
	srand($seed);
}
/* -------------------------------------------------------------------------------------- */
?>
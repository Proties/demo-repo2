<?php 
try{
	if(isset($_FILES['video'])){
	$filename=$_FILES['video']['name'];
	$filesize=$_FILES['video']['size'];
	$tmpname=$_FILES['video']['tmp_name'];
	$filetype=$_FILES['video']['type'];
	$uploadDir='./videos/';
	$newfile=$uploadDir.$filename;
	if(!move_uploaded_file($tmpname, $newfile)){
		throw new Exception('did not upload');
	}

}catch(Exception $err){
	echo $err->getMessage();
}


?>
<?php
if($_SERVER['REQUEST_METHOD']=='GET'){
    include_once('front/addP.html');
    return;
}
include_once('php/database.php');
include_once('php/post.php');
include_once('php/categories.php');
try{
  $post=new Post();
  if($post->validate_image($_POST['image'])==true){

  }
  if($post->validate_title($_POST['title'])==true){

  }
  if($post->validate_description($_POST['description'])==true){

  }
}catch(Execption $err){
  echo $err->getMessage();
}
$p->set_title($_POST['title']);
$p->set_description($_POST['description']);
$target_dir='userProfiles/';
$target_file=$target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk=1;
$imageFileType=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if(isset($_POST["submit"])){
    $check=getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }
  
  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }
  
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }
  
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo $target_file;
        $p->set_image(file_get_contents($target_file));
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }


$p->write_post();
?>
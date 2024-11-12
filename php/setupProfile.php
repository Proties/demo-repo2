<?php 
session_start();
use Insta\Databases\Database;
use Insta\Databases\User\UserDB;
use Insta\Users\Users;
use Insta\Users\UserFile;

use Insta\Template\Template;
use Insta\Database\Template\TemplateDB;

use Insta\Images\Image;
use Insta\Databases\Images\ImageDB;
$user=new Users();
$image=new Image();

// setcookie('setUpProfile','', time() - (30 * 20), '/');
$bigData=[];
$errors=[];

if(isset($_SESSION['email'])){
	$user->set_name($_SESSION['firstName']);
	$user->set_email($_SESSION['email']);
	$user->set_password($_SESSION['password']);
	$user->set_lastName($_SESSION['lastName']);
}
else{
	header('Location: /');
}
$userDB=new UserDB($user);
if($_SERVER['REQUEST_METHOD']=='POST'){

    $db=Database::get_connection();
    try{
    	$db->beginTransaction();

    	if(empty($_POST['profileName']) OR $user->validate_username($_POST['profileName'])==false){
    		$errors[]['errProfilUsername']='username not valid';
    	}
  
    	if(empty($_POST['gender']) ){
    		$errors[]['errProfileGender']='gender not valid';
    	}
    	if(empty($_POST['occupation'])){
    		$errors[]['errProfileOccupation']='occupation is required';
    	}
    	if(empty($_POST['biography'])){
    		$errors[]['errProfileBio']='bio not valid';
    	}
    	if($userDB->search_username_in_db($_POST['profileName'])!==false){
       		$errors[]['errProfilUsername']='Username already exists';
       		throw new Exception('username taken');
    	}

    	if(count($errors)>1){
    		throw new Exception('could not create user');
    	}
    	$username=$_POST['profileName'];
    	$fullname=$_SESSION['firstName'].' '.$_SESSION['lastName'];
    	$gender=$_POST['gender'];
    	$occupation=$_POST['occupation'];
    	$bio=$_POST['biography'];

    	$user->set_username($username);
    	$user->set_gender($gender);
    	$user->set_occupation($occupation);
    	$user->set_shortBio($bio);
    	$user->set_fullName($fullname);
		$userDB->write_user();

		if(isset($_FILES['profileImage'])){
			$id=$image->make_filename();
			$image->set_postLinkID($id);
			$image->set_imageName('profileImage');
			$image->make_fileExtension();
			
			$file=$id.$image->get_fileExtension();
			$image->set_filename($file);
			$image->set_userID($userDB->user->get_id());
			$image->set_filepath($user->userFolder->get_dir());
			
			$imageDB=new ImageDB($image);
			$imageDB->set_db($db);
        	$imageDB->write_image();
	     	$imageDB->write_image_profile_picture();
	     
	     	$image->load_image();
        }

		if($userDB->user->get_id()>0){
        $_SESSION['userID']=$userDB->user->get_id();
        

        //create an entry at user template if successfull
        // set status to not active to all paid template
        // set status active for basic template
        // $template=new Template();
        // $templateDB=new TemplateDB($template);
        // $templateDB->addTemplateForNewUser();
        $status=$user->userFolder->create_user_folder($user->get_username());
		$bigData['status']='success';
		$bigData['message']='everything all good';
		$bigData['data']=['username'=>$user->get_username(),'shortBio'=>$user->get_shortBio(),'fullname'=>$user->get_fullName()];
		$_SESSION['userID']=$user->get_id();
		$_SESSION['username']=$user->get_username();
      	// echo json_encode($bigData);
      	$store['userID']=$user->get_id();
      	$store['username']=$user->get_username();
      	$store['shortBio']=$user->get_shortBio();
      	$store['profilePicture']=$user->get_profilePicture();
      	$db->commit();
      	setcookie('user',json_encode($store), time() + (38900 * 600), '/');
      	$bigData['status']='success';
      	setcookie('setupProfileStatus',json_encode($bigData), time() + (31 * 6), '/');
      	header('Location: /');
		return;
      
    }
    else{

    	throw new Exception('user failed to be created');
    }
	}catch(Exception $err){
		$db->rollBack();
		$bigData['errors']=$errors;
		$bigData['status']='failed';
		$bigData['message']=$err->getMessage();
		setcookie('setupProfileStatus',json_encode($bigData), time() + (31 * 6), '/');
		header('Location: /');
		return;
		
	}

	
}




?>
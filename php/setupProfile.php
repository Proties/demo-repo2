<?php 
session_start();
use Insta\Databases\Database;
use Insta\Databases\User\UserDB;
use Insta\Users\Users;
use Insta\Users\UserFile;

use Insta\Template\Template;
use Insta\Database\Template\TemplateDB;

$user=new Users();


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
	$data=file_get_contents('php://input');
    $data_f=json_decode($data,true);
    try{

    	if(empty($data_f['username']) OR $user->validate_username($data_f['username'])==false){
    		$errors[]['errProfileUserName']='username not valid';
    	}
    	if(empty($data_f['fullname']) OR $user->validate_fullName($data_f['fullname'])==false){
    		$errors[]['errProfileFullName']='profile full name not valid';
    	}
    	if(empty($data_f['gender']) OR $user->validate_gender($data_f['gender'])==false){
    		$errors[]['errProfileGender']='gender not valid';
    	}
    	if(empty($data_f['occupation']) OR $user->validate_occupation($data_f['occupation'])==false){
    		$errors[]['errProfileOccupation']='occupation is required';
    	}
    	if(empty($data_f['bio']) OR $user->validate_bio($data_f['bio'])==false){
    		$errors[]['errProfileBio']='bio not valid';
    	}
    	if($userDB->search_username_in_db($data_f['username'])!==false){
       		$errors[]['errProfilUsername']='Username already exists';
       		throw new Exception('username taken');
    	}

    	if(count($errors)>1){
    		throw new Exception('could not create user');
    	}
    	$username=$data_f['username'];
    	$fullname=$data_f['fullname'];
    	$gender=$data_f['gender'];
    	$occupation=$data_f['occupation'];
    	$bio=$data_f['bio'];

    	$user->set_username($username);
    	$user->set_gender($gender);
    	$user->set_occupation($occupation);
    	$user->set_shortBio($bio);
    	$user->set_fullName($fullname);
		$userDB->write_user();

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
      
    }
    else{

    	throw new Exception('user failed to be created');
    }
	}catch(Exception $err){
		$bigData['errors']=$errors;
		$bigData['status']='failed';
		$bigData['message']=$err->getMessage();
		
		// echo json_encode($bigData);
		
	}
	setcookie('setUpProfile',json_encode($bigData), time() + (86 * 1), '/');

}




?>
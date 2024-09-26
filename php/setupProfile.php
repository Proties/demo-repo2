<?php 
session_start();
use Insta\Databases\Database;
use Insta\Databases\User\UserDB;
use Insta\Users\Users;
use Insta\Users\UserFile;

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
    	$username=$data_f['username'];
    	$fullname=$data_f['fullname'];
    	$gender=$data_f['gender'];
    	$occupation=$data_f['occupation'];
    	$bio=$data_f['bio'];


    	$user->set_username($username);
    	$user->set_gender($gender);
    	$user->set_occupation($occupation);
    	$user->set_bio($bio);
    	$user->set_fullName($fullname);

    	if($user->validate_username($user->get_username())==false){
    		$errors[]['errProfileUserName']='username not valid';
    	}
    	if($user->validate_fullName($user->get_fullName())==false){
    		$errors[]['errProfileFullName']='profile full name not valid';
    	}
    	if($user->validate_gender($user->get_gender())==false){
    		$errors[]['errProfileGender']='gender not valid';
    	}
    	if($user->validate_occupation($user->get_occupation())==false){
    		$errors[]['errProfileOccupation']='occupation is required';
    	}
    	if($user->validate_bio($user->get_bio())==false){
    		$errors[]['errProfileBio']='bio not valid';
    	}
    	if($userDB->search_username_in_db($user->get_username())!==false){
       		$errors[]['errProfilUsername']='Username already exists';
       		throw new Exception('username taken');
    	}
    	if(count($errors)>1){
    		throw new Exception('could not create user');
    	}
		$userDB->write_user();
		if($userDB->user->get_id()>0){
        $_SESSION['userID']=$userDB->user->get_id();
     
        $item=array('status'=>'success');
        
        $status=$user->userFolder->create_user_folder($user->get_username());
		$bigData['status']='success';
		$bigData['message']='everything all good';
		$allData=['status'=>'success','username'=>$user->get_username(),'bio'=>$user->get_bio(),'fullname'=>$user->get_fullName()];
		setcookie('setUpProfile',json_encode($allData), time() + (86400 * 1), '/'); 
		setcookie('user',json_encode($allData), time() + (86400 * 1), '/'); 
      	echo json_encode($bigData);
      	return;
    }
     throw new Exception('user failed to be created');
	}catch(Exception $err){
		$bigData['errors']=$errors;
		$bigData['status']='failed';
		$bigData['message']=$err->getMessage();
		setcookie('setUpProfile',json_encode($allData), time() - (86400 * 1), '/');
		echo json_encode($bigData);
		return;
	}

}




?>
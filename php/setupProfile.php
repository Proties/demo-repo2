<?php 
session_start();
use Insta\Databases\Database;
use Insta\Databases\User\UserDB;
use Insta\Users\Users;
use Insta\Users\UserFile;

$user=new Users();


$data=[];
$errors=[
	'errProfileName'=>'',
	'errProfileUserName'=>'',
	'errProfileGender'=>'',
	'errProfileOccupation'=>'',
	'errProfileBio'=>''
];

if(isset($_SESSION['email'])){
	$user->set_name($_SESSION['firstName']);
	$user->set_email($_SESSION['email']);
	$user->set_password($_SESSION['password']);
	$user->set_lastName($_SESSION['lastName']);
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

    	if($user->validate_username($user->get_username())==false){
    		$errors['errProfileUserName']='not valid';
    	}
    	if($user->validate_gender($user->get_gender())==false){
    		$errors['errProfileGender']='not valid';
    	}
    	if($user->validate_occupation($user->get_occupation())==false){
    		$errors['errProfileOccupation']='not valid';
    	}
    	if($user->validate_bio($user->get_bio())==false){
    		$errors['errProfileBio']='not valid';
    	}
    	if($UserDB->validate_username_in_database($user->get_username())==true){
    		$errors['errProfileUserName']='not valid';
    	}
		$userDB->write_user();
		if($userDB->user->get_id()>0){
        $_SESSION['userID']=$userDB->user->get_id();
        $_SESSION['email']=$userDB->user->get_email();
        $item=array('status'=>'success');
        
        $status=$user->userFolder->create_user_folder($user->get_username());
		$data['status']='success';
		$data['message']='everything all good';
      	echo json_encode($data);
    }
     throw new Exception('user failed to be created');
       
		
        // echo json_encode($item);
	}catch(Exception $err){
			unset($_SESSION['email']);
			unset($_SESSION['firstName']);
			unset($_SESSION['password']);
			unset($_SESSION['lastName']);
		$data['errors']=$errors;
		$data['status']='failed';
		$data['message']=$err->getMessage();
		echo json_encode($data);
	}

}




?>
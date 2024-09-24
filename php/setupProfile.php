<?php 
session_start();
use Insta\Databases\Database;
use Insta\Databases\User;
use Insta\Users\Users;
use Insta\Users\UserFile;

$user=new User();
$userDB=new UserDB($user);

$data=[];
$errors=[
	'errProfileName'=>'',
	'errProfileUserName'=>'',
	'errProfileGender'=>'',
	'errProfileOccupation'=>'',
	'errProfileBio'=>''
];
if($_REQUEST['REQUEST_METHOD']=='POST'){
	$data=file_get_contents('php://input');
    $data_f=json_decode($data,true);
    try{
    	$username=$data_f['username'];
    	$fullname=$data_f['fullname'];
    	$occupation=$data_f['gender'];
    	$name=$data_f['occupation'];
    	$gender=$data_f['gender'];
    	$bio=$data_f['gender'];

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
		$data['status']='success';
		$data['message']='everything all good';
	}catch(Exception $err){
		$data['errors']=$errors;
		$data['status']='failed';
		$data['message']=$err->getMessage();
		echo json_encode($data);
	}

}




?>
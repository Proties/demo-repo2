<?php 
session_start();
use Insta\Users\Users;
use Insta\Databases\User\UserDB;
$data=[];
$errorMessages=[];
$user=new Users();

try{
	if(empty($_POST['loginEmail']) OR empty($_POST['loginPassword'])){
		throw new Exception('username/password cannot be empty');
	}
	$user->set_email($_POST['loginEmail']);
	$user->set_password($_POST['loginPassword']);
	if($user->validate_email($user->get_email())==false){
		$errorMessages[]=array('errLoginUsername'=>'username not valid');
	}
	if($user->validate_password($user->get_password())==false){
		$errorMessages[]=array('errLoginUserpassword'=>'password not valid');
	}
	$lenOne=count($errorMessages);
	if($lenOne>0){
		throw new Exception('there are errores');
	}
	$userDB=new UserDB($user);
	if($userDB->validate_email_in_database()!==false){
		$errorMessages[]=array('errLoginUsername'=>'usersname already exists');
		throw new Exception('there are errores');
	}
	if($userDB->validate_password_in_database()==false){
		$errorMessages[]=array('errLoginUserpassword'=>'password does not match');
		throw new Exception('there are errores');
	}
	
	$data['status']='success';
	$data['message']='all works in the login modal';
	// setcookie('myprofile',json_encode($personal),time()+(36*10),'/');
	$store['userID']=$user->get_id();
  	$store['username']=$user->get_username();
  	$store['shortBio']=$user->get_shortBio();
  	$store['profilePicture']->get_profilePicture();

  	setcookie('user',json_encode($store), time() + (38900 * 600), '/');
	setcookie('LoggingInStatus',json_encode($data),time()+(30*10),'/');
}catch(Exception $err){
	$data['status']='failed';
	$data['message']=$err->getMessage();
	$data['errors']=$errorMessages;
	$data['data']=['email'=>$user->get_email(),'password'=>$user->get_password()];
	setcookie('LoggingInStatus',json_encode($data),time()+(30*10),'/');
}
header('Location: /');
exit();
?>
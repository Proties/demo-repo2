<?php 
session_start();
use Insta\Users\Users;
use Insta\Database\Users\UserDB;
$data=[];
$errorMessages=[];
$user=new Users();

try{
	if(empty($_POST['username']) OR empty($_POST['password'])){
		throw new Exception('username/password cannot be empty');
	}
	$user->set_username($_POST['username']);
	$user->set_password($_POST['password']);
	if($user->validate_username()){
		$errorMessages['errUsername'][]='username not valid';
	}
	if($user->validate_password()){
		$errorMessages['errUserpassword'][]='password not valid';
	}
	$lenOne=count($errorMessages);
	if($lenOne>1){
		throw new Exception('there are errores');
	}
	if($userDB->validate_username()!==false){
		$errorMessages['errUsername'][]='usersname already exists';
	}
	if($userDB->validate_password()==false){
		$errorMessages['errUsername'][]='password does not match';
	}
	$lenTwo=count($errorMessages);
	if($lenTwo>1){
		throw new Exception('there are errores');
	}
	$data['status']='succes';
	$data['message']='all works';
	$_SESSION['userID'];
	$_SESSION['username'];
	setcookie('LoggingInStatus',json_encode($data),time()+(30*10));
	header('Location /');
	exit();
}catch(Exception $err){
	$data['status']='failed';
	$data['message']=$err->getMessage();
	$data['errors']=$errorMessages;
	echo json_encode($data);
}
?>
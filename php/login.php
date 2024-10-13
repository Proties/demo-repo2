<?php 
session_start();
use Insta\Users\User;
use Insta\Database\Users\UserDB;
$data=[];
$errorMessages=[];
$user=new Users();
try{
	if(empty($_POST['username'])OR empty($_POST['password'])){
		throw Exception('username/password not valid')
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
	if($userDB->validate_username()){
		$errorMessages['errUsername'][]='not in database';
	}
	if($userDB->validate_password()){
		$errorMessages['errUsername'][]='password does not match';
	}
	$lenTwo=count($errorMessages);
	if($lenTwo>1){
		throw new Exception('there are errores');
	}
	$data['status']='succes';
	$data['message']='all works';
	$_SESSION['username'];
	$_SESSION['userID'];
	$_SESSION['email'];
	$personal=[];
	$personal['username']=$_SESSION['username'];
	$personal['userID']=$_SESSION['userID'];
	$personal['email']=$_SESSION['email'];
	setcookie('myprofile',json_encode($personal), time() + (86400 * 30), '/'); 
	echo json_encode($data);
}catch(Exception $err){
	$data['status']='failed';
	$data['message']=$err->getMessage();
	$data['errors']=$errorMessages;
	echo json_encode($data);
}
?>
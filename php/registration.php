<?php
session_start();
use Insta\Users\Users;
use Insta\Users\UserCache;
use Insta\Databases\User\UserDB;
use Insta\Exception\ErrorHandler;
$user=new Users();
$err=new ErrorHandler();
$errorMessages=[];
$dataObj=array();
$jsonData=['status'=>''];
if($_SERVER['REQUEST_METHOD']=='POST'){
    $data=file_get_contents('php://input');
    $dataObj=json_decode($data,true);
}
try{
    
    $user->set_lastName($dataObj['lastName']);
    $user->set_name($dataObj['name']);
    $user->set_password($dataObj['password']);
    $user->set_email($dataObj['email']);
    $userDB=new UserDB($user);
    if($user->validate_name($user->get_name())==false){
        $errorMessages[]['errName']='Name not valid';
    }
    if($user->validate_lastName($user->get_lastName())==false){
        $errorMessages[]['errlastName']='username not valid';
    }
    if($user->validate_password($user->get_password())==false){
        $errorMessages[]['errPassword']='Password must be at least 13 characters and contain at least 2 special characters';
    }
    
    if($user->validate_email($user->get_email())==false){
        $errorMessages[]['errEmail']='Email not valid';
    }
    if($userDB->search_email_in_db($user->get_email())!==false){
        $errorMessages[]['errEmail']='Email already exists';
    }
    $len=count($errorMessages);
    if($len>0){
        throw new Exception('could not create user');
    }
    $jsonData['status']='success';
    $_SESSION['firstName']=$user->get_name();
    $_SESSION['password']=$user->get_password();
    $_SESSION['lastName']=$user->get_lastName();
    $_SESSION['email']=$user->get_email();
    echo json_encode($jsonData);
}catch(Exception $error){
    $data=array('status'=>'failed','msg'=>$error->getMessage(),"errorArray"=>$errorMessages);
    echo json_encode($data);
    return;
}

?>
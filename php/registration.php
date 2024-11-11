<?php
session_start();
use Insta\Users\Users;
use Insta\Users\UserCache;
use Insta\Databases\User\UserDB;

$user=new Users();

$errorMessages=[];
$dataObj=array();
$jsonData=[];
// setcookie('registration','happy', time() - (30 * 600), '/'); 
try{
    unset($_SESSION['firstName']);
    unset($_SESSION['password']);
    unset($_SESSION['lastName']);
    unset($_SESSION['email']);
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $data=file_get_contents('php://input');
        $dataObj=json_decode($data,true);
    }

    
    $user->set_lastName($dataObj['lastName']);
    $user->set_name($dataObj['name']);
    $user->set_password($dataObj['password']);
    $user->set_email($dataObj['email']);
    $userDB=new UserDB($user);

    if($user->validate_name($user->get_name())==false){
        $errorMessages[]['errName']='Name not valid';
    }
    if($user->validate_lastName($user->get_lastName())==false){
        $errorMessages[]['errlastName']='lastName  not valid';
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
    
  
    $_SESSION['firstName']=$user->get_name();
    $_SESSION['password']=$user->get_password();
    $_SESSION['lastName']=$user->get_lastName();
    $_SESSION['email']=$user->get_email();

    $jsonData['status']='success';
    $jsonData['message']='user created succesfully';
    echo json_encode($jsonData);
}catch(Exception $error){
    $jsonData['status']='failed';
    $jsonData['msg']=$error->getMessage();
    $jsonData['errorArray']=$errorMessages;
    echo json_encode($jsonData);
}
// $exp_date=time()+(60*30);
// header('Set-Cookie: registration=' . json_encode($jsonData) . '; ' .
//        'Expires=' . gmdate('D, d M Y H:i:s T', $exp_date) . '; ' .
//        'Path=/; ' .
//        'Secure; ' .  // Add Secure flag
//        'HttpOnly; ' . // Add HttpOnly flag
//        'SameSite=Strict'); 
header('Cache-Control: no-cache');
header('Pragma: no-cache');
?>
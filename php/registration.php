<?php
session_start();
$user=new Users();
$errorMessages=array();
$dataObj=array();
if($_SERVER['REQUEST_METHOD']=='POST'){
    $data=file_get_contents('php://input');
    $dataObj=json_decode($data,true);
}
try{
    
    $user->set_username($dataObj['username']);
    $user->set_name($dataObj['name']);
    $user->set_password($dataObj['password']);
    $user->set_email($dataObj['email']);
    if(!$user->validate_name($user->get_name())){
        $errorMessages[]=array('errName'=>'Name not valid');
    }
    if(!$user->validate_username($user->get_username())){
        $errorMessages[]=array('errUsername'=>'username not valid');
    }
    if(!$user->search_username_in_db($user->get_username()==false)){
        $errorMessages[]=array('errUsername'=>'username taken');

    }
    if(!$user->validate_password($user->get_password())){
        $errorMessages[]=array('errPassword'=>'Password must be at least 13 characters and contain at least 2 special characters');
    }
    
    if(!$user->validate_email($user->get_email())){
        $errorMessages[]=array('errEmail'=>'Email not valid');
    }
    if(!$user->search_email_in_db($user->get_email()==false)){
        $errorMessages[]=array('errEmail'=>'Email already exists');
    }
    $len=count($errorMessages);
    if($len>0){
        throw new Exception('could not create user');
    }
    $user->write_user();
    if($user->get_status()==1){
        $_SESSION['userID']=$user->get_id();
        $_SESSION['username']=$user->get_username();
        $item=array('status'=>'success');
        echo json_encode($item);
        return;
    }
    throw new Exception('user failed to be created');
       
    
}catch(Exception $err){
    $data=array('status'=>'failed','msg'=>$err->getMessage(),"errorArray"=>$errorMessages);
    echo json_encode($data);
    return;
}

?>
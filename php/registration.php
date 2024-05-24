<?php
if($_SERVER['REQUEST_METHOD']=='GET'){
    include_once('account.html');
    return;
}
include_once('php/user.php');

$user=new Users();

$user->set_name($_POST['fullname']);
$user->set_username($_POST['username']);
$user->set_password($_POST['password']);
$user->write_user();
//if user succesfully registered direct them to homepage
if($user->get_status()==1){
    echo 'success';
    $_SESSION['userID']=$user->get_id();
    $_SESSION['username']=$user->get_username();
    header('Location: /');
    exit();
}else{
    echo 'failed';
   return json_encode(array("status"=>"not ok","message"=>"incorrect details"));
}
?>
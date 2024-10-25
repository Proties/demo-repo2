<?php 
session_start();
use Insta\Users\User;
use Insta\Database\User\UserDB;
use Insta\Database\Users\UserDB;
use Insta\Order\Order;
use Insta\Database\Order\OrderDB;

$user=new User();
$order=new Order();
$data=[];
try{
	if(!isset($_POST['amount']){
		throw new Exception('amount must be specified');
	}
	if(!isset($_SESSION['userID'])){
		throw new Exception('create account');
	}
	if(empty($_POST['donationAmount'])){
        throw new Exception('amount not enterd');
    }
    if(!is_int((int)$_POST['donationAmount'])){
        throw new Exception('amount not valid');
    }
    if((int)$_POST['donationAmount']==0){
        throw new Exception('amount cannot be 0');
    }
	$amount=$_POST['amount'];
	$_SESSION['orderDetailes'];
	$currentDate=date('Y:m:d');
	$currentTime=date('h:i');
	$order->set_type('donation');
	$order->set_item('onceOfff prchase');
	$order->set_amount($amount);
	$order->set_time_created($currentTime);
	$order->set_date_created($currentDate);
	$order->set_userID($_SESSION['userID']);
	$orderDB=new OrderDB($order);
	$orderDB->addOrder();

	$_SESSION['orderDetailes']=$order;
	$data['status']='success';
	header('Location: /checkout');
	exit();
}catch(Exception $err){
	$data['status']='failed';
	$data['message']=$err->getMessage();
	echo json_encode($data);
}
header('Location: /');
exit();


?>
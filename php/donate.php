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
	$amount=$_POST['amount'];
	$_SESSION['orderDetailes'];
	$currentDate;
	$currentTime;
	$order->set_type('donation');
	$order->set_item();
	$order->set_amount($amount);
	$order->set_time_created();
	$order->set_date_created();
	$order->set_userID($_SESSION['userID']);

	$_SESSION['orderDetailes']=$order;
	$data['status']='success';
	header('Location: /checkout');
	exit();
}catch(Exception $err){
	$data['status']='failed';
	$data['message']=$err->getMessage();
	echo json_encode($data);
}



?>
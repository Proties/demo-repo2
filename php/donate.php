<?php 
session_start();
use Insta\Users\Users;
use Insta\Databases\User\UserDB;
use Insta\Order\Order;
use Insta\Database\Order\OrderDB;

$user=new Users();
$order=new Order();
$data=[];
try{

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
	$amount=$_POST['donationAmount'];

	$currentDate=date('Y:m:d');
	$currentTime=date('h:i');
	$order->set_type('donation');
	$order->add_items('onceOfff prchase');
	$order->set_total($amount);
	$order->set_time_created($currentTime);
	$order->set_date_created($currentDate);
	$order->set_userID($_SESSION['userID']);
	$orderDB=new OrderDB($order);
	$orderDB->addOrder();

	$_SESSION['orderID']=$OrderDB->order->get_id();
	$data['status']='success';
	header('Location: /checkout');
	exit();
}catch(Exception $err){
	$data['status']='failed';
	$data['message']=$err->getMessage();
	setcookie('donationStatus',json_encode($data),time()+(36*10),'/');
	header('Location: /');
exit();
}



?>
<?php 
session_start();
use Insta\Users\User;
use Insta\Database\User\UserDB;
use Insta\Subscription\Subscription;
use Insta\Database\Subscription\SubscriptionDB;
use Insta\Order\Order;
use Insta\Plan\Plan;
use Insta\Database\Order\OrderDB;



if($_SERVER['REQUEST_METHOD']=='GET'){
	// return subrcrip feature list html page and diffent deals
	// include_once('Htmlfiles/unlockPremium.html');
	return;
}
$order=new Order();
$plan=new Plan();
$subcription=new Subscription();
$data=[];
$action;
if(isset($_POST['subscriptionType'])){
	$action=$_POST['subscriptionType'];
}
switch($action){
	case 'monthly_plan':
		try{
			if(!isset($_SESSION['userID'])){
				throw new Exception('create account');
			}
			$order->set_type('subscription');
			$order->set_item();
			$order->set_amount($amount);
			$order->set_time_created();
			$order->set_date_created();
			$order->set_userID($_SESSION['userID']);


			$_SESSION['orderDetail']=$order;
			$orderDB=new OrderDB();
			header('Location: /checkout');
		}catch(Exception $err){
			$data['status']='failed';
			$data['message']=$err->getMessage();
			echo json_encode($data);
		}
	break;
	case 'annual_plan':
		try{
			if(!isset($_SESSION['userID'])){
				throw new Exception('create account');
			}
			$order->set_type('subscription');
			$order->set_item();
			$order->set_amount($amount);
			$order->set_time_created();
			$order->set_date_created();
			$order->set_userID($_SESSION['userID']);
			$_SESSION['orderDetail']=$order;
			$orderDB=new OrderDB();
			header('Location: /checkout');
		}catch(Exception $err){
			$data['status']='failed';
			$data['message']=$err->getMessage();
			echo json_encode($data);
		}
	break;
	case 'free_trial':
		try{
			if(!isset($_SESSION['userID'])){
				throw new Exception('create account');
			}
			$order->set_type('free_trial');
			$order->set_item();
			$order->set_time_created();
			$order->set_date_created();
			$order->set_userID($_SESSION['userID']);
			header('Location: /');
		}catch(Exception $err){
			$data['status']='failed';
			$data['message']=$err->getMessage();
			echo json_encode($data);
		}
		
	break;
}

?>
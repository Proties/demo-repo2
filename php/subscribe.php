<?php 
session_start();
use Insta\Users\User;
use Insta\Database\User\UserDB;
use Insta\Subscription\Subscription;
use Insta\Database\Subscription\SubscriptionDB;
use Insta\Order\Order;
use Insta\Subscription\Plan;
use Insta\Database\Order\OrderDB;



if($_SERVER['REQUEST_METHOD']=='GET'){
	include_once('Htmlfiles/premium.html');
	return;
}
if($_SERVER['REQUEST_METHOD']=='POST'){


$order=new Order();
$plan=new Plan();
$subcription=new Subscription();
$data=[];
$action;
$currentDate=date('Y:m:d');
$currentTime=date('h:i');
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
			$order->set_time_created($currentTime);
			$order->set_date_created($currentDate);
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
			$order->set_time_created($currentTime);
			$order->set_date_created($currentDate);
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
			$order->set_item_description();
			$order->set_time_created($currentTime);
			$order->set_date_created($currentDate);
			$order->set_userID($_SESSION['userID']);

			$token;
			$nextRun;
			$frequency;
			
			$subcription->set_type($order->get_type());
			$subcription->set_initial_amount(0);
			$subcription->set_token($token);
			$subcription->set_amount($order->get_amount());
			$subcription->set_next_run($nextRun);
			$subcription->set_frequency($frequency);
			$subcription->set_item_name($order->get_item_name());
			$subcription->set_item_description($itemDescription);
			$subcription->set_name_first($user->get_firstName());
			$subcription->set_name_last($user->lastName());
			$subcription->set_email_address($user->get_email());

			$subdb=new SubscriptionDB($subcription);
			$subdb->addSubscription();

			header('Location: /');
		}catch(Exception $err){
			$data['status']='failed';
			$data['message']=$err->getMessage();
			echo json_encode($data);
		}
		
	break;
}
}
?>
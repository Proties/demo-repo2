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
			if(empty($_SESSION['userID'])){
				throw new Exception('create account');
			}
			$amount=50;
			$order->set_type('Monthly Subscription');
			$order->set_itemName();
			$order->set_itemDescription();
			$order->set_total($amount);
			$order->set_time_created($currentTime);
			$order->set_date_created($currentDate);
			$order->set_userID($_SESSION['userID']);
			$orderDB=new OrderDB($order);
			$orderDB->addOrder();

			$_SESSION['orderDetail']=$OrderDB->order;

			header('Location: /checkout');
		}catch(Exception $err){
			$data['status']='failed';
			$data['message']=$err->getMessage();
			echo json_encode($data);
		}
	break;
	case 'annual_plan':
		try{
			if(empty($_SESSION['userID'])){
				throw new Exception('create account');
			}
	
			$amount=440;
			$order->set_type('Annual Subscription');
			$order->set_itemName('subscription');
			$order->set_itemDescription('this is our annual plan');
			$order->set_total($amount);
			$order->set_time_created($currentTime);
			$order->set_date_created($currentDate);
			$order->set_userID($_SESSION['userID']);
			$orderDB=new OrderDB($order);
			$orderDB->addOrder();
			$_SESSION['orderDetail']=$OrderDB->order;
			
			header('Location: /checkout');
		}catch(Exception $err){
			$data['status']='failed';
			$data['message']=$err->getMessage();
			echo json_encode($data);
		}
	break;
	case 'free_trial':
		try{
			if(empty($_SESSION['userID'])){
				throw new Exception('create account');
			}
			if(!isset($_SESSION['userID'])){
				throw new Exception('create account');
			}
			$amount=0;
			$order->set_type('Free Trial');
			$order->set_itemName('free Trial');
			$order->set_itemDescription('basic free trial system');
			
			$order->set_total($amount);
			$order->set_time_created($currentTime);
			$order->set_date_created($currentDate);
			$order->set_userID($_SESSION['userID']);
			$orderDB=new OrderDB($order);
			$orderDB->addOrder();

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
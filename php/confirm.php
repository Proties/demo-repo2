<?php 
use Insta\Users\User;
use Insta\Database\Users\UserDB;
use Insta\Subscription\Subscription;
use Insta\Database\Subscription\SubscriptionDB;

$user=new Users();
$order=new Order();
$subcription=new Subscription();

$token;
$nextRun;
$intialAmount;
$frequency;

try{
	if(!issett($_SESSION['subscriptionStatus']) OR $_SESSION['subscriptionStatus']==true){
		throw new Exception('did not complete transcation');
	}
	$subcription->set_type($order->get_type());
	$subcription->set_initial_amount($intialAmount);
	$subcription->set_token($token);
	$subcription->set_amount($order->get_amount());
	$subcription->set_next_run($nextRun);
	$subcription->set_frequency($frequency);
	$subcription->set_item_name($order->get_item());
	$subcription->set_item_description($order->get_description());
	$subcription->set_name_first($user->get_firstName());
	$subcription->set_name_last($user->get_lastName());
	$subcription->set_email_address($user->get_email());

	$subdb=new SubscriptionDB($subcription);
	$subdb->addSubscription();
	header('Location: /');
	exit();
}catch(Exception $err){
	echo $err->getMessage();
}

?>
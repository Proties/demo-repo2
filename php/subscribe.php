<?php 
use Insta\Subscription\Subscription;
use Insta\Database\Subscription\SubscriptionDB;
use Insta\Order\Order;
use Insta\Database\Order\OrderDB;
use Insta\Cart\Cart;


if($_SERVER['REQUEST_METHOD']=='GET'){
	//return subrcrip feature list html page and diffent deals
	// include_once('Htmlfiles/unlockPremium.html');
	return;
}
$order=new Order();

$action;
if(isset($_POST['subscriptionType'])){
	$action=$_POST['subscriptionType'];
}
switch($action){
	case 'monthly_plan':
		$_SESSION['orderDetail']=$order->get_data();
		$orderDB=new OrderDB();
		header('Location: /checkout');
	break;
	case 'annual_plan':
		$_SESSION['orderDetail']=$order->get_data();
		$orderDB=new OrderDB();
		header('Location: /checkout');
	break
	case 'free_trial':
		header('Location: /');
	break
}
?>
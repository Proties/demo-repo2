<?php 
session_start();
use Insta\Users\User;
use Insta\Database\User\UserDB;
use Insta\Database\Users\UserDB;
use Insta\Order\Order;
use Insta\Database\Order\OrderDB;
use Insta\Template\Template;
use Insta\Template\HtmlTemplate;
use Insta\Database\Template\TemplateDB;

$data=[];
$user=new Users();
$order=new Order();
$template=new Template();

try{
	if(empty($_SESSION['userID'])){
		throw new Exception('create an account first');
	}
	if(empty($_POST['templateID'])){
		throw new Exception('template id not defined');
	}
	if(empty($_POST['templateName'])){
		throw new Exception('template name not defined');
	}
	$currentTime=date('H:i');
	$currentDate=date('Y:m:d');
	$tempaDB->getTemplate();
	$order->set_type('template');
	$order->set_item();
	$order->set_total($amount);
	$order->set_time_created($currentTime);
	$order->set_date_created($currentDate);
	$order->set_userID($_SESSION['userID']);
	$orderDB=new OrderDB($order);
	$orderDB->addOrder();
	$data['status']='success';
	setcookie('buyTemplateStatus',json_encode($data),time()+(36*10),'/');
	header('Location: /checkout');
	exit();
}catch(Exception $err){
	$data['message']=$err->getMessage();
	$data['status']='failed';
	setcookie('buyTemplateStatus',json_encode($data),time()+(36*10),'/');
	header('Location: /');
	exit();
}


?>
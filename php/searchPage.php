<?php 
session_start();
use Insta\Users\Users;
use Insta\Databases\User\UserDB;
use Insta\Posts\Post;
use Insta\Ranking\ProfilesRank;
use Insta\Pool\ProfilePool;
use Insta\Subscription\Subscription;
use Insta\Database\Subscription\SubscriptionDB;



if($_SERVER['REQUEST_METHOD']=='GET'){
	include_once('/Htmlfiles/searchPage.html');
	return;
}
if($_SERVER['REQUEST_METHOD']=='POST'){
	$data=[];
	$user=new Users();
	$porfiles=[];
	try{

		$data['results'];
		$data['status']='success';
		setcookie('searchProfiles',json_encode($data),time()+(30*23),'/');
	}catch(Exception $err){
		$data['status']='failed';
		$data['message']=$err->getMessage();
		setcookie('searchProfiles',json_encode($data),time()+(30*23),'/');

	}
}
?>
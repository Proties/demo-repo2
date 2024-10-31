<?php 
session_start();
use Insta\Users\Users;
use Insta\Databases\User\UserDB;
use Insta\Posts\Post;
use Insta\Ranking\ProfilesRank;
use Insta\Pool\ProfilePool;
use Insta\Subscription\Subscription;
use Insta\Database\Subscription\SubscriptionDB;



function validate_search_term(string $keyword){

}

if($_SERVER['REQUEST_METHOD']=='GET'){
	include_once('Htmlfiles/Searchmobile.html');
	return;
}
if($_SERVER['REQUEST_METHOD']=='POST'){
	$data=[];
	$user=new Users();
	$profiles=new ProfilePool();
	$mostPopularProfiles;
	$lastSearchedProfiles;
	try{
		if(isset($_SESSION['userID'])){
			$dummyArray=[];
			$user->set_id($_SESSION['userID']);
			$user->set_username($_SESSION['username']);
			$user->set_recentSearchResults($dummyArray);
		
		}
		if(!isset($_POST['search_term']) OR empty($_POST['search_term'])){
			throw new Exception('no search term defined');
		}
		if (validate_search_term($_POST['search_term'])==false){
			throw new Exception('not valid search term');
		}
		$status=$profiles->search($_POST['search_term']);
		if($status==false){
			//search database
			$data['results'];
		}
		else{
			$data['results'];
		}
		
		$data['userInfo']=['username'=>'','profilePicture'=>'','recentSearchHistory'=>[]];
		$data['status']='success';
		setcookie('searchProfiles',json_encode($data),time()+(30*23),'/');
	}catch(Exception $err){
		$data['status']='failed';
		$data['message']=$err->getMessage();
		setcookie('searchProfiles',json_encode($data),time()+(30*23),'/');

	}
}
?>
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
$user=new Users();
if(isset($_SESSION['userID'])){
	$user->set_id($_SESSION['userID']);
	$user->set_username($_SESSION['username']);
}

$userDB=new UserDB($user);
if(!isset('popularProfiles')){
	$userDB->get_profiles();
	$data=[];
	setcookie('popularProfiles',json_encode($data),time()+(54900*30),'/');
}

if(isset($_SESSION['recentSearchResults'])){
	$data=[];
	setcookie('recentSearches',json_encode($data),time()+(1000*30),'/');
}

if($_SERVER['REQUEST_METHOD']=='GET'){
	include_once('Htmlfiles/Searchmobile.html');
	return;
}


if($_SERVER['REQUEST_METHOD']=='POST'){
	$data=[];
	
	$profiles=new ProfilePool();
	$mostPopularProfiles;
	$lastSearchedProfiles;
	try{
		
		$actions;
		if(isset($_POST['actions'])){
			$actions=$_POST['actions'];
		}
		switch($actions){
			case 'follow':
				try{
					if(!isset($_SESSION['userID']) OR empty($_SESSION['userID'])){
						throw new Exception('create account');
					}
				}catch(Exception $err){
					$data['status']='failed';
					$data['message']=$err->getMessage();
					setcookie('searchResults',json_encode($data),time()+(45033*43),'/');
				}
	

				break;
			case 'unfollow':
				try{
					if(!isset($_SESSION['userID']) OR empty($_SESSION['userID'])){
						throw new Exception('create account');
					}
				}catch(Exception $err){
					$data['status']='failed';
					$data['message']=$err->getMessage();
					setcookie('searchResults',json_encode($data),time()+(45033*43),'/');
				}
				


				break;
			case 'search':
				try{
					if(!isset($_POST['search_term']) OR empty($_POST['search_term'])){
					throw new Exception('no search term defined');
					}
					if (validate_search_term($_POST['search_term'])==false){
						throw new Exception('not valid search term');
					}
					if(!isset($_SESSION['userID']) OR empty($_SESSION['userID'])){
						throw new Exception('not valid search term');
					}
					$userData=['newPosts'=>0,'followingStatus'=>,'username'=>,'profilePicture'=>''];
					$_SESSION['recentSearchResults'][]=$userData;
					if(count($_SESSION['recentSearchResults'])>5){
						// remove the last entry item
						// $_SESSION['recentSearchResults']
					}
					
					setcookie('recentSearchResults',json_encode($userData),time()+(45033*43),'/');
					setcookie('searchResults',json_encode($data),time()+(45033*43),'/');
				}catch(Exception $err){
					$data['status']='failed';
					$data['message']=$err->getMessage();
					setcookie('searchResults',json_encode($data),time()+(45033*43),'/');
					
					
				}
				

				break;
			case 'removePopular':
				try{
					if(!isset($_SESSION['userID']) OR empty($_SESSION['userID'])){
						throw new Exception('create account');
					}
				}catch(Exception $err){
					$data['status']='failed';
					$data['message']=$err->getMessage();
					
				}
				
				break;
			case 'removeRecent':
				try{
					if(!isset($_SESSION['userID']) OR empty($_SESSION['userID'])){
						throw new Exception('create account');
					}
				catch(Exception $err){
					$data['status']='failed';
					$data['message']=$err->getMessage();
					
				}
				break;
		}	
	}catch(Exception $err){
		$data['status']='failed';
		$data['message']=$err->getMessage();
		setcookie('searchProfiles',json_encode($data),time()+(30*23),'/');

	}
}
?>
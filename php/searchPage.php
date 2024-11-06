<?php 
session_start();
use Insta\Users\Users;
use Insta\Databases\User\UserDB;
use Insta\Posts\Post;
use Insta\Ranking\ProfilesRank;
use Insta\Pool\ProfilePool;
use Insta\Subscription\Subscription;
use Insta\Database\Subscription\SubscriptionDB;

use Insta\Follower\Follower;
use Insta\Database\Follower\FollowerDB;

function validate_search_term(string $keyword){

}

$user=new Users();
if(isset($_SESSION['userID'])){
	$user->set_id($_SESSION['userID']);
	$user->set_username($_SESSION['username']);
}
try{
	if($_SERVER['REQUEST_METHOD']=='GET'){
	$userDB=new UserDB($user);

	// if(!isset($_COOKIE['popularProfiles'])){
		// $userDB->get_popular_profiles();
		$dataTwo=[['username'=>'hall','userID'=>2,'profilePicture'=>'/Image/Test Account.png','followingStatus'=>false,'newPosts'=>2],
			['username'=>'pal','userID'=>32,'profilePicture'=>'/Image/Test Account.png','followingStatus'=>true,'newPosts'=>2],
			['username'=>'mall','userID'=>322,'profilePicture'=>'/Image/Test Account.png','followingStatus'=>true,'newPosts'=>4],
			['username'=>'singer','userID'=>12,'profilePicture'=>'/Image/Test Account.png','followingStatus'=>false,'newPosts'=>1]];

	setcookie('popularProfiles',json_encode($dataTwo),time()+(100*300),'/');
	// }


	// if(!isset($_COOKIE['recentSearches'])){
		// $userDB->get_profiles();
		$data=[['username'=>'hall','newPosts'=>4,'userID'=>2,'profilePicture'=>'/Image/Test Account.png','followingStatus'=>false],
			['username'=>'pal','newPosts'=>2,'userID'=>32,'profilePicture'=>'/Image/Test Account.png','followingStatus'=>true],
			['username'=>'singer','newPosts'=>1,'userID'=>12,'profilePicture'=>'/Image/Test Account.png','followingStatus'=>false]];

	setcookie('recentSearches',json_encode($data),time()+(100*300),'/');
	// }
		include_once('Htmlfiles/Searchmobile.html');
		return;
	}


	if($_SERVER['REQUEST_METHOD']=='POST'){
		$actions;
		if(isset($_POST['actions'])){
			$actions=$_POST['actions'];
		}
		switch($actions){
			case 'follow':
				try{
					if(!isset($_SESSION['userID']) OR empty($_SESSION['userID'])){
                 		throw new Exception('make an account');
           			}
					if(!isset($_POST['followerID'])){
               			throw new Exception('follower ID not defined');
          			}
           
		            $f=new Follower();
		            $f->set_current_userID($_SESSION['userID']);
		            $f->set_follower_userID($followerID);
		            $fDB=new FollowerDB($f);
		            $fDB->addFollower();
		          
					}catch(Exception $err){
						$data['status']='failed';
						$data['message']=$err->getMessage();
						echo json_encode($data);
						setcookie('searchResults',json_encode($data),time()+(45033*43),'/');
					}
				break;
			case 'unfollow':
				try{
					if(!isset($_SESSION['userID']) OR empty($_SESSION['userID'])){
                 		throw new Exception('make an account');
           			}
           			if(!isset($_POST['followerID'])){
               			throw new Exception('follower ID not defined');
	          			}
		            $f=new Follower();
		            $f->set_current_userID($_SESSION['userID']);
		            $f->set_follower_userID($followerID);
		            $fDB=new FollowerDB($f);
		            $followerDB->unFollowUser();
		            $data['status']='success';
		            $data['message']='its all right';
		            echo json_encode($data);
					}catch(Exception $err){
						$data['status']='failed';
						$data['message']=$err->getMessage();
						echo json_encode($data);
						setcookie('searchResults',json_encode($data),time()+(45033*43),'/');
					}
				break;
			case 'search':
				try{
					if(!isset($_POST['q']) OR empty($_POST['q'])){
					throw new Exception('no search term defined');
					}
					if (validate_search_term($_POST['q'])==false){
						throw new Exception('not valid search term');
					}
					if(!isset($_SESSION['userID']) OR empty($_SESSION['userID'])){
						throw new Exception('not valid search term');
					}
					$data=[];
					$userDB->search_user();
					$userData=['newPosts'=>$userDB->user->get_newPosts(),'followingStatus'=>$userDB->user->get_followingStatus(),'username'=>$userDB->user->get_username(),'profilePicture'=>$userDB->user->get_profilePicture()];
					$_SESSION['recentSearchResults'][]=$userData;
					if(count($_SESSION['recentSearchResults'])>5){
						unset($_SESSION['recentSearchResults'][6]);
						
					}
					
					setcookie('recentSearchResults',json_encode($userData),time()+(43*43),'/');
					setcookie('searchResults',json_encode($data),time()+(23*43),'/');
				}catch(Exception $err){
					$data['status']='failed';
					$data['message']=$err->getMessage();
					setcookie('searchResults',json_encode($data),time()+(45033*43),'/');				
				}
				break;
			case 'remove_popular_profile':
				$data=[];
				try{
					if(!isset($_SESSION['userID']) OR empty($_SESSION['userID'])){
						throw new Exception('create account');
					}
					if(isset($_COOKIE['popularProfiles'])){

					}
					$data['status']='success';
					$data['message']='popular profile removed';
					$data['data']=['username'=>'loner','profilePicture'=>''];
					echo json_encode($data);
				}catch(Exception $err){
					$data['status']='failed';
					$data['message']=$err->getMessage();
					echo json_encode($data);
				}
				break;
			case 'remove_profile':
				try{
					if(!isset($_SESSION['userID']) OR empty($_SESSION['userID'])){
						throw new Exception('create account');
					}
					if(!isset($_SESSION['recentSearchResults'])){
						throw new Exception('no sessions');
					}
				}
				catch(Exception $err){
					$data['status']='failed';
					$data['message']=$err->getMessage();
					echo json_encode($data);
					
				}
				break;
		}	
	}
	}catch(Exception $err){
		$data['status']='failed';
		$data['message']=$err->getMessage();
		include_once('Htmlfiles/Searchmobile.html');
		return;
		setcookie('searchProfiles',json_encode($data),time()+(30*23),'/');

	}

?>
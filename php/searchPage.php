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
		$dataTwo=[];
		$popularContainer=$userDB->get_popular_profiles();
		if(!is_array($popularContainer)){
			
			throw new Exception('popular profiles has errors');
		}
		for($i=0;$i<count($popularContainer);$i++){
			$item=[
					'username'=>$popularContainer[$i]['username'],
					'userID'=>$popularContainer[$i]['userID'],
					'profilePicture'=>$popularContainer[$i]['filepath'].'/'.$popularContainer[$i]['filename']
				];
			
			array_push($dataTwo,$item);
		}
		setcookie('popularProfiles',json_encode($dataTwo),time()+(100*300),'/search_page');
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
				$data=[];
				$resultsArray=[];
				try{

					if(empty($_POST['q'])){
						throw new Exception('no search term defined');
					}

					if(!isset($_POST['q'])){
						throw new Exception('no search');
					}
	
					$results=$userDB->search_user($_POST['q']);
					if(!is_array($results)){
						var_dump($results);
						throw new Exception('there are errors');
					}
					$cont=[];
					for($r=0;$r<count($results);$r++){
						$resultsArray[]=['username'=>$results[$r]['username'],'profilePicture'=>$results[$r]['filepath'].'/'.$results[$r]['filename']
					,'userID'=>$results[$r]['userID'],'newPosts'=>0];
					}
					// for($rr=0;$rr<count($recentArray);$rr++){
					// 	if(isset($recentArray[$rr+1])){
					// 		if($recentArray[$rr]['username']==$recentArray[$rr+1]['username']){
					// 			unset($recentArray[$rr+1]);
					// 		}
					// 	}
						
					// }
					$data['searchResults']=$resultsArray;
					$data['status']='success';

					
					// setcookie('searchResults',json_encode($data),time()+(23*43),'/search_page');
					echo json_encode($data);
				}catch(Exception $err){
					$data['status']='failed';
					$data['message']=$err->getMessage();
					echo json_encode($data);
					setcookie('searchResults',json_encode($data),time()+(45033*43),'/search_page');				
				}
				break;
			case 'visit_profile':
				$data=[];
				try{
					if(!isset($_POST['username']) OR empty($_POST['username'])){
							throw new Exception('no username was provided');
						}
					$profile=new Users();
					$profile->set_username($_POST['username']);
					$profileDB=new UserDB($profile);
					$profileDB->read_user_with_username();
					$recentArray=$_SESSION['recentSearches'];
					$recentItem=['username'=>$profileDB->user->get_username(),'userID'=>$profileDB->user->get_id(),
								'profilePicture'=>$profileDB->user->get_profilePicture(),'newPosts'=>0];
					$recentArray[]=$recentItem;
					$_SESSION['recentSearches'][]=$recentItem;
					$data['status']='success';
					setcookie('recentSearchResults',json_encode($recentArray),time()+(4003*430),'/search_page');
				}catch(Exception $err){
					$data['status']='failed';
					$data['error']=$err->getMessage();
					echo json_encode($data);

				}
				break;
			case 'remove_popular_profile':
				$data=[];
				try{
					if(!isset($_SESSION['userID']) OR empty($_SESSION['userID'])){
						throw new Exception('create account');
					}
					
					$data['status']='success';
					$data['message']='popular profile removed';
					$data['data']=['username'=>'loner','profilePicture'=>''];
					echo json_encode($data);
					add_hidden_profile();
					get_popular_profiles();
					setcookie('popularProfiles',json_encode($data),time()+(100*300),'/search_page');
				}catch(Exception $err){
					$data['status']='failed';
					$data['message']=$err->getMessage();
					echo json_encode($data);
				}
				break;
			case 'remove_profile':
				$data=[];
				try{
					if(!isset($_SESSION['userID']) OR empty($_SESSION['userID'])){
						throw new Exception('create account');
					}
					if(!isset($_SESSION['username']) OR empty($_SESSION['username'])){
						throw new Exception('create account');
					}

					if(!isset($_POST['userID']) OR empty($_POST['userID'])){
						throw new Exception('no account identified');
					}
					if(!isset($_POST['username']) OR empty($_POST['username'])){
						throw new Exception('no account identified');
					}

					$data['status']='success';
					$data['message']='profile removed';
					$recentArray=$_SESSION['recentSearches'];
					for($r=0;$r<count($recentArray);$r++){
						if($recentArray['username']=$_POST['username']){
							unset($_SESSION['recentSearches'][$r]);
							unset($recentArray[$r]);
						}
						
					}
				
					$data['status']='success';
					echo json_encode($data);
					setcookie('recentSearchResults',json_encode($recentArray),time()+(4003*430),'/search_page');
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
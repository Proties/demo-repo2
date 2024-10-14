<?php
session_start();
use Insta\Users\Users;
use Insta\Databases\User\UserDB;
use Insta\Posts\Post;
use Insta\Ranking\Ranking;

$mainUser=new Users();
setcookie('profile','no profile ', time() - (86400 * 30), '/'); 
// setcookie('myprofile','', time() - (86400 * 30), '/');
if(isset($_SESSION['username']) && $_SESSION['username']!==null && isset($_SESSION['userID'])){
    $mainUser->userAuth->set_authanticate(true);
    setcookie('user',json_encode($_SESSION['username']), time() + (86400 * 30), '/'); 
}else{
    unset($_SESSION['username']);
    setcookie('user','no account', time() - (86400 * 30), '/'); 
    
}
/*
this function will take an array or posts and will group the post made by the same user in a single  nested array

*/

function formatProfileObject(array $bigData){
    $newArray=[];
    $cont=[];
    $countItem=0;
    $maxLen=count($bigData);
    $i=0;
    $c=0;
    try{
        while($maxLen>$i){
        
        if($i==0){
            // $items['userInfo'];
            // $items['posts'];
            // $userID=$bigData[$i]['userID'];
            $username=$bigData[$i]['username'];
            $userID=$bigData[$i]['userID'];
  
            $posts=[];
            $posts['imageFileName']=$bigData[$i]['imageFileName'];
            $posts['imageFilePath']=$bigData[$i]['imageFilePath'];
            // $posts['postID']=$bigData[$i]['postID'];
            $posts['VideoFileName']=$bigData[$i]['videoFileName'];
            $posts['videoFilePath']=$bigData[$i]['videoFilePath'];
            
            $newArray['username']=$username;
            $newArray['userID']=$userID;
            $newArray['profilePicture']='/Image/Test Account.png';
        
            $newArray['posts'][]=$posts;
            $cont[]=$newArray;
            // $newArray[$username][]=$bigData[$i];
            // $posts['posts']
            $i++;
            $c++;
          
        }
        else if($bigData[$i]['username']!==$bigData[$i-1]['username']){
        // else if($bigData[$i]['username']!==$cont[$c]['username']){
            $posts=[];
            $username=$bigData[$i]['username'];
            $userID=$bigData[$i]['userID'];

            $posts['imageFileName']=$bigData[$i]['imageFileName'];
            $posts['imageFilePath']=$bigData[$i]['imageFilePath'];
            // $posts['postID']=$bigData[$i]['postID'];
            $posts['VideoFileName']=$bigData[$i]['videoFileName'];
            $posts['videoFilePath']=$bigData[$i]['videoFilePath'];
            if($bigData[$i])

            $newArray['username']=$username;
            $newArray['userID']=$userID;
            $newArray['profilePicture']='/Image/Test Account.png';
        
            $newArray['posts'][]=$posts;
            $cont[]=$newArray;
            $i++;
            $c++;
        }
        else{
            $posts=[];
            

            $posts['imageFileName']=$bigData[$i]['imageFileName'];
            $posts['imageFilePath']=$bigData[$i]['imageFilePath'];
            // $posts['postID']=$bigData[$i]['postID'];
            $posts['VideoFileName']=$bigData[$i]['videoFileName'];
            $posts['videoFilePath']=$bigData[$i]['videoFilePath'];
            array_push($cont[$i-1]['posts'], $posts);
        
            // $newArray['username'][$username]=$bigData[$i-1];
            $i++;
        }
     
    }
    
}catch(Exception $err){
    return  $err;
}
    
    return $cont;
    
}
try{


$arrayPosts=[];
$data=[];
$rank=new Ranking();
$info=$rank->chronoTwo($arrayPosts);
$arrLen=count($info);
    $newData=formatProfileObject($info);
    setcookie('users',json_encode($newData) , time() + (8640 * 1), '/');
}catch(Exception $err){
    echo $err->getMessage();
    setcookie('users','' , time() - (8640 * 1), '/');
}

if($_SERVER['REQUEST_METHOD']=='GET'){
    include_once('Htmlfiles/Homepage.html');
    return;
}

$action=$_POST['action'];
switch($action){
    case 'view_post':
        try{
                if(!is_int($mainUser->get_id())){
                throw new Exception('create account first');
            }
            $view=new ViewedPost($post,$user);
            $view->addPost();
            $data['status']='success';
            $data['message']='its all right';
            echo $data;
        }catch(Exception $err){
            $data['status']='failed';
            $data['message']=$err->getMessage();
            echo $data;
        }
        break;
    case 'follow_user':
        try{
            
            $followerID=$_POST['followerID'];
         
            if(empty($_SESSION['userID']) or empty($_POST['followerID'])){
                throw new Exception('make an account');
            }
           
            $f=new Follower($mainUser,$currentProfile);
            $fDB=new FollowerDB($f);
            $fDB->addFollower();
            
          
            $data['status']='success';
            $data['message']='its all right';
            echo json_encode($data);
        }catch(Exception $err){
            $data['status']='failed';
            $data['message']=$err->getMessage();
            echo json_encode($data);
        }
        break;
    case 'unfollow_user':
        try{
           
            if(!isset($_POST['followerID']) OR empty($_SESSION['userID'])){
                 throw new Exception('make an account');
            }
            
            $data['status']='success';
            $data['message']='its all right';
            echo json_encode($data);
        }catch(Exception $err){
            $data['status']='failed';
            $data['message']=$err->getMessage();
            echo json_encode($data);
        }
        break;
    case 'search':
        $data=[];
        try{
            $target=$_POST['q'];
            $user=new Users();
            $usernames=[];
            
            $userDB=new UserDB($user);
            $arrayData=$userDB->search_user($target);

            $data['status']='success';
            $data['searchResults']=$arrayData;
            $data['Results']=$arrayData;
            setcookie('usernameSearchResults',json_encode($data), time() + (864 * 1), '/');
        }
        catch(Exception $err){
            $data['status']='failed';
            $data['message']=$err->getMessage();
            setcookie('usernameSearchResults',json_encode($data), time() + (864 * 1), '/');
        }
        
        break;
   
    case 'view_more_posts':
        try{
            $rank=Ranking();
            $rank->chrono($arrayPosts);
            $data['status']='success';
            for($i=0;$i<$len;$i++){
                $data['users'][]=array(
                    'username'=>array($user->get_username(),'userID'=>$user->get_id()),
                    'primary_post'=>array('img'=>$primary->get_filePath().$primary->get_fileName(),'postID'=>$primary->get_postID()),
                    'secondary_post'=>array('img'=>$secondary->get_filePath().$secondary->get_fileName(),'postID'=>$secondary->get_postID())
                );
                $postDB->addServeredPost($userID);
            }
            
            echo json_encode($data);
        }catch(Exception $err){
            $data['status']='failed';
            $data['message']='could not load more posts';
            echo json_encode($data);
        }
        
        break;
}
return;
// a function that will take an array of user arrays
// the function will check for arrays with the same username and join em
// it will produce a new array that has a primary and secondary post
function search_name($username,$arr){
    for($i=0;$i<count($arr);$i++){
        if($arr[$i]['username']==$username){
            print_r("worksssss");
            return $arr[$i];
        }
    }
}
?>